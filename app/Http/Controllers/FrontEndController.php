<?php

namespace App\Http\Controllers;

use App\Models\SlideShow;
use App\Models\AboutUs;
use App\Models\Pet;
use App\Models\PetColor;
use App\Models\Achievement;
use App\Models\ReservationApplication;
use App\Models\Inquiry;
use App\Models\ContentPage;
use App\Models\WebsiteSetting;
use App\Models\SeoSetting;
use App\Rules\ImageCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReceived;
use App\Mail\AdminInquiryNotification;

class FrontEndController extends Controller
{
    public function index()
    {
        $banners = SlideShow::active()->get();
        $aboutUs = AboutUs::first();
        $featuredDogs = Pet::with('petColor')->where('is_featured_dog', true)->latest()->take(3)->get();
        $puppies = Pet::with('petColor')
            ->where('category', 'Puppies')
            ->where('available_status', 'available')
            ->latest()->take(6)->get();
        $companionDogs = Pet::with('petColor')
            ->where('category', 'Companion Dog')
            ->where('available_status', 'available')
            ->latest()->take(6)->get();
        $puppiesPage = ContentPage::where('slug', 'puppies')->first();
        $companionDogsPage = ContentPage::where('slug', 'companion-dogs')->first();
        $achievement = Achievement::first();
        $settings = WebsiteSetting::first();
        $seo = SeoSetting::first();

        return view("frontend.pages.index", compact('banners', 'aboutUs', 'featuredDogs', 'puppies', 'companionDogs', 'puppiesPage', 'companionDogsPage', 'achievement', 'settings', 'seo'));
    }

    public function pets()
    {
        $query = Pet::query();

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('full_name', 'like', '%' . request('search') . '%')
                    ->orWhere('call_name', 'like', '%' . request('search') . '%')
                    ->orWhere('description', 'like', '%' . request('search') . '%');
            });
        }

        if (request('sex')) {
            $query->where('sex', request('sex'));
        }

        if (request('color')) {
            $query->where('color', request('color'));
        }

        $pets = $query->with('petColor')->latest()->paginate(12);
        $colors = PetColor::all();
        $settings = WebsiteSetting::first();
        $seo = SeoSetting::first();

        return view("frontend.pages.pets", compact('pets', 'colors', 'settings', 'seo'));
    }

    public function petDetails($slug)
    {
        $pet = Pet::with(['petColor', 'petImages'])->where('slug', $slug)->firstOrFail();
        $relatedPets = Pet::with('petColor')
            ->where('id', '!=', $pet->id)
            ->where('color', $pet->color)
            ->where('is_reserved', false)
            ->latest()
            ->take(3)
            ->get();
        $settings = WebsiteSetting::first();
        $seo = SeoSetting::first();

        return view("frontend.pages.pet-details", compact('pet', 'relatedPets', 'settings', 'seo'));
    }

    public function showReservation(Pet $pet)
    {
        $pet->load('petColor');
        $settings = WebsiteSetting::first();
        $seo = SeoSetting::first();

        return view("frontend.pages.reservation", compact('pet', 'settings', 'seo'));
    }

    public function submitReservation(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'user_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'inquiry' => 'required|string',
            'pet_id' => 'nullable|exists:pets,id',
            'captcha' => ['required', new ImageCaptcha()],
        ], [
            'user_name.required' => 'Please enter your full name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Please enter your phone number.',
            'inquiry.required' => 'Please tell us about your interest.',
            'captcha.required' => 'Please answer the spam check question.',
        ]);

        unset($validated['captcha']);

        // Rate limiting: Check if user has already submitted 2 applications today
        $today = now()->startOfDay();
        $applicationCount = ReservationApplication::where(function ($query) use ($validated) {
            $query->where('email', $validated['email'])
                  ->orWhere('phone', $validated['phone']);
        })->where('created_at', '>=', $today)->count();

        if ($applicationCount >= 2) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'You have reached the maximum number of puppy inquiries for today. Please try again tomorrow.');
        }

        // Create the reservation application
        $application = ReservationApplication::create($validated);

        // Send confirmation email to the inquirer
        try {
            Mail::to($validated['email'])->send(new ReservationReceived($application));
        } catch (\Exception $e) {
            // Log the error but don't fail the submission
            \Log::error('Failed to send reservation email: ' . $e->getMessage());
        }

        // Notify the admin/breeder
        try {
            $pet = $application->pet_id ? Pet::find($application->pet_id) : null;
            $sourceType = match ($pet?->category) {
                'Companion Dog' => 'Companion Dog Inquiry',
                'Puppies' => 'Puppy Inquiry',
                default => $pet ? 'Pet Inquiry' : 'General Inquiry',
            };

            $adminEmail = optional(WebsiteSetting::first())->email ?: config('mail.from.address');

            Mail::to($adminEmail)->send(new AdminInquiryNotification(
                sourceType: $sourceType,
                senderName: $application->user_name,
                senderEmail: $application->email,
                senderPhone: $application->phone,
                messageBody: $application->inquiry,
                pet: $pet,
            ));
        } catch (\Exception $e) {
            \Log::error('Failed to send admin inquiry notification: ' . $e->getMessage());
        }

        // Redirect back with success message
        return redirect()->back()
            ->with('success', 'Thank you for your puppy inquiry! We have received it and will contact you within 1-2 business days. Please check your email for confirmation.');
    }

    public function contentPage(string $pageSlug)
    {
        $page = ContentPage::with('images')->where('slug', $pageSlug)->firstOrFail();
        $settings = WebsiteSetting::first();
        $seo = SeoSetting::first();

        return view('frontend.pages.content-page', compact('page', 'settings', 'seo'));
    }

    public function submitContentPageInquiry(Request $request)
    {
        $validated = $request->validate([
            'page_slug' => 'required|in:puppies,companion-dogs',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
            'captcha' => ['required', new ImageCaptcha()],
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'message.required' => 'Please enter your message.',
            'captcha.required' => 'Please answer the captcha.',
        ]);

        $page = ContentPage::where('slug', $validated['page_slug'])->first();
        $pageName = $page?->title ?? ucfirst(str_replace('-', ' ', $validated['page_slug']));

        Inquiry::create([
            'full_name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? '',
            'inquiry' => '[' . $pageName . ' Page] ' . $validated['message'],
        ]);

        try {
            $adminEmail = optional(WebsiteSetting::first())->email ?: config('mail.from.address');

            Mail::to($adminEmail)->send(new AdminInquiryNotification(
                sourceType: $pageName . ' Page Inquiry',
                senderName: $validated['name'],
                senderEmail: $validated['email'],
                senderPhone: $validated['phone'] ?? '',
                messageBody: $validated['message'],
            ));
        } catch (\Exception $e) {
            \Log::error('Failed to send admin content page inquiry notification: ' . $e->getMessage());
        }

        return redirect()->route('content-page.show', $validated['page_slug'])
            ->with('success', 'Thank you for your inquiry! We will be in touch soon.')
            ->withFragment('inquiry');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validateWithBag('contact', [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'captcha' => ['required', new ImageCaptcha()],
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please select a subject.',
            'message.required' => 'Please enter your message.',
            'captcha.required' => 'Please answer the spam check question.',
        ]);

        Inquiry::create([
            'full_name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? '',
            'inquiry' => '[' . $validated['subject'] . '] ' . $validated['message'],
        ]);

        // Notify the admin/breeder
        try {
            $adminEmail = optional(WebsiteSetting::first())->email ?: config('mail.from.address');

            Mail::to($adminEmail)->send(new AdminInquiryNotification(
                sourceType: 'Contact Form Inquiry',
                senderName: $validated['name'],
                senderEmail: $validated['email'],
                senderPhone: $validated['phone'] ?? '',
                messageBody: $validated['message'],
                topic: $validated['subject'],
            ));
        } catch (\Exception $e) {
            \Log::error('Failed to send admin contact notification: ' . $e->getMessage());
        }

        return redirect()->route('home')
            ->with('success', 'Thank you for your message! We will get back to you as soon as possible.')
            ->withFragment('contact');
    }
}

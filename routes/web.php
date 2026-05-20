<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SeoSettingController;
use App\Http\Controllers\Admin\SlideShowController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\PetColorController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ReservationApplicationController;
use App\Http\Controllers\Admin\ApplicationMessageController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\CaptchaController;

// Debug route - remove after testing
Route::get('/test-settings', function () {
    $settings = \App\Models\WebsiteSetting::first();
    $count = \App\Models\WebsiteSetting::count();
    $all = \App\Models\WebsiteSetting::all();

    return response()->json([
        'count' => $count,
        'first' => $settings,
        'all' => $all,
        'db_connection' => config('database.default'),
        'db_name' => config('database.connections.mysql.database'),
    ]);
});

// Frontend Routes
Route::get("/", function () {
    return redirect()->route("home");
});
Route::get("/home",[FrontEndController::class,"index"])->name("home");
Route::get("/pets",[FrontEndController::class,"pets"])->name("pets");
Route::get("/pet/{slug}",[FrontEndController::class,"petDetails"])->name("pet.details");
Route::get("/reservation/{pet}",[FrontEndController::class,"showReservation"])->name("reservation.show");
Route::post("/reservation/submit",[FrontEndController::class,"submitReservation"])->name("reservation.submit");
Route::post("/contact",[FrontEndController::class,"submitContact"])->name("contact.submit");
Route::get("/captcha/refresh",[CaptchaController::class,"refresh"])->name("captcha.refresh");

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Admin Profile / Credentials
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');

        // Slide Shows
        Route::resource('slide-shows', SlideShowController::class);

        // Pets
        Route::post('pets/{pet}/toggle-reservation', [PetController::class, 'toggleReservation'])->name('pets.toggle-reservation');
        Route::delete('pets/gallery/{petImage}', [PetController::class, 'deleteGalleryImage'])->name('pets.gallery.delete');
        Route::resource('pets', PetController::class);

        // Pet Colors
        Route::get('pet-colors', [PetColorController::class, 'index'])->name('pet-colors.index');
        Route::post('pet-colors', [PetColorController::class, 'store'])->name('pet-colors.store');
        Route::put('pet-colors/{petColor}', [PetColorController::class, 'update'])->name('pet-colors.update');
        Route::delete('pet-colors/{petColor}', [PetColorController::class, 'destroy'])->name('pet-colors.destroy');

        // About Us
        Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us.index');
        Route::post('about-us', [AboutUsController::class, 'update'])->name('about-us.update');

        // Achievements
        Route::get('achievements', [AchievementController::class, 'index'])->name('achievements.index');
        Route::post('achievements', [AchievementController::class, 'update'])->name('achievements.update');

        // Reservation Applications
        Route::resource('reservation-applications', ReservationApplicationController::class);

        // Application Messages (Ticketing System)
        Route::post('application-messages/{application}/reply', [ApplicationMessageController::class, 'store'])->name('application-messages.reply');
        Route::post('application-messages/{application}/fetch', [ApplicationMessageController::class, 'fetchLatest'])->name('application-messages.fetch');
        Route::patch('application-messages/{message}/mark-read', [ApplicationMessageController::class, 'markRead'])->name('application-messages.mark-read');

        // Inquiries
        Route::post('inquiries/{inquiry}/toggle-read', [InquiryController::class, 'toggleRead'])->name('inquiries.toggle-read');
        Route::resource('inquiries', InquiryController::class);

        // Website Settings
        Route::get('website-settings', [WebsiteSettingController::class, 'index'])->name('website-settings.index');
        Route::post('website-settings', [WebsiteSettingController::class, 'update'])->name('website-settings.update');

        // SEO Settings
        Route::get('seo-settings', [SeoSettingController::class, 'index'])->name('seo-settings.index');
        Route::post('seo-settings', [SeoSettingController::class, 'update'])->name('seo-settings.update');
    });
});

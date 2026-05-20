<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::first();
        return view('admin.pages.about-us.index', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string',
        ]);

        $aboutUs = AboutUs::first();

        $data = $request->only(['title', 'content']);

        // Handle image upload if provided
        if ($request->filled('image')) {
            // Delete old image if exists
            if ($aboutUs && $aboutUs->image && file_exists(public_path($aboutUs->image))) {
                unlink(public_path($aboutUs->image));
            }
            $data['image'] = $this->saveBase64Image($request->image);
        }

        if ($aboutUs) {
            $aboutUs->update($data);
        } else {
            AboutUs::create($data);
        }

        return redirect()->route('admin.about-us.index')
            ->with('success', 'About Us updated successfully');
    }

    private function saveBase64Image($base64Image)
    {
        // Extract base64 data
        $image = str_replace('data:image/png;base64,', '', $base64Image);
        $image = str_replace('data:image/jpg;base64,', '', $image);
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $imageName = time() . '_about_us.png';
        $path = public_path('uploads/about-us/' . $imageName);

        // Create directory if it doesn't exist
        if (!file_exists(public_path('uploads/about-us'))) {
            mkdir(public_path('uploads/about-us'), 0777, true);
        }

        file_put_contents($path, base64_decode($image));

        return 'uploads/about-us/' . $imageName;
    }
}

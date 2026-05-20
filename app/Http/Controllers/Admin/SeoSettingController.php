<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoSettingController extends Controller
{
    public function index()
    {
        $setting = SeoSetting::first();
        return view('admin.pages.seo-settings', compact('setting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'google_analytics' => 'nullable|string',
            'google_tag_manager' => 'nullable|string',
            'facebook_pixel' => 'nullable|string',
        ]);

        $setting = SeoSetting::firstOrNew([]);

        $data = $request->except(['og_image']);

        if ($request->hasFile('og_image')) {
            $ogImage = $request->file('og_image');
            $ogImageName = time() . '_og_image.' . $ogImage->getClientOriginalExtension();
            $ogImage->move(public_path('uploads/settings'), $ogImageName);
            $data['og_image'] = 'uploads/settings/' . $ogImageName;

            if ($setting->og_image && file_exists(public_path($setting->og_image))) {
                unlink(public_path($setting->og_image));
            }
        }

        $setting->fill($data);
        $setting->save();

        return redirect()->route('admin.seo-settings.index')
            ->with('success', 'SEO settings updated successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SlideShow;
use Illuminate\Http\Request;

class SlideShowController extends Controller
{
    public function index()
    {
        $slideShows = SlideShow::orderBy('order', 'asc')->get();
        return view('admin.pages.slide-shows.index', compact('slideShows'));
    }

    public function create()
    {
        return view('admin.pages.slide-shows.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'enable_action_button' => 'nullable|boolean',
            'action_button_text' => 'nullable|string|max:255',
            'action_button_link' => 'nullable|url|max:255',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except(['image']);
        $data['enable_action_button'] = $request->has('enable_action_button');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slide-shows'), $imageName);
            $data['image'] = 'uploads/slide-shows/' . $imageName;
        }

        SlideShow::create($data);

        return redirect()->route('admin.slide-shows.index')
            ->with('success', 'Slide show created successfully');
    }

    public function edit(SlideShow $slideShow)
    {
        return view('admin.pages.slide-shows.edit', compact('slideShow'));
    }

    public function update(Request $request, SlideShow $slideShow)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'enable_action_button' => 'nullable|boolean',
            'action_button_text' => 'nullable|string|max:255',
            'action_button_link' => 'nullable|url|max:255',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $data = $request->except(['image']);
        $data['enable_action_button'] = $request->has('enable_action_button');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slide-shows'), $imageName);
            $data['image'] = 'uploads/slide-shows/' . $imageName;

            if ($slideShow->image && file_exists(public_path($slideShow->image))) {
                unlink(public_path($slideShow->image));
            }
        }

        $slideShow->update($data);

        return redirect()->route('admin.slide-shows.index')
            ->with('success', 'Slide show updated successfully');
    }

    public function destroy(SlideShow $slideShow)
    {
        if ($slideShow->image && file_exists(public_path($slideShow->image))) {
            unlink(public_path($slideShow->image));
        }

        $slideShow->delete();

        return redirect()->route('admin.slide-shows.index')
            ->with('success', 'Slide show deleted successfully');
    }
}

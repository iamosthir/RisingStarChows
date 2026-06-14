<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentPage;
use App\Models\ContentPageImage;
use Illuminate\Http\Request;

class ContentPageController extends Controller
{
    public function index()
    {
        $pages = ContentPage::orderBy('id')->get();
        return view('admin.pages.content-pages.index', compact('pages'));
    }

    public function edit(string $slug)
    {
        $page = ContentPage::with('images')->where('slug', $slug)->firstOrFail();
        return view('admin.pages.content-pages.edit', compact('page'));
    }

    public function update(Request $request, string $slug)
    {
        $page = ContentPage::where('slug', $slug)->firstOrFail();

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'body' => 'nullable|string',
            'inquiry_intro' => 'nullable|string|max:500',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $page->title = $data['title'];
        $page->subtitle = $data['subtitle'] ?? null;
        $page->body = $data['body'] ?? null;
        $page->inquiry_intro = $data['inquiry_intro'] ?? null;

        if ($request->hasFile('hero_image')) {
            if ($page->hero_image && file_exists(public_path($page->hero_image))) {
                @unlink(public_path($page->hero_image));
            }
            $page->hero_image = $this->storeUploadedImage($request->file('hero_image'), 'uploads/content-pages');
        }

        $page->save();

        if ($request->hasFile('gallery_images')) {
            $nextOrder = (int) ($page->images()->max('sort_order') ?? 0);
            foreach ($request->file('gallery_images') as $file) {
                $nextOrder++;
                $page->images()->create([
                    'image' => $this->storeUploadedImage($file, 'uploads/content-pages/gallery'),
                    'sort_order' => $nextOrder,
                ]);
            }
        }

        return redirect()->route('admin.content-pages.edit', $page->slug)
            ->with('success', 'Page updated successfully.');
    }

    public function deleteImage(string $slug, ContentPageImage $image)
    {
        $page = ContentPage::where('slug', $slug)->firstOrFail();
        abort_if($image->content_page_id !== $page->id, 404);
        $image->delete();

        return redirect()->route('admin.content-pages.edit', $page->slug)
            ->with('success', 'Image removed.');
    }

    private function storeUploadedImage($file, string $relativeDir): string
    {
        $absoluteDir = public_path($relativeDir);
        if (!is_dir($absoluteDir)) {
            mkdir($absoluteDir, 0777, true);
        }

        $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($absoluteDir, $name);

        return trim($relativeDir, '/') . '/' . $name;
    }
}

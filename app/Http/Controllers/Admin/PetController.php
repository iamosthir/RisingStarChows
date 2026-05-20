<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\PetColor;
use App\Models\PetImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::orderBy('created_at', 'desc')->get();
        return view('admin.pages.pets.index', compact('pets'));
    }

    public function create()
    {
        $colors = PetColor::orderBy('color_name', 'asc')->get();
        return view('admin.pages.pets.create', compact('colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'call_name' => 'nullable|string|max:255',
            'sire_name' => 'nullable|string|max:255',
            'dam_name' => 'nullable|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'breeder_name' => 'nullable|string|max:255',
            'reg_no' => 'nullable|string|max:255',
            'sex' => 'nullable|in:Male,Female',
            'birthdate' => 'nullable|date',
            'color' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'OFA' => 'nullable|string|max:255',
            'ref_link' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'primaryImg' => 'nullable|string',
            'image' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->all();

        // Generate slug from full_name
        $data['slug'] = Str::slug($request->full_name);

        // Make slug unique if it already exists
        $originalSlug = $data['slug'];
        $count = 1;
        while (Pet::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle cropped primary image
        if ($request->filled('primaryImg')) {
            $data['primaryImg'] = $this->saveBase64Image($request->primaryImg, 'primary');
        }

        // Handle additional images
        if ($request->has('image') && is_array($request->image)) {
            $images = [];
            foreach ($request->image as $base64Image) {
                if (!empty($base64Image)) {
                    $images[] = $this->saveBase64Image($base64Image, 'gallery');
                }
            }
            $data['image'] = $images;
        }

        $pet = Pet::create($data);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $imagePath = $this->saveGalleryImage($image);
                PetImage::create([
                    'pet_id' => $pet->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('admin.pets.index')
            ->with('success', 'Pet created successfully');
    }

    public function edit(Pet $pet)
    {
        $colors = PetColor::orderBy('color_name', 'asc')->get();
        return view('admin.pages.pets.edit', compact('pet', 'colors'));
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'call_name' => 'nullable|string|max:255',
            'sire_name' => 'nullable|string|max:255',
            'dam_name' => 'nullable|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'breeder_name' => 'nullable|string|max:255',
            'reg_no' => 'nullable|string|max:255',
            'sex' => 'nullable|in:Male,Female',
            'birthdate' => 'nullable|date',
            'color' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'OFA' => 'nullable|string|max:255',
            'ref_link' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'primaryImg' => 'nullable|string',
            'image' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->all();

        // Update slug if full_name changed
        if ($request->full_name !== $pet->full_name) {
            $data['slug'] = Str::slug($request->full_name);

            // Make slug unique if it already exists (excluding current pet)
            $originalSlug = $data['slug'];
            $count = 1;
            while (Pet::where('slug', $data['slug'])->where('id', '!=', $pet->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle cropped primary image
        if ($request->filled('primaryImg') && Str::startsWith($request->primaryImg, 'data:image')) {
            // Delete old image
            if ($pet->primaryImg && file_exists(public_path($pet->primaryImg))) {
                unlink(public_path($pet->primaryImg));
            }
            $data['primaryImg'] = $this->saveBase64Image($request->primaryImg, 'primary');
        }

        // Handle additional images
        if ($request->has('image') && is_array($request->image)) {
            $images = [];
            foreach ($request->image as $base64Image) {
                if (!empty($base64Image) && Str::startsWith($base64Image, 'data:image')) {
                    $images[] = $this->saveBase64Image($base64Image, 'gallery');
                } elseif (!empty($base64Image)) {
                    // Keep existing image path
                    $images[] = $base64Image;
                }
            }
            $data['image'] = $images;
        }

        $pet->update($data);

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $imagePath = $this->saveGalleryImage($image);
                PetImage::create([
                    'pet_id' => $pet->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect()->route('admin.pets.index')
            ->with('success', 'Pet updated successfully');
    }

    public function destroy(Pet $pet)
    {
        // Delete primary image
        if ($pet->primaryImg && file_exists(public_path($pet->primaryImg))) {
            unlink(public_path($pet->primaryImg));
        }

        // Delete gallery images
        if ($pet->image && is_array($pet->image)) {
            foreach ($pet->image as $image) {
                if (file_exists(public_path($image))) {
                    unlink(public_path($image));
                }
            }
        }

        $pet->delete();

        return redirect()->route('admin.pets.index')
            ->with('success', 'Pet deleted successfully');
    }

    public function toggleReservation(Pet $pet)
    {
        $pet->is_reserved = !$pet->is_reserved;
        $pet->save();

        $status = $pet->is_reserved ? 'reserved' : 'available';

        return redirect()->route('admin.pets.index')
            ->with('success', "Pet marked as {$status} successfully");
    }

    public function deleteGalleryImage(PetImage $petImage)
    {
        try {
            $petImage->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    private function saveBase64Image($base64Image, $type = 'primary')
    {
        // Extract base64 data
        $image = str_replace('data:image/png;base64,', '', $base64Image);
        $image = str_replace('data:image/jpg;base64,', '', $image);
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $imageName = time() . '_' . uniqid() . '_' . $type . '.png';
        $path = public_path('uploads/pets/' . $imageName);

        // Create directory if it doesn't exist
        if (!file_exists(public_path('uploads/pets'))) {
            mkdir(public_path('uploads/pets'), 0777, true);
        }

        file_put_contents($path, base64_decode($image));

        return 'uploads/pets/' . $imageName;
    }

    private function saveGalleryImage($image)
    {
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $path = 'uploads/pet-gallery/' . $imageName;

        // Create directory if it doesn't exist
        if (!file_exists(public_path('uploads/pet-gallery'))) {
            mkdir(public_path('uploads/pet-gallery'), 0777, true);
        }

        $image->move(public_path('uploads/pet-gallery'), $imageName);

        return '/' . $path;
    }
}

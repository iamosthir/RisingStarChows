<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PetColor;
use Illuminate\Http\Request;

class PetColorController extends Controller
{
    public function index()
    {
        $colors = PetColor::orderBy('color_name', 'asc')->get();
        return view('admin.pages.pets.colors', compact('colors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'color_name' => 'required|string|max:255|unique:pet_colors,color_name',
        ]);

        PetColor::create($request->all());

        return redirect()->route('admin.pet-colors.index')
            ->with('success', 'Color added successfully');
    }

    public function update(Request $request, PetColor $petColor)
    {
        $request->validate([
            'color_name' => 'required|string|max:255|unique:pet_colors,color_name,' . $petColor->id,
        ]);

        $petColor->update($request->all());

        return redirect()->route('admin.pet-colors.index')
            ->with('success', 'Color updated successfully');
    }

    public function destroy(PetColor $petColor)
    {
        $petColor->delete();

        return redirect()->route('admin.pet-colors.index')
            ->with('success', 'Color deleted successfully');
    }
}

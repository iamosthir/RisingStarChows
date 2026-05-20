<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $achievement = Achievement::first();

        if (!$achievement) {
            $achievement = Achievement::create([
                'competition_wins' => 0,
                'best_in_shows' => 0,
                'champions' => 0,
                'international_shows' => 0,
            ]);
        }

        return view('admin.pages.achievements.index', compact('achievement'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'competition_wins' => 'required|integer|min:0',
            'best_in_shows' => 'required|integer|min:0',
            'champions' => 'required|integer|min:0',
            'international_shows' => 'required|integer|min:0',
        ]);

        $achievement = Achievement::first();

        if (!$achievement) {
            $achievement = Achievement::create($validated);
        } else {
            $achievement->update($validated);
        }

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Achievements updated successfully.');
    }
}

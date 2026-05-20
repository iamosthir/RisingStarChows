<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReservationApplication;
use App\Models\Pet;
use App\Models\PetColor;
use Illuminate\Http\Request;

class ReservationApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = ReservationApplication::with('pet')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.pages.reservation-applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pets = Pet::orderBy('full_name', 'asc')->get();
        $colors = PetColor::orderBy('color_name', 'asc')->get();
        return view('admin.pages.reservation-applications.create', compact('pets', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female,Litter',
            'color' => 'required|string|max:255',
            'inquiry' => 'required|string',
        ]);

        ReservationApplication::create($request->all());

        return redirect()->route('admin.reservation-applications.index')
            ->with('success', 'Reservation application created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReservationApplication $reservationApplication)
    {
        $reservationApplication->load([
            'pet',
            'messages' => function ($query) {
                $query->orderBy('sent_at', 'desc');
            },
            'messages.sender'
        ]);
        return view('admin.pages.reservation-applications.show', compact('reservationApplication'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReservationApplication $reservationApplication)
    {
        $pets = Pet::orderBy('full_name', 'asc')->get();
        $colors = PetColor::orderBy('color_name', 'asc')->get();
        return view('admin.pages.reservation-applications.edit', compact('reservationApplication', 'pets', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReservationApplication $reservationApplication)
    {
        $request->validate([
            'pet_id' => 'required|exists:pets,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'gender' => 'required|in:Male,Female,Litter',
            'color' => 'required|string|max:255',
            'inquiry' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $reservationApplication->update($request->all());

        return redirect()->route('admin.reservation-applications.index')
            ->with('success', 'Reservation application updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReservationApplication $reservationApplication)
    {
        $reservationApplication->delete();

        return redirect()->route('admin.reservation-applications.index')
            ->with('success', 'Reservation application deleted successfully');
    }
}

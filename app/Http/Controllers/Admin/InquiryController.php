<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inquiries = Inquiry::orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.pages.inquiries.index', compact('inquiries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.inquiries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'inquiry' => 'required|string',
        ]);

        Inquiry::create($request->all());

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inquiry $inquiry)
    {
        // Auto-mark as read when viewing
        if (!$inquiry->is_read) {
            $inquiry->update(['is_read' => true]);
        }

        return view('admin.pages.inquiries.show', compact('inquiry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inquiry $inquiry)
    {
        return view('admin.pages.inquiries.edit', compact('inquiry'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'inquiry' => 'required|string',
        ]);

        $inquiry->update($request->all());

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully');
    }

    /**
     * Toggle read/unread status.
     */
    public function toggleRead(Inquiry $inquiry)
    {
        $inquiry->is_read = !$inquiry->is_read;
        $inquiry->save();

        $status = $inquiry->is_read ? 'read' : 'unread';

        return redirect()->route('admin.inquiries.index')
            ->with('success', "Inquiry marked as {$status} successfully");
    }
}

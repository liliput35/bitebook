<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    // View thread
    public function show($id)
    {
        $inquiry = Inquiry::with(['sender', 'replies.sender'])->findOrFail($id);
        return view('admin.inquiries', compact('inquiry'));
    }

    // Store MAIN inquiry (user)
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required',
            'message' => 'required'
        ]);

        Inquiry::create([
            'booking_id' => $request->booking_id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'status' => 'new',
            'parent_id' => null,
        ]);

        return back()->with('success', 'Inquiry sent');
    }

    // Reply (admin OR user)
    public function reply(Request $request, $id)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $parent = Inquiry::findOrFail($id);

        Inquiry::create([
            'booking_id' => $parent->booking_id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'status' => 'open',
            'parent_id' => $parent->id,
        ]);

        if (Auth::user()->role === 'admin') {
            $parent->status = 'responded';
        } else {
            $parent->status = 'new';
        }

        $parent->save();

        return back()->with('success', 'Reply sent');
    }

    // Delete
    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();

        return back()->with('success', 'Deleted');
    }
}
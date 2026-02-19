<?php

namespace App\Http\Controllers;

use App\Models\PropertyMessage;
use App\Models\AvailableProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyMessageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:available_properties,id',
            'message' => 'required|string|max:1000',
        ]);

        $property = AvailableProperty::findOrFail($request->property_id);
        $receiverId = $property->user_id ?? 1; // Default to admin if no user_id

        if ($receiverId == Auth::id()) {
            return back()->with('error', 'You cannot send a message to yourself.');
        }

        PropertyMessage::create([
            'available_property_id' => $property->id,
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'message' => $request->message,
            'is_read' => false,
        ]);

        return back()->with('success', 'Message sent successfully!');
    }

    /**
     * Display a listing of the resource for the logged-in user.
     */
    public function index()
    {
        $messages = PropertyMessage::with(['sender', 'property'])
            ->where('receiver_id', Auth::id())
            ->orWhere('sender_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.messages.index', compact('messages'));
    }
}

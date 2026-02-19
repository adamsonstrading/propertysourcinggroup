<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyMessage;
use App\Models\User;
use App\Models\AvailableProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Fetch all messages involving the current user
        $allMessages = PropertyMessage::with(['property', 'sender', 'receiver'])
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        $conversations = [];
        $processedKeys = [];

        foreach ($allMessages as $msg) {
            $propertyId = $msg->available_property_id;

            // Determine the "other user"
            if ($msg->sender_id == $userId) {
                $otherUser = $msg->receiver;
            } else {
                $otherUser = $msg->sender;
            }

            if (!$msg->property || !$otherUser)
                continue;

            $otherUserId = $otherUser->id;

            // Unique key for conversation: property_id + other_user_id
            $key = $propertyId . '_' . $otherUserId;

            if (!in_array($key, $processedKeys)) {
                $conversations[] = (object) [
                    'property' => $msg->property,
                    'other_user' => $otherUser, // Could be Agent or Regular User
                    'last_message' => $msg, // Includes created_at, message content
                    'unread_count' => PropertyMessage::where('available_property_id', $propertyId)
                        ->where('sender_id', $otherUserId) // Sent by them
                        ->where('receiver_id', $userId)   // To me
                        ->where('is_read', 0)
                        ->count()
                ];
                $processedKeys[] = $key;
            }
        }

        return view('admin.messages.index', compact('conversations'));
    }

    public function fetchMessages(Request $request)
    {
        $userId = Auth::id();
        $propertyId = $request->property_id;
        $otherUserId = $request->other_user_id;

        // Fetch conversation between Auth user and Other user about Property
        $messages = PropertyMessage::with(['sender', 'receiver'])
            ->where('available_property_id', $propertyId)
            ->where(function ($q) use ($userId, $otherUserId) {
                $q->where(function ($q2) use ($userId, $otherUserId) {
                    $q2->where('sender_id', $userId)->where('receiver_id', $otherUserId);
                })->orWhere(function ($q2) use ($userId, $otherUserId) {
                    $q2->where('sender_id', $otherUserId)->where('receiver_id', $userId);
                });
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark as read (messages sent by other user to me)
        PropertyMessage::where('available_property_id', $propertyId)
            ->where('sender_id', $otherUserId)
            ->where('receiver_id', $userId)
            ->where('is_read', 0)
            ->update(['is_read' => 1]);

        return response()->json([
            'messages' => $messages,
            'auth_id' => $userId
        ]);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'property_id' => 'required',
            'recipient_id' => 'required', // The ID of the other user
            'message' => 'required|string'
        ]);

        $message = PropertyMessage::create([
            'available_property_id' => $request->property_id,
            'sender_id' => Auth::id(),
            'receiver_id' => $request->recipient_id,
            'message' => $request->message,
            'is_read' => 0
        ]);

        // Return structured data for frontend
        $message->load('sender');

        return response()->json([
            'status' => 'success',
            'message' => $message
        ]);
    }
}

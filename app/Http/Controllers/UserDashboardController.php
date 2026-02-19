<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // You might want to pass counts or recent activity to the dashboard
        $offersCount = $user->offers()->count();
        $favoritesCount = $user->favorites()->count();
        $unreadMessagesCount = \App\Models\PropertyMessage::where('receiver_id', $user->id)->where('is_read', false)->count();

        return view('user.dashboard', compact('user', 'offersCount', 'favoritesCount', 'unreadMessagesCount'));
    }
}

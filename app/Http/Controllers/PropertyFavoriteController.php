<?php

namespace App\Http\Controllers;

use App\Models\PropertyFavorite;
use App\Models\AvailableProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyFavoriteController extends Controller
{
    /**
     * Toggle favorite status for a property.
     */
    public function toggle(AvailableProperty $property)
    {
        $user = Auth::user();

        // Check if already favorited
        $existing = PropertyFavorite::where('user_id', $user->id)
            ->where('available_property_id', $property->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $status = 'removed';
            $message = 'Property removed from favorites.';
        } else {
            PropertyFavorite::create([
                'user_id' => $user->id,
                'available_property_id' => $property->id,
            ]);
            $status = 'added';
            $message = 'Property added to favorites.';
        }

        if (request()->wantsJson()) {
            return response()->json(['status' => $status, 'message' => $message]);
        }

        return back()->with('success', $message);
    }

    /**
     * Display a listing of the favorited properties for the logged-in user.
     */
    public function index()
    {
        $favorites = PropertyFavorite::with('property')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.favorites.index', compact('favorites'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustpilotReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TrustpilotReviewController extends Controller
{
    public function index()
    {
        $reviews = TrustpilotReview::latest()->get();
        return view('admin.trustpilot_reviews.index', compact('reviews'));
    }

    public function create()
    {
        return view('admin.trustpilot_reviews.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rating_stars' => 'required|numeric|min:0|max:5',
            'review_text' => 'required|string',
            'is_active' => 'boolean',
        ]);

        // Default valid checkbox to false if not present
        if (!$request->has('is_active')) {
            $validated['is_active'] = false;
        }

        TrustpilotReview::create($validated);
        Cache::forget('homepage_trustpilot_reviews');

        return redirect()->route('admin.trustpilot-reviews.index')->with('success', 'Review added successfully.');
    }

    public function edit(TrustpilotReview $trustpilot_review)
    {
        return view('admin.trustpilot_reviews.edit', compact('trustpilot_review'));
    }

    public function update(Request $request, TrustpilotReview $trustpilot_review)
    {
        $validated = $request->validate([
            'rating_stars' => 'required|numeric|min:0|max:5',
            'review_text' => 'required|string',
            'is_active' => 'boolean',
        ]);

        if (!$request->has('is_active')) {
            $validated['is_active'] = false;
        }

        $trustpilot_review->update($validated);
        Cache::forget('homepage_trustpilot_reviews');

        return redirect()->route('admin.trustpilot-reviews.index')->with('success', 'Review updated successfully.');
    }

    public function destroy(TrustpilotReview $trustpilot_review)
    {
        $trustpilot_review->delete();
        Cache::forget('homepage_trustpilot_reviews');
        return redirect()->route('admin.trustpilot-reviews.index')->with('success', 'Review deleted successfully.');
    }
}

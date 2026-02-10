<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MarketingPurpose;

class MarketingPurposeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marketingPurposes = MarketingPurpose::latest()->paginate(10);
        return view('admin.marketing_purposes.index', compact('marketingPurposes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.marketing_purposes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:marketing_purposes,name',
        ]);

        MarketingPurpose::create($request->only('name'));

        return redirect()->route('admin.marketing-purposes.index')->with('success', 'Marketing Purpose created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marketingPurpose = MarketingPurpose::findOrFail($id);
        return view('admin.marketing_purposes.edit', compact('marketingPurpose'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:marketing_purposes,name,' . $id,
        ]);

        $marketingPurpose = MarketingPurpose::findOrFail($id);
        $marketingPurpose->update($request->only('name'));

        return redirect()->route('admin.marketing-purposes.index')->with('success', 'Marketing Purpose updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $marketingPurpose = MarketingPurpose::findOrFail($id);
        $marketingPurpose->delete();

        return redirect()->route('admin.marketing-purposes.index')->with('success', 'Marketing Purpose deleted successfully.');
    }
}

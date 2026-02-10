<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UnitType;
use App\Models\PropertyType;

class UnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitTypes = UnitType::with('propertyType')->latest()->paginate(10);
        return view('admin.unit_types.index', compact('unitTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $propertyTypes = PropertyType::all();
        return view('admin.unit_types.create', compact('propertyTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:unit_types,name',
            'property_type_id' => 'required|exists:property_types,id',
        ]);

        UnitType::create($request->only('name', 'property_type_id'));

        return redirect()->route('admin.unit-types.index')->with('success', 'Unit Type created successfully.');
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
        $unitType = UnitType::findOrFail($id);
        $propertyTypes = PropertyType::all();
        return view('admin.unit_types.edit', compact('unitType', 'propertyTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:unit_types,name,' . $id,
            'property_type_id' => 'required|exists:property_types,id',
        ]);

        $unitType = UnitType::findOrFail($id);
        $unitType->update($request->only('name', 'property_type_id'));

        return redirect()->route('admin.unit-types.index')->with('success', 'Unit Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unitType = UnitType::findOrFail($id);
        $unitType->delete();

        return redirect()->route('admin.unit-types.index')->with('success', 'Unit Type deleted successfully.');
    }
}

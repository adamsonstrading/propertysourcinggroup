<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkStep;
use Illuminate\Http\Request;

class WorkStepController extends Controller
{
    public function index()
    {
        $steps = WorkStep::orderBy('sort_order')->get();
        return view('admin.work-steps.index', compact('steps'));
    }

    public function create()
    {
        return view('admin.work-steps.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        WorkStep::create($validated);

        return redirect()->route('admin.work-steps.index')->with('success', 'Work step added successfully.');
    }

    public function edit(WorkStep $workStep)
    {
        return view('admin.work-steps.edit', compact('workStep'));
    }

    public function update(Request $request, WorkStep $workStep)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $workStep->update($validated);

        return redirect()->route('admin.work-steps.index')->with('success', 'Work step updated successfully.');
    }

    public function destroy(WorkStep $workStep)
    {
        $workStep->delete();
        return redirect()->route('admin.work-steps.index')->with('success', 'Work step deleted successfully.');
    }
}

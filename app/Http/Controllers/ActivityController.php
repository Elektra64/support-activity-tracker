<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ActivityController extends Controller
{
    public function index(): View
    {
        $activities = Activity::with(['author', 'assignedUsers'])->latest()->get();
        return view('activities.index', compact('activities'));
    }

    public function create(): View
    {
        return view('activities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $activity = Activity::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'user_id' => auth()->id()
        ]);

        return redirect()->route('activities.index')
            ->with('success', 'Activity created successfully.');
    }

    public function show(Activity $activity): View
    {
        $activity->load(['author', 'assignedUsers']);
        $updates = $activity->updates()->with('user')->latest()->get();
        
        return view('activities.show', compact('activity', 'updates'));
    }

    public function edit(Activity $activity): View
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        $activity->update($validated);

        return redirect()->route('activities.show', $activity)
            ->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return redirect()->route('activities.index')
            ->with('success', 'Activity deleted successfully.');
    }

    public function assigned(): View
    {
        $activities = auth()->user()
            ->assignedActivities()
            ->with(['author', 'assignedUsers'])
            ->latest()
            ->get();

        return view('activities.assigned', compact('activities'));
    }
}
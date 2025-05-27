<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivityUpdate;
use Illuminate\Support\Facades\Auth;
use App\Exports\ActivityUpdatesExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Report;

class ActivityUpdateController extends Controller
{
    /**
     * Show a dashboard view with today's updates grouped.
     */
    public function dashboard()
    {
        $today = now()->format('Y-m-d');
        $activities = Activity::all();
        $updates = ActivityUpdate::with('activity', 'user')
            ->whereDate('created_at', $today)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('activities', 'updates'));
    }

    /**
     * Display form to submit a new activity update.
     */
    public function index()
    {
        $updates = ActivityUpdate::with('activity', 'user')
            ->latest()
            ->get();
        return view('updates.index', compact('updates'));
    }

    public function create()
    {
        $activities = Activity::all();
        return view('updates.form', compact('activities'));
    }

    /**
     * Store the update provided by the user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|exists:activities,id',
            'status' => 'required|in:done,pending',
            'remark' => 'nullable|string|max:1000',
          
        ]);

        $user = auth()->user();

        ActivityUpdate::create([
            'activity_id' => $request->activity_id,
            'user_id' => Auth::id(),
            'status' => $request->status,
            'remark' => $request->remark,
            'bio_snapshot'  => $user->name . ' (' . $user->email . ') (' . $user->department . ') (' . $user->phone . ')',
        ]);

        return redirect()->route('updates.index')->with('success', 'Activity update recorded.');
        }

        /**
         * View updates within a custom date range.
         */
        public function report(Request $request)
        {
            $updates = null;

            if ($request->filled('from') && $request->filled('to')) {
                $request->validate([
                    'from' => 'required|date',
                    'to' => 'required|date|after_or_equal:from',
                ]);

                $updates = \App\Models\ActivityUpdate::with('activity')
                    ->whereDate('created_at', '>=', $request->from)
                    ->whereDate('created_at', '<=', $request->to)
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $updates = \App\Models\ActivityUpdate::with('activity')
                    ->orderBy('created_at', 'desc')
                    ->get();
            }

            return view('reports.index', compact('updates'));
        }
    }

<?php
namespace App\Http\Controllers;

use App\Models\ActivityUpdate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Report;

class ReportController extends Controller
{
    public function report()
    {
        if (auth()->user()->is_admin) {
            $updates = ActivityUpdate::with('activity')
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $updates = ActivityUpdate::with('activity')
                ->where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('reports.index', compact('updates'));
    }

    public function index(Request $request)
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
        }

        return view('reports.index', compact('updates'));
    }

    public function exportPdf()
    {
        if (!auth()->user()->is_admin) {
            return response()->json(['error' => 'Unauthorized: Admins only'], 403);
        }
        $updates = ActivityUpdate::with('activity')->latest()->get();

        $pdf = PDF::loadView('exports.activity-updates-pdf', compact('updates'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('activity-updates.pdf');
    }
}

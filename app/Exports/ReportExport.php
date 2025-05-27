<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use App\Models\ActivityUpdate;

class ReportExport implements FromCollection
{
    protected $from;
    protected $to;

    // Accept date range or filters in the constructor
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Return a collection of data to export
     */
    public function collection()
    {
        // Filter activity updates by date range
        return ActivityUpdate::whereDate('created_at', '>=', $this->from)
            ->whereDate('created_at', '<=', $this->to)
            ->with('activity') // eager load activity if needed
            ->get()
            ->map(function($update) {
                return collect([
                    'Activity Title' => $update->activity->title ?? 'N/A',
                    'Status' => ucfirst($update->status),
                    'Remark' => $update->remark,
                    'Bio Snapshot' => $update->bio_snapshot,
                    'Date' => $update->created_at->format('Y-m-d H:i'),
                ]);
            });
    }
}

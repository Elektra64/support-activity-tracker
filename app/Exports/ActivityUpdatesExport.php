<?php

namespace App\Exports;

use App\Models\ActivityUpdate;
use Maatwebsite\Excel\Concerns\FromCollection;


class ActivityUpdatesExport implements FromCollection
{
    public function collection()
    {
        return ActivityUpdate::all();
    }
}

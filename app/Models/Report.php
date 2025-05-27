<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'status',
        'remark',
        'bio',
        
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}

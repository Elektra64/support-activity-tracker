<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;
use App\Models\User;

class ActivityUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'user_id',
        'status',
        'remark',
        'bio_snapshot',
    ];

    /**
     * This update belongs to a specific activity.
     */
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * This update was created by a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}


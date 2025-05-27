<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'description', 
        'user_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'activity_user')
                    ->withTimestamps();
    }


    /**
     * An activity has many updates from different users.
     */
    public function updates()
    {
        return $this->hasMany(ActivityUpdate::class);
    }
}

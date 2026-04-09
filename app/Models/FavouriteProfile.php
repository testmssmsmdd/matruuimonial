<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavouriteProfile extends Model
{
    protected $fillable = [
        'profile_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }
}

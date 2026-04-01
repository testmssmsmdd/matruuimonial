<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery_photos extends Model
{
    protected $fillable = [
        'profile_id',
        'image',
        'is_profile_photo',
    ];
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}

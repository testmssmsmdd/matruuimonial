<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mosal extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'profile_id',
        'person_name',
        'contact_number',
    ];


    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}

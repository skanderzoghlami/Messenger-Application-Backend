<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;
    //this is the function used to represent the relationship
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

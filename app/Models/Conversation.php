<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    //this property represents the fields that will be added in the database
    protected $fillable = ['user_id','second_user_id'] ;
    //this is the function used to represent the relationship
    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }
}

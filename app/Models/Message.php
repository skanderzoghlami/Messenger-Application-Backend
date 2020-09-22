<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   //this property represents the fields that will be added in the database
    protected $fillable = ['body','user_id','read','conversation_id'] ;
    use HasFactory;
    //this is the function used to represent the relationship
    public function conversation()
    {
        return $this->belongsTo('App\Models\Conversation');
    }
}

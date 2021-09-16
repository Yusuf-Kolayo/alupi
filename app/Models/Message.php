<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function receiver() {
        return $this->hasOne(User::class, 'user_id', 'receiver_id');
    }

    public function sender() {
        return $this->hasOne(User::class, 'user_id', 'sender_id');
    }
 
}

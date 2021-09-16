<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use App\Models\User; 

 


class Active_state extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user() {
        return $this->hasOne(User::class, 'user_id', 'staff_id');
    }
}

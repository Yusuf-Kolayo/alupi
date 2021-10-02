<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Catchment;
use App\Models\Agent;

class Vendor extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user() {
        return $this->hasOne(User::class, 'user_id', 'vendor_id');
    }


 

    function delete() {
        $this->user()->delete();
        parent::delete();
    }
}
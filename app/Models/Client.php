<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Catchment;
use App\Models\Agent;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user() {
        return $this->hasOne(User::class, 'user_id', 'client_id');
    }


    public function agent() {
        return $this->belongsTo(Agent::class, 'agent_id', 'agent_id');
    }


    public function has_agent () {  
         if ($this->agent_id==null) {
            return false;
         } else  { return true; }       
    }

    public function transaction () {
        return $this->hasMany('App\Models\Transaction', 'client_id', 'client_id');
    } 

    public function product_purchase_session () {
        return $this->hasMany('App\Models\Product_purchase_session', 'client_id', 'client_id');
    } 


    function delete() {
        $this->transaction()->delete();
        $this->product_purchase_session()->delete();
        $this->user()->delete();
        parent::delete();
    }
}
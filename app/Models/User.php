<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Notification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'username',
        'email',
        'password',
        'usr_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function staff() {
        return $this->hasOne('App\Models\Staffs', 'staff_id', 'user_id');
    }  


    public function agent() {
        return $this->hasOne('App\Models\Agent', 'agent_id', 'user_id');
    }  


    public function client() {
        return $this->hasOne('App\Models\Client', 'client_id', 'user_id');
    }  

    public function vendor() {
        return $this->hasOne('App\Models\Vendor', 'vendor_id', 'user_id');
    }   


    public function notification () {
        return $this->hasMany('App\Models\Notification', 'receiver_id', 'user_id');
    } 

    // public function message () {
    //     return $this->hasMany('App\Models\Notification', 'receiver_id', 'user_id');
    // } 
}

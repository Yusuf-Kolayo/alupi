<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\user; 

class Product_purchase_session extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function transaction () {
        return $this->hasMany('App\Models\Transaction', 'pps_id', 'pps_id')->orderBy('id');
    } 

    public function product () {
        return $this->hasOne('App\Models\Product', 'product_id', 'product_id');
    } 

    public function client () {
        return $this->hasOne('App\Models\Client', 'client_id', 'client_id');
    } 

    function delete() {
        $this->transaction()->delete();
        parent::delete();
    }
 
}

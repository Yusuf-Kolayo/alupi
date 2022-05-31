<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function brand() {
        return $this->belongsTo('App\Models\Brand', 'brand_id', 'id');
    } 

    public function main_category() {
        return $this->belongsTo('App\Models\Category', 'main_category_id', 'id');
    } 

    public function sub_category() {
        return $this->belongsTo('App\Models\Category', 'sub_category_id', 'id');
    } 

    public function vendor_price() {
        return $this->hasMany('App\Models\Vendor_price', 'product_id', 'product_id')->orderBy('price', 'desc');
    } 


    public function product_purchase_session() {
        return $this->hasMany('App\Models\Product_purchase_session', 'product_id', 'product_id');
    } 
}

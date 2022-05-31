<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Models\Vendor; 
use App\Models\Product; 

class Vendor_price extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function vendor() {
        return $this->hasOne(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function outright_price_vnd () {  
        $var = ((15/100) * $this->price ) + $this->price;
        return $var;
    }

    public function install_price_vnd () {  
        $var = ((20/100) * $this->price ) + $this->price;
        return $var;
    }

}
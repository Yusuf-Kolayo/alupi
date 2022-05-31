<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Brand extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function products () {
        return $this->hasMany('App\Models\Product', 'brand_id', 'id');
    }
    

    public function slug () {  
        $var =  strtolower(str_replace(' ','-',$this->brd_name));
        $var = str_replace('&','-',$var);
        return $var;
    }
 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Trans_docs_detail;
use App\Models\Vendor;
use App\Models\Client;

   
class Trans_doc extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = [];


    public function trans_doc_details () {
        return $this->hasMany(Trans_docs_detail::class, 'doc_id', 'doc_id');
    }

    public function vendor () {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'vendor_id');
    }

    public function client () {
        return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }
}
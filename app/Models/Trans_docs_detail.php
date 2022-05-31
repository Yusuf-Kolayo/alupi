<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Trans_doc;


class Trans_docs_detail extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guarded = [];

    public $timestamps = false;


    public function trans_doc () {
        return $this->belongsTo(Trans_doc::class, 'doc_id', 'doc_id');
    }
}

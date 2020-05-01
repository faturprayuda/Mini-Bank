<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = [];

    // relasi one to one ke user
    public function rekening()
    {
        return $this->belongsTo('App\Rekening', 'id_rekening', 'id');
    }
}

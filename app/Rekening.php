<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $guarded = [];

    // relasi one to one ke user
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi', 'id_rekening', 'id');
    }
}

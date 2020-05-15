<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Rekening extends Model
{

    use SoftDeletes;


    protected $guarded = [];
    protected $fillable = [
        'saldo',
    ];

    // relasi one to one ke user
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi', 'id_rekening', 'id');
    }

    // mencari id dari norek
    public static function findId($norek)
    {
        return static::select('id')->where('no_rekening', $norek)->first();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkunVirtual extends Model
{
    protected $guarded = [];

    // relasi one to one ke user
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // mencari id dari norek
    public static function findId($va)
    {
        return static::select('id')->where('no_va', $va)->first();
    }
}

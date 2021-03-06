<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'address', 'no_phone', 'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // relasi one to one ke rekening
    // fungsi yang berfungsi untuk memangil class Rekening pada relasi
    public function rekening()
    {
        return $this->hasOne('App\Rekening');
    }

    public function akunvirtual()
    {
        return $this->hasOne('App\AkunVirtual');
    }

    // mencari id dari nama
    public static function findId($name)
    {
        return static::select('id')->where('name', $name)->first();
    }
}

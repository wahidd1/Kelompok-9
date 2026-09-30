<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    protected $table = 'pengguna';

    protected $primaryKey = 'id_pengguna';

    public $timestamps = false;

    protected $fillable = [
        'username',
        'email',
        'password',
        'gender',
        'umur',
        'tanggal_daftar',
    ];

    protected $hidden = [
        'password',
    ];
}

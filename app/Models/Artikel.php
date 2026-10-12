<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel_edukasi';
    protected $primaryKey = 'id_artikel';
    public $timestamps = false;

    protected $fillable = [
        'id_admin',
        'judul',
        'konten',
        'tanggalPublish',
        'sumber',
    ];

    protected $casts = [
        'tanggalPublish' => 'datetime',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
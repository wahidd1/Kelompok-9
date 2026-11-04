<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id_feedback';
    public $timestamps = false;

    protected $fillable = ['id_admin', 'id_pengguna', 'isi_feedback', 'tanggal'];
    protected $casts = ['tanggal' => 'datetime'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }
}
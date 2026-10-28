<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PilihanJawaban extends Model
{
    protected $table = 'pilihan_jawaban';
    protected $primaryKey = 'id_pilihan';
    public $timestamps = false;

    protected $fillable = ['id_pertanyaan', 'opsi', 'is_benar'];

    protected $casts = ['is_benar' => 'boolean'];

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan', 'id_pertanyaan');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanPengguna extends Model
{
    protected $table = 'jawaban_pengguna';
    protected $primaryKey = 'id_jawaban';
    public $timestamps = false;

    protected $fillable = ['id_hasil', 'id_pengguna', 'id_pertanyaan', 'id_pilihan', 'waktu_jawab'];

    protected $casts = ['waktu_jawab' => 'datetime'];

    public function hasil()
    {
        return $this->belongsTo(HasilKuis::class, 'id_hasil', 'id_hasil');
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan', 'id_pertanyaan');
    }

    public function pilihan()
    {
        return $this->belongsTo(PilihanJawaban::class, 'id_pilihan', 'id_pilihan');
    }
}
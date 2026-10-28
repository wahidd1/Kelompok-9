<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';
    public $timestamps = false;

    protected $fillable = ['id_kuis', 'pertanyaan', 'tipe'];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis', 'id_kuis');
    }

    public function pilihan()
    {
        return $this->hasMany(PilihanJawaban::class, 'id_pertanyaan', 'id_pertanyaan')
            ->orderBy('id_pilihan');
    }
}
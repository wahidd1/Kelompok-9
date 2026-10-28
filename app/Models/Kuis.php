<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kuis extends Model
{
    protected $table = 'kuis';
    protected $primaryKey = 'id_kuis';
    public $timestamps = false;

    protected $fillable = ['id_admin', 'judul', 'deskripsi', 'tanggal'];

    protected $casts = ['tanggal' => 'datetime'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'id_kuis', 'id_kuis');
    }

    // Bikin 1 kuis LENGKAP: kuis + semua soal + 4 pilihan tiap soal, sekali panggil.
    // DB::transaction: kalau satu bagian gagal di tengah, SEMUANYA dibatalkan.
    public static function buatLengkap(array $data, int $idAdmin): self
    {
        return DB::transaction(function () use ($data, $idAdmin) {
            $kuis = self::create([
                'id_admin' => $idAdmin,
                'judul' => $data['judul'],
                'deskripsi' => $data['deskripsi'] ?? null,
                'tanggal' => $data['tanggal'],
            ]);

            foreach ($data['soal'] as $soal) {
                $pertanyaan = $kuis->pertanyaan()->create([
                    'pertanyaan' => $soal['pertanyaan'],
                    'tipe' => 'pilihan_ganda',
                ]);

                foreach (array_values($soal['opsi']) as $urutan => $teks) {
                    $pertanyaan->pilihan()->create([
                        'opsi' => $teks,
                        'is_benar' => ((int) $soal['benar'] === $urutan),
                    ]);
                }
            }

            return $kuis;
        });
    }
}
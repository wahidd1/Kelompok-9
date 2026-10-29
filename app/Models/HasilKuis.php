<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HasilKuis extends Model
{
    protected $table = 'hasil_kuis';
    protected $primaryKey = 'id_hasil';
    public $timestamps = false;

    protected $fillable = ['id_pengguna', 'id_kuis', 'skor', 'skor_benar', 'skor_salah', 'tanggal'];

    protected $casts = ['tanggal' => 'datetime'];

    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'id_kuis', 'id_kuis');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }

    public function jawaban()
    {
        return $this->hasMany(JawabanPengguna::class, 'id_hasil', 'id_hasil')->orderBy('id_jawaban');
    }

    // $jawaban berbentuk [id_pertanyaan => id_pilihan], persis format yang dikirim form kuis.
    // Fungsi ini yang MENGHITUNG SKOR. Ditaruh di Model (bukan Controller) sesuai arahan MVC.
    public static function simpanDariJawaban(int $idPengguna, Kuis $kuis, array $jawaban): self
    {
        return DB::transaction(function () use ($idPengguna, $kuis, $jawaban) {
            $kuis->loadMissing('pertanyaan.pilihan');

            $hasil = self::create([
                'id_pengguna' => $idPengguna,
                'id_kuis' => $kuis->id_kuis,
                'skor' => 0,
                'skor_benar' => 0,
                'skor_salah' => 0,
                'tanggal' => now(),
            ]);

            $benar = 0;

            foreach ($kuis->pertanyaan as $soal) {
                // Pilihan HARUS milik soal ini, supaya id pilihan "palsu" dari soal lain nggak dihitung
                $pilihan = $soal->pilihan->firstWhere('id_pilihan', (int) ($jawaban[$soal->id_pertanyaan] ?? 0));

                if (! $pilihan) {
                    continue;
                }

                JawabanPengguna::create([
                    'id_hasil' => $hasil->id_hasil,
                    'id_pengguna' => $idPengguna,
                    'id_pertanyaan' => $soal->id_pertanyaan,
                    'id_pilihan' => $pilihan->id_pilihan,
                    'waktu_jawab' => now(),
                ]);

                if ($pilihan->is_benar) {
                    $benar++;
                }
            }

            $total = $kuis->pertanyaan->count();

            $hasil->update([
                'skor' => $total > 0 ? (int) round($benar / $total * 100) : 0,
                'skor_benar' => $benar,
                'skor_salah' => $total - $benar,
            ]);

            return $hasil;
        });
    }
}
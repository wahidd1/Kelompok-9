<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
Schema::create('jawaban_pengguna', function (Blueprint $table) {
$table->id('id_jawaban');
$table->foreignId('id_hasil')->constrained('hasil_kuis', 'id_hasil')->cascadeOnDelete();
$table->foreignId('id_pengguna')->constrained('pengguna', 'id_pengguna')->cascadeOnDelete();
$table->foreignId('id_pertanyaan')->constrained('pertanyaan', 'id_pertanyaan')->cascadeOnDelete();
$table->foreignId('id_pilihan')->constrained('pilihan_jawaban', 'id_pilihan')->cascadeOnDelete();
$table->dateTime('waktu_jawab')->useCurrent();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_pengguna');
    }
};

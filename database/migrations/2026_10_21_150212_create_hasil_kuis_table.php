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
Schema::create('hasil_kuis', function (Blueprint $table) {
$table->id('id_hasil');
$table->foreignId('id_pengguna')->constrained('pengguna', 'id_pengguna')->cascadeOnDelete();
$table->foreignId('id_kuis')->constrained('kuis', 'id_kuis')->cascadeOnDelete();
$table->unsignedInteger('skor');
$table->unsignedInteger('skor_benar');
$table->unsignedInteger('skor_salah');
$table->dateTime('tanggal')->useCurrent();
});
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_kuis');
    }
};

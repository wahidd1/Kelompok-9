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
Schema::create('pertanyaan', function (Blueprint $table) {
$table->id('id_pertanyaan');
$table->foreignId('id_kuis')->constrained('kuis', 'id_kuis')->cascadeOnDelete();
$table->text('pertanyaan');
$table->enum('tipe', ['pilihan_ganda'])->default('pilihan_ganda');
});
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pertanyaan');
    }
};

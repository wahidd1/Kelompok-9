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
        Schema::create('kuis', function (Blueprint $table) {
        $table->id('id_kuis');
        $table->foreignId('id_admin')->constrained('admin', 'id_admin');
        $table->string('judul');
        $table->text('deskripsi')->nullable();
        $table->dateTime('tanggal')->useCurrent();
    });
 }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};

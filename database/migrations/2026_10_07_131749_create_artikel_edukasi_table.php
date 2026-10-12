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
        Schema::create('artikel_edukasi', function (Blueprint $table) {
            $table->id('id_artikel');
            $table->foreignId('id_admin')->constrained('admin', 'id_admin');
            $table->string('judul');
            $table->text('konten');
            $table->timestamp('tanggalPublish')->useCurrent();
            $table->string('sumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artikel_edukasi');
    }
};

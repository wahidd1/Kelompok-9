<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shuttles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_armada');
            $table->integer('kapasitas');
            $table->string('rute_operasional')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shuttles');
    }
};
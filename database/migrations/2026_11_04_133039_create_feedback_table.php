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
    Schema::create('feedback', function (Blueprint $table) {
        $table->id('id_feedback');
        $table->foreignId('id_admin')->nullable()->constrained('admin', 'id_admin')->nullOnDelete();
        $table->foreignId('id_pengguna')->constrained('pengguna', 'id_pengguna')->cascadeOnDelete();
        $table->text('isi_feedback');
        $table->dateTime('tanggal')->useCurrent();
    });
}

public function down(): void
{
    Schema::dropIfExists('feedback');
}
};

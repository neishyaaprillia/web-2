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
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
$table->id();
$table->string('nip')->unique();
$table->string('nama');
$table->string('jabatan');
$table->foreignId('unit_kerja_id')->constrained()->onDelete('cascade');
$table->timestamps();
$table->id();
$table->foreignId('pegawai_id')->constrained()->onDelete('cascade');
$table->foreignId('ruang_id')->constrained()->onDelete('cascade');
$table->date('tanggal_pinjam');
$table->date('tanggal_kembali');
$table->timestamps();

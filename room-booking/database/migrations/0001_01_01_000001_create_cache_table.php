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
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
Schema::create('unit_kerjas', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->timestamps();
});
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

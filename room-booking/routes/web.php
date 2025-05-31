<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
use App\Livewire\UnitKerja\ListUnitKerja;
Route::get('/unit-kerja', ListUnitKerja::class)->name('unit.index');
use App\Livewire\Pegawai\ListPegawai;
use App\Livewire\Peminjaman\ListPeminjaman;

Route::get('/pegawai', ListPegawai::class)->name('pegawai.index');
Route::get('/peminjaman', ListPeminjaman::class)->name('peminjaman.index');

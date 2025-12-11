<?php

use App\Livewire\Absen;
use App\Livewire\Auth\Logout;
use App\Livewire\Home;
use App\Livewire\JawabanTugas;
use App\Livewire\Kelas;
use App\Livewire\Materi;
use App\Livewire\Profil;
use App\Livewire\ShowAbsen;
use App\Livewire\ShowTugas;
use App\Livewire\Tugas;
use App\Livewire\Ujian;

use Illuminate\Support\Facades\Route;

Route::get('/login', App\Livewire\Auth\Login::class)->name('login')->middleware('guest');
Route::get('/registrasi', App\Livewire\Auth\Register::class)->name('register')->middleware('guest');
Route::post('/logout', Logout::class)->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/absen', Absen::class)->name('absen');
    Route::get('/absen/{token}', ShowAbsen::class)->name('absen.show');
    Route::prefix('class')
        ->name('class.')
        ->group(function () {
            Route::get('/{kode_mk}', Kelas::class)->name('index');
            Route::get('/{kode_mk}/tugas', Tugas::class)->name('tugas');
            Route::get('/{kode_mk}/tugas/{kode_tugas}', ShowTugas::class)->name('show');
            Route::get('/{kode_mk}/tugas/jawaban/{kode_tugas}', JawabanTugas::class)->name('jawaban');
            Route::get('/{kode_mk}/materi', Materi::class)->name('materi');
            Route::get('/{kode_mk}/ujian', Ujian::class)->name('ujian');
        });
    Route::get('/profil', Profil::class)->name('profil');
});


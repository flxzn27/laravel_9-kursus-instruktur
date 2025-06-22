<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Instruktur\Index;
use App\Livewire\Kursus\Index as KursusPage;
use App\Livewire\Materi\Index as MateriPage;
use App\Livewire\Pendaftaran\Index as PendaftaranPage;
use App\Livewire\Pendaftaran\AdminIndex;
use App\Livewire\DashboardUser;
use App\Livewire\Pendaftaran\Form;

Route::view('/', 'welcome');

Route::get('/dashboard', DashboardUser::class)
    ->middleware(['auth'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/instruktur', Index::class)->name('instruktur.index');
    Route::get('/kursus', KursusPage::class)->name('kursus.index');
    Route::get('/materi', MateriPage::class)->name('materi.index');
    Route::get('/pendaftaran', PendaftaranPage::class)->name('pendaftaran.index');
    Route::get('/admin/instruktur', \App\Livewire\Instruktur\Index::class)->name('admin.instruktur');
    Route::get('/admin/kursus', \App\Livewire\Kursus\Index::class)->name('admin.kursus');
    Route::get('/admin/pendaftaran', \App\Livewire\Pendaftaran\AdminIndex::class)->name('admin.pendaftaran');
    Route::get('/pendaftaran/{kursus}', PendaftaranPage::class)
        ->name('pendaftaran.form')
        ->middleware('auth');
});

require __DIR__.'/auth.php';

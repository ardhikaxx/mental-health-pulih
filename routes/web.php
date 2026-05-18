<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController as AdminUserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EdukasiController as AdminEdukasiController;
use App\Http\Controllers\Admin\PasienController as AdminPasienController;
use App\Http\Controllers\Admin\PertanyaanController as AdminPertanyaanController;
use App\Http\Controllers\Admin\PsikologController as AdminPsikologController;
use App\Http\Controllers\Admin\SkriningController as AdminSkriningController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\EdukasiPublikController;
use App\Http\Controllers\Pasien\DashboardController as PasienDashboardController;
use App\Http\Controllers\Pasien\KonsultasiController as PasienKonsultasiController;
use App\Http\Controllers\Pasien\PemantauanController as PasienPemantauanController;
use App\Http\Controllers\Pasien\SkriningController as PasienSkriningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Psikolog\DashboardController as PsikologDashboardController;
use App\Http\Controllers\Psikolog\KonsultasiController as PsikologKonsultasiController;
use App\Http\Controllers\Psikolog\PemantauanController as PsikologPemantauanController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('home');

Route::get('/edukasi', [EdukasiPublikController::class, 'index'])->name('edukasi.index');
Route::get('/edukasi/video/{slug}', [EdukasiPublikController::class, 'video'])->name('edukasi.video');
Route::get('/edukasi/{slug}', [EdukasiPublikController::class, 'show'])->name('edukasi.show');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/bantuan', [BantuanController::class, 'index'])->name('bantuan.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/verify-email', EmailVerificationPromptController::class)->name('verification.notice');
    Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::put('/password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return match (auth()->user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'psikolog' => redirect()->route('psikolog.dashboard'),
        default => redirect()->route('pasien.dashboard'),
    };
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('pasien', AdminPasienController::class)->only(['index', 'show']);
    Route::resource('psikolog', AdminPsikologController::class)->except(['create', 'edit']);
    Route::resource('edukasi', AdminEdukasiController::class)->except(['create', 'edit']);
    Route::resource('admin', AdminUserController::class)->except(['create', 'edit']);
    Route::resource('skrining', AdminSkriningController::class)->except(['create', 'edit', 'show']);

    Route::get('/skrining/{skrining}/pertanyaan', [AdminPertanyaanController::class, 'edit'])->name('skrining.pertanyaan.edit');
    Route::put('/skrining/{skrining}/pertanyaan', [AdminPertanyaanController::class, 'update'])->name('skrining.pertanyaan.update');
});

Route::middleware(['auth', 'role:psikolog'])->prefix('psikolog')->name('psikolog.')->group(function () {
    Route::get('/dashboard', [PsikologDashboardController::class, 'index'])->name('dashboard');

    Route::get('/konsultasi', [PsikologKonsultasiController::class, 'index'])->name('konsultasi.index');
    Route::patch('/konsultasi/{konsultasi}/setuju', [PsikologKonsultasiController::class, 'approve'])->name('konsultasi.approve');
    Route::patch('/konsultasi/{konsultasi}/tolak', [PsikologKonsultasiController::class, 'reject'])->name('konsultasi.reject');
    Route::patch('/konsultasi/{konsultasi}/mulai', [PsikologKonsultasiController::class, 'start'])->name('konsultasi.start');
    Route::patch('/konsultasi/{konsultasi}/selesai', [PsikologKonsultasiController::class, 'finish'])->name('konsultasi.finish');
    Route::get('/konsultasi/chat/{konsultasi}', [PsikologKonsultasiController::class, 'chat'])->name('konsultasi.chat');
    Route::post('/konsultasi/chat/{konsultasi}', [PsikologKonsultasiController::class, 'send'])->name('konsultasi.chat.send');

    Route::get('/pemantauan', [PsikologPemantauanController::class, 'index'])->name('pemantauan.index');
    Route::get('/pemantauan/{pasien}', [PsikologPemantauanController::class, 'show'])->name('pemantauan.show');
});

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->name('pasien.')->group(function () {
    Route::get('/dashboard', [PasienDashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/mood', [PasienDashboardController::class, 'mood'])->name('dashboard.mood');

    Route::get('/skrining', [PasienSkriningController::class, 'index'])->name('skrining.index');
    Route::post('/skrining', [PasienSkriningController::class, 'storePendaftaran'])->name('skrining.store');
    Route::get('/skrining/pilih', [PasienSkriningController::class, 'pilih'])->name('skrining.pilih');
    Route::get('/skrining/{skrining}/tes', [PasienSkriningController::class, 'tes'])->name('skrining.tes');
    Route::post('/skrining/{skrining}/tes', [PasienSkriningController::class, 'submit'])->name('skrining.submit');
    Route::get('/skrining/hasil/{hasil}', [PasienSkriningController::class, 'hasil'])->name('skrining.hasil');

    Route::get('/konsultasi', [PasienKonsultasiController::class, 'index'])->name('konsultasi.index');
    Route::post('/konsultasi', [PasienKonsultasiController::class, 'storePendaftaran'])->name('konsultasi.store');
    Route::get('/konsultasi/pilih-psikolog', [PasienKonsultasiController::class, 'pilihPsikolog'])->name('konsultasi.psikolog');
    Route::get('/konsultasi/jadwal/{psikolog}', [PasienKonsultasiController::class, 'jadwal'])->name('konsultasi.jadwal');
    Route::post('/konsultasi/jadwal/{psikolog}', [PasienKonsultasiController::class, 'simpanJadwal'])->name('konsultasi.jadwal.store');
    Route::get('/konsultasi/menunggu/{konsultasi?}', [PasienKonsultasiController::class, 'menunggu'])->name('konsultasi.menunggu');
    Route::get('/konsultasi/riwayat', [PasienKonsultasiController::class, 'riwayat'])->name('konsultasi.riwayat');
    Route::get('/konsultasi/chat/{konsultasi}', [PasienKonsultasiController::class, 'chat'])->name('konsultasi.chat');
    Route::post('/konsultasi/chat/{konsultasi}', [PasienKonsultasiController::class, 'send'])->name('konsultasi.chat.send');

    Route::get('/pemantauan', [PasienPemantauanController::class, 'index'])->name('pemantauan.index');
    Route::post('/pemantauan', [PasienPemantauanController::class, 'store'])->name('pemantauan.store');
    Route::get('/pemantauan/hasil/{pemantauan?}', [PasienPemantauanController::class, 'hasil'])->name('pemantauan.hasil');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

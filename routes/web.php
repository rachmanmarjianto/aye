<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\FilestorageController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// template Routes
Route::prefix('template')->name('template.')->group(function () {
    Route::view('/', 'template.admin.blank')->name('dashboard');
    Route::view('/forms', 'template.admin.forms')->name('forms');
    Route::view('/tables', 'template.admin.tables')->name('tables');
    Route::view('/blank', 'template.admin.blank')->name('blank');
});


Route::get('/reload-captcha', function () {
    return response()->json([
        'url' => captcha_src(6) . '&_=' . time(),
    ])->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
      ->header('Pragma', 'no-cache');
})->name('captcha.refresh');


Route::get('/', function () {
    return redirect()->route('login');
});

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login_post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::view('/survey', 'survey')->name('survey');

//mahasiswa
Route::middleware(['isLogin:3'])->group(function () {
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/pendaftaran-baru', [MahasiswaController::class, 'pendaftaran_baru_new'])->name('mahasiswa.pendaftaran_baru');
    Route::get('/mahasiswa/pendaftaran-baru/{idusulan_bisnis}', [MahasiswaController::class, 'pendaftaran_baru'])->name('mahasiswa.pendaftaran_baru_edit');
    Route::post('/mahasiswa/pendaftaran-baru/nama-bisnis', [MahasiswaController::class, 'pendaftaran_baru_nama_bisnis'])->name('mahasiswa.pendaftaran_baru_nama_bisnis');
    Route::post('/mahasiswa/pendaftaran-baru/update', [MahasiswaController::class, 'update_pendaftaran'])->name('mahasiswa.update_pendaftaran');
    Route::post('/mahasiswa/cari-mahasiswa', [MahasiswaController::class, 'cari_mahasiswa'])->name('mahasiswa.cari_mahasiswa');
    Route::post('/mahasiswa/pendaftaran-baru/tambahkan-anggota', [MahasiswaController::class, 'tambahkan_anggota'])->name('mahasiswa.tambahkan_anggota');
    Route::post('/mahasiswa/pendaftaran-baru/set-ketua', [MahasiswaController::class, 'set_ketua'])->name('mahasiswa.set_ketua');
    Route::post('/mahasiswa/pendaftaran-baru/hapus-anggota', [MahasiswaController::class, 'hapus_anggota'])->name('mahasiswa.hapus_anggota');
    Route::post('/mahasiswa/pendaftaran-baru/view-form', [MahasiswaController::class, 'view_form'])->name('mahasiswa.view_form');
    Route::get('/mahasiswa/pendaftaran-baru/view/{idusulan_bisnis}', [MahasiswaController::class, 'pendaftaran_baru_view'])->name('mahasiswa.pendaftaran_baru_view');
    Route::post('/mahasiswa/pendaftaran-baru/update-status', [MahasiswaController::class, 'update_status_pendaftaran'])->name('mahasiswa.update_status_pendaftaran');
});

Route::middleware(['isLogin:all'])->group(function () {
    Route::get('/file/{id}', [FilestorageController::class, 'get_file'])->name('file.get');
    Route::get('/file/hapus/{id}', [FilestorageController::class, 'hapus_file'])->name('file.hapus');
});

Route::middleware(['isLogin:0'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/view-form', [AdminController::class, 'view_form'])->name('admin.view_form');
    Route::get('/admin/view/{idusulan_bisnis}', [AdminController::class, 'pendaftaran_baru_view'])->name('admin.pendaftaran_baru_view');
    Route::get('/admin/master/bidang-bisnis', [AdminController::class, 'bidang_bisnis'])->name('admin.master.bidang_bisnis');
    Route::get('/admin/master/bidang-bisnis/tambah', [AdminController::class, 'bidang_bisnis_tambah'])->name('admin.master.bidang_bisnis.tambah');
    Route::post('/admin/master/bidang-bisnis/tambah', [AdminController::class, 'bidang_bisnis_tambah_submit'])->name('admin.master.bidang_bisnis.tambah.submit');
    Route::get('/admin/master/bidang-bisnis/edit/{id}', [AdminController::class, 'bidang_bisnis_edit'])->name('admin.master.bidang_bisnis.edit');
    Route::post('/admin/master/bidang-bisnis/edit', [AdminController::class, 'bidang_bisnis_edit_submit'])->name('admin.master.bidang_bisnis.edit.submit');
    Route::get('/admin/master/bidang-bisnis/hapus/{id}', [AdminController::class, 'bidang_bisnis_hapus'])->name('admin.master.bidang_bisnis.hapus');
    Route::post('/admin/update_status', [AdminController::class, 'update_status_pendaftaran'])->name('admin.update_status_pendaftaran');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

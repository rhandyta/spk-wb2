<?php

use App\Http\Controllers\HasilController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PenilaianSiswaController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthSiswa\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KandidatController;
use App\Http\Middleware\Siswa;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('landingpage');
Route::get('pengajuan-kandidat', [KandidatController::class, 'pengajuan'])->name('pengajuan.kandidat');
Route::get('search-kandidat', [KandidatController::class, 'search'])->name('search.siswa');
Route::post('post-kandidat', [KandidatController::class, 'store'])->name('store.kandidat');
Auth::routes([
    'register' => false,
]);
Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth'
], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
    Route::resource('siswa', SiswaController::class);
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('penilaian', PenilaianController::class);
    Route::resource('nilai', PenilaianSiswaController::class);
    Route::post('import-excel', [SiswaController::class, 'importexcel'])->name('import.siswa');
    Route::post('delete-siswa', [SiswaController::class, 'deleteSiswa'])->name('delete.siswa');
    Route::post('export-excel', [SiswaController::class, 'exportexcel'])->name('export.siswa');
    Route::get('hasil', [HasilController::class, 'index'])->name('hasil.index');
    Route::post('jmlhkandidat', [HasilController::class, 'jmlhkandidat'])->name('jumlah.kandidat');
    Route::post('savehasil', [HasilController::class, 'saveHasil'])->name('hasil.saveHasil');
    Route::get('kandidat', [HasilController::class, 'kandidat'])->name('hasil.kandidat');
    Route::patch('kandidat', [HasilController::class, 'update'])->name('update.kandidat');
    Route::get('hasil-vote', [HasilController::class, 'hasilvote'])->name('hasil.vote');
    Route::get('hasil-vote-cetak', [HasilController::class, 'hasilPdf'])->name('hasil.cetak');
    Route::get('cari', [SiswaController::class, 'search'])->name('siswa.search');
    Route::delete('delete-kandidat', [HasilController::class, 'deleteKandidat'])->name('delete.kandidat');
});

Route::group([
    'prefix' => 'siswa',
    'middleware' => [Siswa::class]
], function () {
    Route::get('/', [LoginController::class, 'showLoginForm'])->name('siswa.login');
    Route::post('/', [LoginController::class, 'login'])->name('siswa.login.submit');
    Route::resource('vote', PilihanController::class);
});








// Route::prefix('admin')->group(function () {
//     Route::resource('tapel', TapelController::class);
//     Route::resource('jurusan', JurusanController::class);
//     Route::resource('kelas', KelasController::class);
//     Route::resource('siswa', SiswaController::class);
//     Route::resource('kriteria', KriteriaController::class);
//     Route::resource('penilaian', PenilaianController::class);
//     Route::resource('nilai', PenilaianSiswaController::class);
//     Route::get('hasil', [HasilController::class, 'index'])->name('hasil.index');
//     Route::post('savehasil', [HasilController::class, 'saveHasil'])->name('hasil.saveHasil');
//     Route::get('kandidat', [HasilController::class, 'kandidat'])->name('hasil.kandidat');
// });

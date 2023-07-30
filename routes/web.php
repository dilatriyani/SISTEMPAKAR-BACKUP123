<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\data_adminController;
use App\Http\Controllers\Admin\data_gejalaController;
use App\Http\Controllers\Admin\data_penyakitController;
use App\Http\Controllers\Admin\data_diagnosaController;
use App\Http\Controllers\Admin\RuleController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ArtikelController;
use App\Http\Controllers\ArtikelDetailController;
use App\Http\Controllers\Admin\ProfileController;
/*
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
    return view('Pengguna.Layouts.Home');
});

Route::get('/Admin/Dashboard', [dashboardController::class, 'index']);
// Route::get('/Pengguna/Diagnosa', [dashboardController::class, 'diagnosa']);
Route::post('/Pengguna/Diagnosa/Mulai', [dashboardController::class, 'getUserSess']);
Route::get('/Pengguna/Diagnosa/{id}', [dashboardController::class, 'question']);
Route::post('/Pengguna/Diagnosa/Hasil', [dashboardController::class, 'result']);
Route::post('/Pengguna/Diagnosa/Cetak', [dashboardController::class, 'GeneratePdf']);
Route::get('/Pengguna/Layouts/tentang', [dashboardController::class, 'tentang']);
// Route::get('/Pengguna/Diagnosa/Hasil', [dashboardController::class, 'hasil']);


Route::get('/Pengguna/Layouts', [dashboardController::class, 'info_penyakit']);
Route::get('/Pengguna/Layouts/detail/{id}', [ArtikelDetailController::class, 'index']);
//crud data_admin
// Route::get("/Admin/Data_Admin/edit", [data_adminController::class, "edit"]);
// Route::get("/Admin/Data_Admin/simpan", [data_adminController::class, "update"]);
Route::resource("/Admin/Data_Admin", data_adminController::class);
Route::get("/Data_Admin/{id}", [data_adminController::class, "destroy"]);

//crud data gejala
Route::get('/Admin/Data_Gejala', [data_gejalaController::class, 'store']);
Route::resource("/Admin/Data_Gejala", data_gejalaController::class);
// Route::get("/Data_Gejala/edit", [data_gejalaController::class, "edit"]);
// Route::get("/Data_Gejala/simpan", [data_gejalaController::class, "update"]);
// Route::get("/Gejala/{id}", [data_gejalaController::class, "destroy"]);


//crud data penyakit
Route::get('/Admin/Data_Penyakit', [data_penyakitController::class, 'store']);
// Route::get("/Admin/Data_Penyakit/edit", [data_penyakitController::class, "edit"]);
// Route::get("/Admin/Data_Penyakit/simpan", [data_penyakitController::class, "update"]);
// Route::get("/Admin/Data_Penyakit", [data_penyakitController::class, "create"]);
Route::resource("/Admin/Data_Penyakit", data_penyakitController::class);
// Route::get("/Penyakit/{id}", [data_penyakitController::class, "destroy"]);

//crud data diagnosa
Route::get('/Admin/Data_Diagnosa', [data_diagnosaController::class, 'index']);


// crud rules
// Route::get('/Admin/Rule', [RuleController::class, 'index']);
Route::resource("/Admin/Rule", RuleController::class);

// crud rules
Route::resource("/Admin/Artikel", ArtikelController::class);
Route::get("/Artikel-hapus/{id}", [ArtikelController::class, "destroy"]);

//login
// Route::get("/login", LoginController::class, 'index');
// Route::post("/login", LoginController::class, 'login');
Route::middleware(['guest'])->group(function () {
    Route::get('/login',  [LoginController::class, 'index'])->name('login');
    Route::post('/login',  [LoginController::class, 'login']);
});


Route::middleware(['auth'])->group(function () {

    Route::get('/Admin/Dashboard',  [dashboardController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::controller(ProfileController::class)->group(function(){
    Route::get('/Profile','index');
    Route::patch('/Profile{id}','update')->name('update');
});
// Route::resource("/Profile", ProfileController::class);
// require __DIR__.'/auth.php';
// Route::resource("/login", LoginController::class);

// Route::get('Admin/Rule/index', [RuleController::class, 'index'])->name('Admin.Rule.index');
// Route::get('Admin/Rule/create', [RuleController::class, 'create'])->name('Admin.Rule.index');
// Route::post('Admin/Rule/store', [RuleController::class, 'store'])->name('Admin.Rule.index');

// Route::get('/Admin/Rule', [RuleController::class, 'index']);

// Route::get('/Admin/Rule', [RuleController::class, 'index'])->name('admin.rule.index');
// Route::resource("/Admin/TambahRule", RuleController::class);
// Route::post('/Admin/Rule', [RuleController::class, 'store'])->name('admin.rule.store');
// Route::get('/Admin/Rule', [RuleController::class, 'index'])->name('rules');
// Route::post('/Admin/TambahRule', [RuleController::class, 'store']);

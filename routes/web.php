<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CobadataController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamanUserController;
use App\Http\Controllers\UserRuanganController;


/*t
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses'); // Tambahkan rute POST untuk login
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register-proses', [RegisterController::class, 'register_proses'])->name('register-proses'); // Tambahkan rute POST untuk register

    // });

// Route::group(['prefix' => 'admin','middleware' => ['auth'], 'as' => 'admin.'] , function(){
Route::middleware(['auth', 'role:admin|wadir'])->group(function() {
    Route::get('/dashboard', [CobadataController::class, 'dashboard'])->name('dashboard');      //->middleware('can:view_dashboard');  

    Route::get('/user', [CobadataController::class, 'cobadata'])->name('index');     //->middleware('auth');
    Route::get('/user/create', [CobadataController::class, 'create'])->name('user.create');  // untuk form tambah data(cobadata.blade.php)
    Route::post('/user/store', [CobadataController::class, 'store'])->name('user.store');    // untuk proses data ke database

    Route::get('/user/edit/{id}', [CobadataController::class, 'edit'])->name('user.edit');   // name untuk mengidentifikasi route ketika di blade/controller, jadi penamaannya bebas
    Route::put('/user/update/{id}', [CobadataController::class, 'update'])->name('user.update');
    Route::delete('/user/delete/{id}', [CobadataController::class, 'delete'])->name('user.delete');
    
// });

    Route::get('/ruangan', [RuanganController::class, 'ruangan'])->name('ruangan.index');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/ruangan/store', [RuanganController::class, 'store'])->name('ruangan.store');
    
    Route::get('/ruangan/edit/{id}', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/update/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/delete/{id}', [RuanganController::class, 'delete'])->name('ruangan.delete');

    Route::get('/peminjaman', [PeminjamanController::class, 'peminjaman'])->name('peminjaman.index');
    Route::get('/peminjamanadmin', [PeminjamanController::class, 'index'])->name('peminjaman.index2');
    Route::put('/peminjaman/approve/{id}', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::put('/peminjaman/reject/{id}', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
});

// Routes untuk user
Route::middleware(['auth', 'role:dosen|mahasiswa'])->group(function() {
//Route::group(['prefix' => 'user','middleware' => ['auth'], 'as' => 'user.'] , function(){
    Route::get('/', [PeminjamanUserController::class, 'dashboarduser'])->name('dashboarduser');  

    // Routes untuk User
    Route::get('/user/ruangan', [UserRuanganController::class, 'index'])->name('user.ruangan.index');
    Route::get('/user/peminjaman', [PeminjamanUserController::class, 'peminjamanuser'])->name('peminjamanuser.index');  
    // Route::get('/user/filter', [PeminjamanUserController::class, 'filter'])->name('peminjaman.filter');  

    Route::get('/peminjamanuser', [PeminjamanUserController::class, 'index'])->name('peminjaman-user.index');
    Route::get('/peminjamanuser/create', [PeminjamanUserController::class, 'create'])->name('peminjamanuser.create');
    Route::post('/peminjamanuser/store', [PeminjamanUserController::class, 'store'])->name('peminjamanuser.store');    // untuk proses data ke database

    Route::get('/peminjamanuser/edit/{id}', [PeminjamanUserController::class, 'edit'])->name('peminjamanuser.edit');
    Route::put('/peminjamanuser/update/{id}', [PeminjamanUserController::class, 'update'])->name('peminjamanuser.update');
    Route::delete('/peminjamanuser/delete/{id}', [PeminjamanUserController::class, 'delete'])->name('peminjamanuser.delete');
  
//});
});

 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::group(['middleware' => 'auth'], function () {

    // admin pesan
    Route::get('/admin/pesan', [ProdukController::class, 'pesan']);
    Route::get('/admin/hapusPesan/{id}', [ProdukController::class, 'HapusPesan']);

    // admin produk
    Route::get('/admin/produk', [ProdukController::class, 'produk']);
    Route::get('/admin/produkTambah', [ProdukController::class, 'produkTambah']);
    Route::post('/admin/produkStore', [ProdukController::class, 'produkStore']);
    Route::get('/admin/produkEdit/{id}', [ProdukController::class, 'produkEdit']);
    Route::post('/admin/produkUpdate/{id}', [ProdukController::class, 'produkUpdate']);
    Route::get('/admin/produkHapus/{id}', [ProdukController::class, 'produkHapus']);

    // admin user
    Route::get('/admin/user', [ProdukController::class, 'user']);
    Route::get('/admin/userTambah', [ProdukController::class, 'userTambah']);
    Route::post('/admin/userStore', [ProdukController::class, 'userStore']);
    Route::get('/admin/userEdit/{id}', [ProdukController::class, 'userEdit']);
    Route::post('/admin/userUpdate/{id}', [ProdukController::class, 'userUpdate']);
    Route::get('/admin/userHapus/{id}', [ProdukController::class, 'hapusUser']);

    // admin wilayah
    Route::get('/admin/wilayah', [ProdukController::class, 'wilayah']);
    Route::get('/admin/wilayahTambah/{id}', [ProdukController::class, 'wilayahTambah']);
    Route::post('/admin/wilayahStore', [ProdukController::class, 'wilayahStore']);
    Route::get('/admin/wilayahEdit/{id}', [ProdukController::class, 'wilayahEdit']);
    Route::post('/admin/wilayahUpdate/{id}', [ProdukController::class, 'wilayahUpdate']);
    Route::get('/admin/wilayahHapus/{id}', [ProdukController::class, 'wilayahHapus']);

    // logout
    Route::post('/logout', [ProdukController::class, 'logout']);

});

Route::group(['middleware' => 'guest'], function () {

    //kontak
    Route::get('/kontak', [ProdukController::class, 'kontak']);
    Route::post('/admin/kontakStore', [ProdukController::class, 'KontakStore']);

});

//dassboard
Route::get('/', [ProdukController::class, 'dassboard']);
Route::get('/dassboard', [ProdukController::class, 'dassboard']);

//distribusi
Route::get('/detail/{kode}', [ProdukController::class, 'distribusi']);

//login
Route::get('/login', [ProdukController::class, 'login'])->name('login')->middleware('guest');
Route::post('/loginStore', [ProdukController::class, 'loginStore']);
    
// admin setting
Route::get('/admin/setting', [ProdukController::class, 'setting']);
Route::post('/admin/settingUpdate/{id}', [ProdukController::class, 'settingUpdate']);

// notifikasi
Route::get('/notifikasi/hapus/{id}', [ProdukController::class, 'hapusNotifikasi']);

// komentar produk
Route::post('/distribusi/komentarStore', [ProdukController::class, 'storeKometar']);
Route::get('/admin/komentar', [ProdukController::class, 'komentar']);
Route::get('/admin/hapusKomen/{id}', [ProdukController::class, 'hapusKomen']);
<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\ProfileController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Monolog\Level;

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

Route::pattern('id', '[0-9]+'); // Artinya: Ketika ada parameter {id}, maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postlogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'postRegister']);

// Group route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/', [WelcomeController::class, 'index']);

    Route::group(['prefix' => 'user', 'middleware' => 'authorize:ADM'], function () {
        Route::get('/', [UserController::class, 'index']);         // menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);     // menampilkan data user dalam bentuk json untuk datables
        Route::get('/create', [UserController::class, 'create']);  // menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']);        // menyimpan data user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']);     // Menyimpan data user baru Ajax
        Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
        Route::get('/{id}/show_ajax', [UserController::class, 'show_ajax']);       // menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk menampilkan form konfirmasi delete user Ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk menghapus data user Ajax
        Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
        Route::get('/import', [UserController::class, 'import']);
        Route::post('/import_ajax', [UserController::class, 'import_ajax']);
        Route::get('/export_excel', [UserController::class, 'export_excel']);
        Route::get('/export_pdf', [UserController::class, 'export_pdf']);
    });

    Route::group(['prefix' => 'level', 'middleware' => 'authorize:ADM'], function () {
        Route::get('/', [LevelController::class, 'index']);         // menampilkan halaman awal level
        Route::post('/list', [LevelController::class, 'list']);     // menampilkan data level dalam bentuk json untuk datatables
        Route::get('/create', [LevelController::class, 'create']);  // menampilkan halaman form tambah level
        Route::post('/', [LevelController::class, 'store']);        // menyimpan data level baru
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [LevelController::class, 'store_ajax']);     // Menyimpan data user baru Ajax
        Route::get('/{id}', [LevelController::class, 'show']);      // menampilkan detail level
        Route::get('/{id}/show_ajax', [LevelController::class, 'show_ajax']);
        Route::get('/{id}/edit', [LevelController::class, 'edit']); // menampilkan halaman form edit level
        Route::put('/{id}', [LevelController::class, 'update']);    // menyimpan perubahan data level
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); // Menampilkan halaman form edit level Ajax
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // Menyimpan perubahan data level Ajax
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']); // Untuk menampilkan form konfirmasi delete level Ajax
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // Untuk menghapus data level Ajax
        Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
        Route::get('/import', [LevelController::class, 'import']);
        Route::post('/import_ajax', [LevelController::class, 'import_ajax']);
        Route::get('/export_excel', [LevelController::class, 'export_excel']);
        Route::get('/export_pdf', [LevelController::class, 'export_pdf']);
    });

    Route::group(['prefix' => 'kategori', 'middleware' => ['authorize:ADM,MNG']], function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::post('/list', [KategoriController::class, 'list']);
        Route::get('/create', [KategoriController::class, 'create']);
        Route::post('/', [KategoriController::class, 'store']);
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/ajax', [KategoriController::class, 'store_ajax']);
        Route::get('/{id}', [KategoriController::class, 'show']);
        Route::get('/{id}/show_ajax', [KategoriController::class, 'show_ajax']);
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);
        Route::put('/{id}', [KategoriController::class, 'update']);
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
        Route::delete('/{id}', [KategoriController::class, 'destroy']);
        Route::get('/import', [KategoriController::class, 'import']);
        Route::post('/import_ajax', [KategoriController::class, 'import_ajax']);
        Route::get('/export_excel', [KategoriController::class, 'export_excel']);
        Route::get('/export_pdf', [KategoriController::class, 'export_pdf']);
    });

    Route::group(['prefix' => 'barang', 'middleware' => ['authorize:ADM,MNG']], function () {
        Route::get('/', [BarangController::class, 'index']);              // menampilkan halaman awal barang
        Route::post('/list', [BarangController::class, 'list']);          // menampilkan data barang dalam bentuk json untuk datatables
        Route::get('/create', [BarangController::class, 'create']);       // menampilkan halaman form tambah barang
        Route::post('/', [BarangController::class, 'store']);
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/ajax', [BarangController::class, 'store_ajax']);                 // menyimpan data barang baru
        Route::get('/{id}', [BarangController::class, 'show']);            // menampilkan detail barang
        Route::get('/{id}/show_ajax', [BarangController::class, 'show_ajax']);
        Route::get('/{id}/edit', [BarangController::class, 'edit']);       // menampilkan halaman form edit barang
        Route::put('/{id}', [BarangController::class, 'update']);          // menyimpan perubahan data barang
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
        Route::get('/import', [BarangController::class, 'import']);
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']);
        Route::get('/export_excel', [BarangController::class, 'export_excel']);
        Route::get('/export_pdf', [BarangController::class, 'export_pdf']);
    });

    Route::group(['prefix' => 'supplier', 'middleware' => ['authorize:ADM,MNG,STF']], function () {
        Route::get('/', [SupplierController::class, 'index']);              // menampilkan halaman awal supplier
        Route::post('/list', [SupplierController::class, 'list']);          // menampilkan data supplier dalam bentuk json untuk datatables
        Route::get('/create', [SupplierController::class, 'create']);       // menampilkan halaman form tambah supplier
        Route::post('/', [SupplierController::class, 'store']);              // menyimpan data supplier baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']);
        Route::post('/ajax', [SupplierController::class, 'store_ajax']);
        Route::get('/{id}', [SupplierController::class, 'show']);            // menampilkan detail supplier
        Route::get('/{id}/show_ajax', [SupplierController::class, 'show_ajax']);
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);       // menampilkan halaman form edit supplier
        Route::put('/{id}', [SupplierController::class, 'update']);          // menyimpan perubahan data supplier
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']);
        Route::delete('/{id}', [SupplierController::class, 'destroy']);      // menghapus data supplier
        Route::get('/import', [SupplierController::class, 'import']);
        Route::post('/import_ajax', [SupplierController::class, 'import_ajax']);
        Route::get('/export_excel', [SupplierController::class, 'export_excel']);
        Route::get('/export_pdf', [SupplierController::class, 'export_pdf']);
    });

    Route::group(['prefix' => 'stok',  'middleware' => 'authorize:ADM'], function () {
        Route::get('/', [StokController::class, 'index']);          // Menampilkan halaman awal stok
        Route::post('/list', [StokController::class, 'list']);      // Menampilkan data stok dalam bentuk JSON untuk DataTables
        Route::get('/create', [StokController::class, 'create']);   // Menampilkan halaman form tambah stok
        Route::post('/', [StokController::class, 'store']);         // Menyimpan data stok baru
        Route::get('/create_ajax', [StokController::class, 'create_ajax']); // menampilkan halaman form tambah supplier ajax
        Route::post('/ajax', [StokController::class, 'store_ajax']); // menyimpan data supplier baru ajax
        Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']);
        Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']);
        Route::get('/{id}', [StokController::class, 'show']);       // Menampilkan detail stok
        Route::get('/{id}/edit', [StokController::class, 'edit']);  // Menampilkan halaman form edit stok
        Route::put('/{id}', [StokController::class, 'update']);     // Menyimpan perubahan data stok
        Route::delete('/{id}', [StokController::class, 'destroy']); // Menghapus data stok
        Route::get('/import', [StokController::class, 'import']); // ajax form upload excel
        Route::post('/import_ajax', [StokController::class, 'import_ajax']); // ajax import excel
        Route::get('/export_excel', [StokController::class, 'export_excel']); // ajax import excel
        Route::get('/export_pdf', [StokController::class, 'export_pdf']); // export pdf
    });

    Route::group(['prefix' => 'penjualan', 'middleware' => 'authorize:ADM'], function () {
        Route::get('/', [PenjualanDetailController::class, 'index']);          // Menampilkan halaman awal penjualan
        Route::post('/list', [PenjualanDetailController::class, 'list']);      // Menampilkan data penjualan dalam bentuk JSON untuk DataTables
        Route::get('/create', [PenjualanDetailController::class, 'create']);   // Menampilkan halaman form tambah penjualan
        Route::post('/', [PenjualanDetailController::class, 'store']);         // Menyimpan data penjualan baru
        Route::get('/create_ajax', [PenjualanDetailController::class, 'create_ajax']); // Menampilkan halaman form tambah penjualan ajax
        Route::get('/getHargaBarang/{id}', [PenjualanDetailController::class, 'getHargaBarang']);
        Route::post('/ajax', [PenjualanDetailController::class, 'store_ajax']); // Menyimpan data penjualan baru ajax
        Route::put('/{id}/update_ajax', [PenjualanDetailController::class, 'update_ajax']); // Menyimpan perubahan data penjualan ajax
        Route::get('/{id}/delete_ajax', [PenjualanDetailController::class, 'confirm_ajax']); // Konfirmasi hapus data penjualan ajax
        Route::delete('/{id}/delete_ajax', [PenjualanDetailController::class, 'delete_ajax']); // Menghapus data penjualan via ajax
        Route::get('/{id}/show_ajax', [PenjualanDetailController::class, 'show_ajax']); // Menampilkan detail penjualan ajax
        Route::get('/{id}', [PenjualanDetailController::class, 'show']);       // Menampilkan detail penjualan
        Route::put('/{id}', [PenjualanDetailController::class, 'update']);     // Menyimpan perubahan data penjualan
        Route::delete('/{id}', [PenjualanDetailController::class, 'destroy']); // Menghapus data penjualan
        Route::get('/import', [PenjualanDetailController::class, 'import']);
        Route::post('/import_ajax', [PenjualanDetailController::class, 'import_ajax']);
        Route::get('/export_excel', [PenjualanDetailController::class, 'export_excel']); // Export data penjualan ke Excel
        Route::get('/export_pdf', [PenjualanDetailController::class, 'export_pdf']);     // Export data penjualan ke PDF
    });

    Route::group(['prefix' => 'profile', 'middleware' => ['authorize:ADM,MNG,STF,CUS']], function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/update_profile', [ProfileController::class, 'update_profile']);
        Route::put('/update_pengguna/{id}', [ProfileController::class, 'update_pengguna']);
        Route::put('/update_password/{id}', [ProfileController::class, 'update_password']);
    });
});

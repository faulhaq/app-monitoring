<?php

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

Auth::routes();
Route::get('/login/cek_email/json', 'UserController@cek_email');
Route::get('/login/cek_password/json', 'UserController@cek_password');
Route::post('/cek-email', 'UserController@email')->name('cek-email')->middleware('guest');
Route::get('/reset/password/{id}', 'UserController@password')->name('reset.password')->middleware('guest');
Route::patch('/reset/password/update/{id}', 'UserController@update_password')->name('reset.password.update')->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index');

    Route::get('/profile', 'UserController@profile')->name('profile');

    Route::prefix("pengaturan")->name("pengaturan.")->group(function () {
        Route::get('/profile', 'UserController@edit_profile')->name('profile');
        Route::post('/ubah-profile', 'UserController@ubah_profile')->name('ubah-profile');
        Route::get('/edit-foto', 'UserController@edit_foto')->name('edit-foto');
        Route::post('/ubah-foto', 'UserController@ubah_foto')->name('ubah-foto');
        Route::get('/email', 'UserController@edit_email')->name('email');
        Route::post('/ubah-email', 'UserController@ubah_email')->name('ubah-email');
        Route::get('/password', 'UserController@edit_password')->name('password');
        Route::post('/ubah-password', 'UserController@ubah_password')->name('ubah-password');
    });

    Route::middleware(["admin"])->prefix("data_ref")->name("data_ref.")->group(function () {
        Route::resource('/agama', 'RefAgamaController');
        Route::resource('/goldar', 'RefGoldarController');
        Route::resource('/pekerjaan', 'RefPekerjaanController');
        Route::resource('/pendidikan', 'RefPendidikanController');
    });

    Route::middleware(["admin"])->prefix("master_data")->group(function () {
        Route::prefix("guru")->name("guru.")->group(function () {
            Route::get("/export_excel", "GuruController@export_excel")->name("export_excel");
            Route::get("/import_excel", "GuruController@import_excel")->name("import_excel");
            Route::get("/update_foto/{id}", "GuruController@update_foto")->name("update_foto");
            Route::post("/simpan_foto/{id}", "GuruController@simpan_foto")->name("simpan_foto");
            Route::get("/get_list", "GuruController@get_list")->name("get_list");
        });
        Route::resource('/guru', 'GuruController');

        Route::prefix("siswa")->name("siswa.")->group(function () {
            Route::get("/export_excel", "SiswaController@export_excel")->name("export_excel");
            Route::get("/import_excel", "SiswaController@import_excel")->name("import_excel");
            Route::get("/update_foto/{id}", "SiswaController@update_foto")->name("update_foto");
            Route::get("/update_foto/{id}", "SiswaController@update_foto")->name("update_foto");
            Route::post("/simpan_foto/{id}", "SiswaController@simpan_foto")->name("simpan_foto");
        });
        Route::resource('/siswa', 'SiswaController');

        Route::prefix("orang_tua")->name("orang_tua.")->group(function () {
            Route::get("/export_excel", "OrangTuaController@export_excel")->name("export_excel");
            Route::get("/import_excel", "OrangTuaController@import_excel")->name("import_excel");
            Route::get("/update_foto/{id}", "OrangTuaController@update_foto")->name("update_foto");
            Route::post("/simpan_foto/{id}", "OrangTuaController@simpan_foto")->name("simpan_foto");
            Route::get("/get_list", "OrangTuaController@get_list")->name("get_list");
        });
        Route::resource('/orang_tua', 'OrangTuaController');

        Route::prefix("kelas")->name("kelas.")->group(function () {
            Route::get("/export_excel", "KelasController@export_excel")->name("export_excel");
            Route::get("/import_excel", "KelasController@import_excel")->name("import_excel");
            Route::get("/kelola/{id}", "KelasController@kelola")->name("kelola");
            Route::post("/kelola/{id}/tambah_siswa", "KelasController@kelola_tambah_siswa")->name("kelola.tambah_siswa");
            Route::delete("/hapus_siswa/{id_kelas}/{id_siswa}", "KelasController@hapus_siswa")->name("hapus_siswa");
        });
        Route::resource('/kelas', 'KelasController');

        Route::prefix("tahun_ajaran")->name("tahun_ajaran.")->group(function () {
            Route::post("/aktifkan_tahun", "TahunAjaranController@aktifkan_tahun")->name("aktifkan_tahun");
        });
        Route::resource('/tahun_ajaran', 'TahunAjaranController');
        Route::resource('/user', 'UserController');
        Route::resource('/monitoring_rumah', 'MonitoringRumahController');
    });

    Route::middleware(["admin"])->group(function() {
        Route::post('/admin/pengumuman/simpan', 'PengumumanController@simpan')->name('admin.pengumuman.simpan');
        Route::resource('/pengumuman', 'PengumumanController');
    });
});

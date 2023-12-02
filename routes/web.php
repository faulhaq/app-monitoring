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

    Route::middleware(["role:admin"])->prefix("data_ref")->name("data_ref.")->group(function () {
        Route::resource('/agama', 'RefAgamaController');
        Route::resource('/goldar', 'RefGoldarController');
        Route::resource('/pekerjaan', 'RefPekerjaanController');
        Route::resource('/pendidikan', 'RefPendidikanController');
        Route::resource('/surah', 'RefSurahController');
    });

    Route::middleware(["role:admin,guru"])->prefix("master_data")->group(function () {
        Route::prefix("kelas")->name("kelas.")->group(function () {
            Route::get("/kelola/{id}", "KelasController@kelola")->name("kelola");
            Route::post("/kelola/{id}/tambah_siswa", "KelasController@kelola_tambah_siswa")->name("kelola.tambah_siswa");
            Route::delete("/hapus_siswa/{id_kelas}/{id_siswa}", "KelasController@hapus_siswa")->name("hapus_siswa");
        });
        Route::resource('/kelas', 'KelasController');
        Route::get("/get_siswa_no_kelas/{id_kelas}", "SiswaController@get_siswa_no_kelas")->name("siswa.get_siswa_no_kelas");
    });

    Route::middleware(["role:admin,guru,orang_tua"])->name("monitoring.")->prefix("monitoring")->group(function () {
        Route::post("/store_feedback", "MonitoringKeagamaanController@store_feedback")->name("store_feedback");

        Route::prefix("keagamaan")->name("keagamaan.")->group(function () {
            Route::get("/", "MonitoringKeagamaanController@index")->name("index");

            Route::get("/tahsin", "MonitoringKeagamaanController@tahsin")->name("tahsin");
            Route::post("/tahsin/store/{id_siswa}", "MonitoringKeagamaanController@tahsin_store")->name("tahsin.store");
            Route::delete("/tahsin/delete/{id}", "MonitoringKeagamaanController@tahsin_destroy")->name("tahsin.destroy");

            Route::get("/tahfidz", "MonitoringKeagamaanController@tahfidz")->name("tahfidz");
            Route::post("/tahfidz/store/{id_siswa}", "MonitoringKeagamaanController@tahfidz_store")->name("tahfidz.store");
            Route::delete("/tahfidz/delete/{id}", "MonitoringKeagamaanController@tahfidz_destroy")->name("tahfidz.destroy");

            Route::get("/doa", "MonitoringKeagamaanController@doa")->name("doa");
            Route::post("/doa/store/{id_siswa}", "MonitoringKeagamaanController@doa_store")->name("doa.store");
            Route::delete("/doa/delete/{id}", "MonitoringKeagamaanController@doa_destroy")->name("doa.destroy");

            Route::get("/hadits", "MonitoringKeagamaanController@hadits")->name("hadits");
            Route::post("/hadits/store/{id_siswa}", "MonitoringKeagamaanController@hadits_store")->name("hadits.store");
            Route::delete("/hadits/delete/{id}", "MonitoringKeagamaanController@hadits_destroy")->name("hadits.destroy");

            Route::get("/mahfudhot", "MonitoringKeagamaanController@mahfudhot")->name("mahfudhot");
            Route::post("/mahfudhot/store/{id_siswa}", "MonitoringKeagamaanController@mahfudhot_store")->name("mahfudhot.store");
            Route::delete("/mahfudhot/delete/{id}", "MonitoringKeagamaanController@mahfudhot_destroy")->name("mahfudhot.destroy");
        });

        Route::prefix("harian")->name("harian.")->group(function () {
            Route::get("/", "MonitoringHarianController@index")->name("index");
            Route::get("/index2", "MonitoringHarianController@index2")->name("index2");
            Route::post("/simpan_jawaban", "MonitoringHarianController@simpan_jawaban")->name("simpan_jawaban");
        });
    });

    Route::middleware(["role:admin"])->prefix("master_data")->group(function () {
        Route::resource('/harian', 'HarianController');

        Route::prefix("guru")->name("guru.")->group(function () {
            Route::get("/update_foto/{id}", "GuruController@update_foto")->name("update_foto");
            Route::post("/simpan_foto/{id}", "GuruController@simpan_foto")->name("simpan_foto");
            Route::get("/get_list", "GuruController@get_list")->name("get_list");
        });
        Route::resource('/guru', 'GuruController');

        Route::prefix("kk")->name("kk.")->group(function () {
            Route::get("/get_list", "KKController@get_list")->name("get_list");
        });
        Route::resource('/kk', 'KKController');

        Route::prefix("siswa")->name("siswa.")->group(function () {
            Route::get("/update_foto/{id}", "SiswaController@update_foto")->name("update_foto");
            Route::get("/update_foto/{id}", "SiswaController@update_foto")->name("update_foto");
            Route::post("/simpan_foto/{id}", "SiswaController@simpan_foto")->name("simpan_foto");
        });
        Route::resource('/siswa', 'SiswaController');

        Route::prefix("orang_tua")->name("orang_tua.")->group(function () {
            Route::get("/update_foto/{id}", "OrangTuaController@update_foto")->name("update_foto");
            Route::post("/simpan_foto/{id}", "OrangTuaController@simpan_foto")->name("simpan_foto");
            Route::get("/get_list", "OrangTuaController@get_list")->name("get_list");
            Route::get("/list_orang_tua/{id_siswa}", "OrangTuaController@list_orang_tua")->name("list_orang_tua");
        });
        Route::resource('/orang_tua', 'OrangTuaController');

        Route::prefix("tahun_ajaran")->name("tahun_ajaran.")->group(function () {
            Route::post("/aktifkan_tahun", "TahunAjaranController@aktifkan_tahun")->name("aktifkan_tahun");
        });
        Route::resource('/tahun_ajaran', 'TahunAjaranController');
        Route::resource('/user', 'UserController');
    });

    Route::middleware(["role:admin"])->group(function() {
        Route::post('/admin/pengumuman/simpan', 'PengumumanController@simpan')->name('admin.pengumuman.simpan');
        Route::resource('/pengumuman', 'PengumumanController');
    });
});

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
// Route::get('/login/cek_email/json', 'UserController@cek_email');
// Route::get('/login/cek_password/json', 'UserController@cek_password');
// Route::post('/cek-email', 'UserController@email')->name('cek-email')->middleware('guest');
// Route::get('/reset/password/{id}', 'UserController@password')->name('reset.password')->middleware('guest');
// Route::patch('/reset/password/update/{id}', 'UserController@update_password')->name('reset.password.update')->middleware('guest');

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

    Route::middleware(["admin"])->prefix("master_data")->group(function () {
        Route::resource('/guru', 'GuruController');
        Route::prefix("guru")->name("guru.")->group(function () {
            Route::get("/export_excel", "GuruController@export_excel")->name("export_excel");
            Route::get("/import_excel", "GuruController@import_excel")->name("import_excel");
            Route::get("/ubah_foto/{id}", "GuruController@ubah_foto")->name("ubah_foto");
        });

        Route::resource('/siswa', 'SiswaController');

        Route::resource('/orang_tua', 'OrangTuaController');
        Route::prefix("orang_tua")->name("orang_tua.")->group(function () {
            Route::get("/export_excel", "OrangTuaController@export_excel")->name("export_excel");
            Route::get("/import_excel", "OrangTuaController@import_excel")->name("import_excel");
            Route::get("/ubah_foto/{id}", "OrangTuaController@ubah_foto")->name("ubah_foto");
        });

        Route::resource('/kelas', 'KelasControler');
        Route::resource('/tahun_ajaran', 'TahunAjaranController');
        Route::resource('/user', 'UserController');
        Route::resource('/monitoring_rumah', 'MonitoringRumahController');
        Route::resource('/pengumuman', 'PengumumanController');
    });
});

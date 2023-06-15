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
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/pengaturan/profile', 'UserController@edit_profile')->name('pengaturan.profile');
    Route::post('/pengaturan/ubah-profile', 'UserController@ubah_profile')->name('pengaturan.ubah-profile');
    Route::get('/pengaturan/edit-foto', 'UserController@edit_foto')->name('pengaturan.edit-foto');
    Route::post('/pengaturan/ubah-foto', 'UserController@ubah_foto')->name('pengaturan.ubah-foto');
    Route::get('/pengaturan/email', 'UserController@edit_email')->name('pengaturan.email');
    Route::post('/pengaturan/ubah-email', 'UserController@ubah_email')->name('pengaturan.ubah-email');
    Route::get('/pengaturan/password', 'UserController@edit_password')->name('pengaturan.password');
    Route::post('/pengaturan/ubah-password', 'UserController@ubah_password')->name('pengaturan.ubah-password');

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/home', 'HomeController@admin')->name('admin.home');
        Route::get('/admin/pengumuman', 'PengumumanController@index')->name('admin.pengumuman');
        Route::post('/admin/pengumuman/simpan', 'PengumumanController@simpan')->name('admin.pengumuman.simpan');

        Route::resource('/guru', 'GuruController');
        Route::get('/guru/ubah-foto/{id}', 'GuruController@ubah_foto')->name('guru.ubah-foto');
        Route::post('/guru/update-foto/{id}', 'GuruController@update_foto')->name('guru.update-foto');
        Route::post('/guru/upload', 'GuruController@upload')->name('guru.upload');
        Route::get('/guru/export_excel', 'GuruController@export_excel')->name('guru.export_excel');
        Route::post('/guru/import_excel', 'GuruController@import_excel')->name('guru.import_excel');
        Route::delete('/guru/deleteAll', 'GuruController@deleteAll')->name('guru.deleteAll');

        Route::resource('/siswa', 'SiswaController');
        Route::get('/siswa/kelas/{id}', 'SiswaController@kelas')->name('siswa.kelas');
        Route::get('/siswa/view/json', 'SiswaController@view');
        Route::get('/listsiswapdf/{id}', 'SiswaController@cetak_pdf');
        Route::get('/siswa/ubah-foto/{id}', 'SiswaController@ubah_foto')->name('siswa.ubah-foto');
        Route::post('/siswa/update-foto/{id}', 'SiswaController@update_foto')->name('siswa.update-foto');
        Route::get('/siswa/export_excel', 'SiswaController@export_excel')->name('siswa.export_excel');
        Route::post('/siswa/import_excel', 'SiswaController@import_excel')->name('siswa.import_excel');
        Route::delete('/siswa/deleteAll', 'SiswaController@deleteAll')->name('siswa.deleteAll');

        Route::resource('/orang_tua', 'OrangTuaController');
        Route::get('/orang_tua/view/json', 'OrangTuaController@view');
        Route::get('/listorang_tuapdf/{id}', 'OrangTuaController@cetak_pdf');
        Route::get('/orang_tua/ubah-foto/{id}', 'OrangTuaController@ubah_foto')->name('orang_tua.ubah-foto');
        Route::post('/orang_tua/update-foto/{id}', 'OrangTuaController@update_foto')->name('orang_tua.update-foto');
        Route::get('/orang_tua/export_excel', 'OrangTuaController@export_excel')->name('orang_tua.export_excel');
        Route::post('/orang_tua/import_excel', 'OrangTuaController@import_excel')->name('orang_tua.import_excel');
        Route::delete('/orang_tua/deleteAll', 'OrangTuaController@deleteAll')->name('orang_tua.deleteAll');
        Route::get('/orang_tua/edit_anak/{id}', 'OrangTuaController@edit_anak')->name('orang_tua.edit_anak');
        Route::delete('/orang_tua/hapus_anak/{id_siswa}/{id_orang_tua}', 'OrangTuaController@hapus_anak')->name('orang_tua.hapus_anak');

        Route::resource('/kelas', 'KelasController');

        Route::resource('/user', 'UserController');

        

    });
    Route::middleware(['guru'])->group(function () {
        
    });

    Route::middleware(['orang_tua'])->group(function () {
        
    });

    
});


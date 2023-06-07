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
    Route::get('/profile', function () {})->name('profile');
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/home', 'HomeController@admin')->name('admin.home');
        Route::get('/admin/pengumuman', 'PengumumanController@index')->name('admin.pengumuman');
        Route::post('/admin/pengumuman/simpan', 'PengumumanController@simpan')->name('admin.pengumuman.simpan');

        Route::resource('/guru', 'GuruController');
        Route::get('/guru/export_excel', 'GuruController@export_excel')->name('guru.export_excel');
        Route::post('/guru/import_excel', 'GuruController@import_excel')->name('guru.import_excel');
        Route::delete('/guru/deleteAll', 'GuruController@deleteAll')->name('guru.deleteAll');

        Route::resource('/siswa', 'SiswaController');

        Route::resource('/kelas', 'KelasController');

        Route::resource('/user', 'UserController');

        

    });
    Route::middleware(['guru'])->group(function () {
        
    });
});


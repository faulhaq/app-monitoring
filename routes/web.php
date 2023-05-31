<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuruMiddleware;
use App\Http\Middleware\OrangTuaMiddleware;
use App\Http\Middleware\WaliKelasMiddleware;

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

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.login');

Route::middleware(AdminMiddleware::class)->prefix("/admin")->group(function () {
    Route::get('/dashboard', function () {
        return view("admin.dashboard");
    })->name("admin.dashboard");
});

Route::middleware(OrangTuaMiddleware::class)->prefix("/orang_tua")->group(function () {
    Route::get('/dashboard', function () {
        return view("orang_tua.dashboard");
    })->name("orang_tua.dashboard");
});

Route::middleware(GuruMiddleware::class)->prefix("/guru")->group(function () {
    Route::get('/dashboard', function () {
        return view("guru.dashboard");
    })->name("guru.dashboard");
});

Route::middleware(WalikelasMiddleware::class)->prefix("/wali_kelas")->group(function () {
    Route::get('/dashboard', function () {
        return view("wali_kelas.dashboard");
    })->name("wali_kelas.dashboard");
});

Route::get("/logout", function () {
    session()->forget('user_id');
    session()->forget('role');
    return redirect(route("login"));
})->name("logout");

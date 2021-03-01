<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


//Admin
Route::get('/admin', function () {
    return view('pages/admin/dashboard');
})->name("Admin Home");

Route::get('/admin/login', function () {
    return view('pages/auth/LoginAdmin');
})->name("Admin Login");


//Informasi
Route::get('/admin/informasi/informasi-penting/home', function(){
    return view('pages.admin.informasi.informasi-penting');
})->name('informasi-penting.home');

Route::get('/admin/informasi/persebaran-posyandu/home', function(){
    return view('pages.admin.informasi.sig-posyandu');
})->name('sig-posyandu.home');


//Anak
Route::get('/register/bayi-balita', function () {
    return view('pages/auth/anak/register-anak');
})->name("Register Anak");

Route::get('/data-diri/bayi-balita', function () {
    return view('pages/auth/anak/data-diri-anak');
})->name("Data Diri Anak");

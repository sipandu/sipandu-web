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

Route::get('/admin', function () {
    return view('pages/admin/Dashboard');
})->name("Admin Home");

Route::get('/admin/login', function () {
    return view('pages/auth/LoginAdmin');
})->name("Admin Login");

Route::get('/register', function () {
    return view('pages/auth/register-anak');
})->name("Register Anak");

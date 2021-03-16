<?php

use App\Http\Controllers\KegiatanController;
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
Route::get('/register', function () {
    return view('pages/auth/register-anak');
})->name("Register Anak");

//Informasi Penting
Route::get('/admin/informasi-penting/home', 'InformasiPentingController@index')->name('informasi_penting.home');
Route::get('/admin/informasi-penting/create', 'InformasiPentingController@create')->name('informasi_penting.create');
Route::post('/admin/informasi-penting/store', 'InformasiPentingController@store')->name('informasi_penting.store');

//Penyuluhan
Route::get('/admin/penyuluhan/home', 'PenyuluhanController@index')->name('penyuluhan.home');
Route::get('/admin/penyuluhan/create', 'PenyuluhanController@create')->name('penyuluhan.create');
Route::post('/admin/penyuluhan/store', 'PenyuluhanController@store')->name('penyuluhan.store');
Route::get('/admin/penyuluhan/show/{id}', 'PenyuluhanController@show')->name('penyuluhan.show');
Route::post('/admin/penyuluhan/update/{id}', 'PenyuluhanController@update')->name('penyuluhan.update');
Route::get('/admin/penyuluhan/get-img/{id}', 'PenyuluhanController@getImage')->name('penyuluhan.get_img');
Route::post('/admin/penyuluhan/delete', 'PenyuluhanController@delete')->name('penyuluhan.delete');

//Kegiatan
Route::get('/admin/kegiatan/home', 'KegiatanController@index')->name('kegiatan.home');
Route::get('/admin/kegiatan/create', 'KegiatanController@create')->name('kegiatan.create');
Route::post('/admin/kegiatan/store', 'KegiatanController@store')->name('kegiatan.store');
Route::get('/admin/kegiatan/show/{id}', 'KegiatanController@show')->name('kegiatan.show');
Route::post('/admin/kegiatan/update/{id}', 'KegiatanController@update')->name('kegiatan.update');
Route::post('/admin/kegiatan/delete', 'KegiatanController@delete')->name('kegiatan.delete');
Route::get('/admin/kegiatan/broadcast/{id}', 'KegiatanController@broadcast')->name('kegiatan.broadcast');

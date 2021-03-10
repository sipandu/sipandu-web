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


//Admin
Route::get('/admin', function () {
    return view('pages/admin/dashboard');
})->name("Admin Home");

Route::get('/admin/login', function () {
    return view('pages/auth/admin/login-admin');
})->name("Admin Login");

Route::get('/admin/account/new-admin', function () {
    return view('pages/auth/admin/new-admin');
})->name("Add Admin");

Route::get('/admin/account/new-kader', function () {
    return view('pages/auth/admin/new-kader');
})->name("Add Kader");

Route::get('/admin/account/new-user', function () {
    return view('pages/auth/admin/new-user');
})->name("Add User");

Route::get('/admin/profile', function () {
    return view('pages/auth/admin/profile-admin');
})->name("Profile Admin");

Route::get('/refresh-captcha', 'Admin\Auth\ChangeCaptcha@refreshCaptcha');



// Master Data
// Route::get('/admin/posyandu/new', function () {
//     return view('pages/admin/master-data/new-posyandu');
// })->name("Add Posyandu");

// Route::get('/admin/posyandu/all', function () {
//     return view('pages/admin/master-data/data-posyandu');
// })->name("Data Posyandu");

Route::get('/admin/posyandu/all', 'MasterDataController@listPosyandu')->name("Data Posyandu");

Route::get('/admin/posyandu/new', 'MasterDataController@addPosyandu')->name("Add Posyandu");

Route::post('/admin/posyandu/add', 'MasterDataController@storePosyandu')->name("New Posyandu");

Route::get('/admin/posyandu/profile', function () {
    return view('pages/admin/master-data/profile-posyandu');
})->name("Profile Posyandu");



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


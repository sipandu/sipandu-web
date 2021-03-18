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
    return view('landing_page');
});

Route::get('/', function () {
    dd("test");
});


//Admin

Route::get('/refresh-captcha', 'Admin\Auth\ChangeCaptcha@refreshCaptcha');



// Master Data
Route::get('/admin/posyandu/all', 'MasterDataController@listPosyandu')->name("Data Posyandu");
Route::get('/admin/posyandu/new', 'MasterDataController@addPosyandu')->name("Add Posyandu");
Route::post('/admin/posyandu/add', 'MasterDataController@storePosyandu')->name("New Posyandu");
Route::get('/admin/posyandu/detail/{posyandu}', 'MasterDataController@detailPosyandu')->name("Detail Posyandu");
Route::get('/admin/posyandu/edit/{posyandu}', 'MasterDataController@editPosyandu')->name("Edit Posyandu");
Route::post('/admin/posyandu/update/{posyandu}', 'MasterDataController@updatePosyandu')->name("Update Posyandu");
Route::post('/admin/posyandu/update-admin/{pegawai}', 'MasterDataController@updateAdminPosyandu')->name("Update Admin Posyandu");
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
// Route::get('/register', function () {
//     return view('pages/auth/user/form-register');
// })->name("Register Anak");

// Route::get('/data-diri/bayi-balita', function () {
//     return view('pages/auth/user/data-diri/anak');
// })->name("Data Diri Anak");

Route::get('/user', function () {
    return view('pages/user/dashboard');
});

Route::get('/test', 'User\Auth\RegisController@test');

Route::get('/user/account/new-user', function () {
    return view('pages/auth/user/new-anggota');
})->name("form.add.anggota.keluarga");

Route::get('/password', function () {
    return view('pages/auth/forgot-password');
});

// Ajax Dependent Select //
Route::get('/kecamatan/{id}', 'AjaxSearchLocation@kecamatan');
Route::get('/desa/{id}', 'AjaxSearchLocation@desa');
Route::get('/banjar/{id}', 'AjaxSearchLocation@banjar');


// REGISTER //
Route::prefix('register')->namespace('User\Auth')->group(function() {
    Route::get('/landing', 'RegisController@landingRegis')->name('landing.regis');
    Route::get('/verif', 'RegisController@landingVerif')->name('landing.verif');
    Route::post('/landing', 'RegisController@submitLanding')->name('landing.regis.submit');
    Route::prefix('submit')->group(function(){
        Route::post('/anak', 'RegisController@sumbmitRegisAnak')->name('anak.registrasi.submit');
        Route::post('/lansia', 'RegisController@sumbmitRegisLansia')->name('lansia.registrasi.submit');
        Route::post('/ibu', 'RegisController@sumbmitRegisIbu')->name('ibu.registrasi.submit');
    });
    Route::prefix('data-diri')->group(function(){
        Route::get('/anak', 'RegisController@showRegisFormAnak')->name('anak.data-diri.form');
        Route::get('/ibu', 'RegisController@showRegisFormIbu')->name('anak.data-diri.form');
        Route::get('/lansia', 'RegisController@showRegisFormLansia')->name('anak.data-diri.form');
        Route::post('/anak', 'RegisController@submitDatadiriAnak')->name('anak.data-diri.submit');
    });

});

// LOGIN //
Route::prefix('login')->group(function(){
    Route::prefix('admin')->namespace('Admin\Auth')->group(function(){
        Route::get('/', 'LoginController@showLoginForm')->name('form.admin.login');
        Route::post('/submit', 'LoginController@submitLogin')->name('submit.login.admin');
        Route::get('/logout', 'LoginController@logoutAdmin')->name('logout.admin');
    });
    Route::prefix('user')->namespace('User\Auth')->group(function(){
        Route::get('/', 'LoginController@showForm')->name('form.user.login');
        Route::post('/submit', 'LoginController@submitLogin')->name('submit.user.login');
        Route::get('/logout', 'LoginController@logoutUser')->name('logout.user');
    });

});

//ADMIN DASBOARD//
Route::prefix('admin')->namespace('Admin')->group(function(){
    Route::get('/', 'AdminController@index')->name('Admin Home');
    Route::get('/profile', 'AdminController@profile')->name('profile.admin');
    Route::prefix('edit')->group(function(){
        Route::post('/profile', 'AdminController@profileUpdate')->name('edit.profile');
        Route::post('/account', 'AdminController@accountUpdate')->name('edit.account');
        Route::post('/password', 'AdminController@passwordUpdate')->name('edit.password');
    });
    Route::prefix('account')->namespace('Auth')->group(function(){
        Route::get('/new-admin/show', 'RegisController@formAddAdmin')->name('Add Admin');
        Route::get('/new-user/show', 'RegisController@formAddUser')->name('Add User');
        Route::get('/new-kader/show', 'RegisController@formAddKader')->name('Add Kader');
        Route::post('/new-admin/store', 'RegisController@storeAdmin')->name('create.add.admin.kader');
        Route::post('/new-user-ibu/store', 'RegisController@storeUserIbu')->name('create.account.ibu');
        Route::post('/new-user-anak/store', 'RegisController@storeUserAnak')->name('create.account.anak');
        Route::post('/new-user-lansia/store', 'RegisController@storeUserLansia')->name('create.account.lansia');
    });

});


// //USER DASBOARD//
Route::prefix('user')->namespace('User')->group(function(){
    Route::get('/', 'UserController@index')->name('user.home');
//     // // Route::get('/profile', 'UserController@profile')->name('profile.user');
//     // Route::prefix('edit')->group(function(){
//     //     Route::post('/profile', 'AdminController@updateProfile')->name('edit.profile');
//     //     Route::post('/password', 'AdminController@updatePassword')->name('edit.password');
//     //     Route::post('/account', 'AdminController@updateAccount')->name('edit.account');
//     // });
//     Route::prefix('account')->group(function(){
//         Route::get('/new', 'RegisController@formAddAdmin')->name('form.add.anggota.keluarga');
//         Route::post('/new-user-ibu', 'RegisController@submitUserIbu')->name('submit.add.user');
//         Route::post('/new-user-anak', 'RegisController@submitUserAnak')->name('submit.add.user');
//         Route::post('/new-user-lansia', 'RegisController@submitUserLansia')->name('submit.add.user');
//     });

});







//Informasi Penting
Route::get('/admin/informasi-penting/home', 'InformasiPentingController@index')->name('informasi_penting.home');
Route::get('/admin/informasi-penting/create', 'InformasiPentingController@create')->name('informasi_penting.create');
Route::post('/admin/informasi-penting/store', 'InformasiPentingController@store')->name('informasi_penting.store');
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


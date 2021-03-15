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

Route::get('/refresh-captcha', 'Admin\Auth\ChangeCaptcha@refreshCaptcha');

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

Route::get('/', function () {
    return view('landing_page');
});

// Ajax Dependent Select //
Route::get('/kecamatan/{id}', 'AjaxSearchLocation@kecamatan');
Route::get('/desa/{id}', 'AjaxSearchLocation@desa');
Route::get('/banjar/{id}', 'AjaxSearchLocation@banjar');


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
    Route::get('/profile', 'AdminController@profile')->name('profile.admin');
    Route::get('/profile', 'AdminController@profile')->name('profile.admin');
    Route::prefix('edit')->group(function(){
        Route::post('/profile', 'AdminController@updateProfile')->name('edit.profile');
        Route::post('/password', 'AdminController@updatePassword')->name('edit.password');
        Route::post('/account', 'AdminController@updateAccount')->name('edit.account');
    });
    Route::prefix('account')->namespace('Auth')->group(function(){
        Route::get('/new-admin', 'RegisController@formAddAdmin')->name('Add Admin');
        Route::get('/new-user', 'RegisController@formAddUser')->name('Add User');
        Route::get('/new-kader', 'RegisController@formAddKader')->name('Add Kader');
        Route::post('/new-admin', 'RegisController@submitAdmin')->name('submit.add.admin.kader');
        Route::post('/new-user-ibu', 'RegisController@submitUserIbu')->name('submit.add.user');
        Route::post('/new-user-anak', 'RegisController@submitUserAnak')->name('submit.add.user');
        Route::post('/new-user-lansia', 'RegisController@submitUserLansia')->name('submit.add.user');
    });

});


// //ADMIN DASBOARD//
// Route::prefix('user')->namespace('User')->group(function(){
//     Route::get('/', 'AdminController@profile')->name('profile.admin');
//     Route::get('/profile', 'AdminController@profile')->name('profile.admin');
//     Route::prefix('edit')->group(function(){
//         Route::post('/profile', 'AdminController@updateProfile')->name('edit.profile');
//         Route::post('/password', 'AdminController@updatePassword')->name('edit.password');
//         Route::post('/account', 'AdminController@updateAccount')->name('edit.account');
//     });
//     Route::prefix('account')->group(function(){
//         Route::get('/new-admin', 'RegisController@formAddAdmin')->name('Add Admin');
//         Route::get('/new-user', 'RegisController@formAddUser')->name('Add User');
//         Route::get('/new-kader', 'RegisController@formAddKader')->name('Add Kader');
//         Route::post('/new-admin', 'RegisController@submitAdmin')->name('submit.add.admin.kader');
//         Route::post('/new-user-ibu', 'RegisController@submitUserIbu')->name('submit.add.user');
//         Route::post('/new-user-anak', 'RegisController@submitUserAnak')->name('submit.add.user');
//         Route::post('/new-user-lansia', 'RegisController@submitUserLansia')->name('submit.add.user');
//     });

// });







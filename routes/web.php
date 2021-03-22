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



//Admin
Route::get('/refresh-captcha', 'Admin\Auth\ChangeCaptcha@refreshCaptcha');



// Master Data
Route::get('/admin/posyandu/all', 'Admin\MasterData\MasterPosyanduController@listPosyandu')->name("Data Posyandu");
Route::get('/admin/posyandu/new', 'Admin\MasterData\MasterPosyanduController@addPosyandu')->name("Add Posyandu");
Route::post('/admin/posyandu/add', 'Admin\MasterData\MasterPosyanduController@storePosyandu')->name("New Posyandu");
Route::get('/admin/posyandu/detail/{posyandu}', 'Admin\MasterData\MasterPosyanduController@detailPosyandu')->name("Detail Posyandu");
Route::get('/admin/posyandu/edit/{posyandu}', 'Admin\MasterData\MasterPosyanduController@editPosyandu')->name("Edit Posyandu");
Route::post('/admin/posyandu/update/{posyandu}', 'Admin\MasterData\MasterPosyanduController@updatePosyandu')->name("Update Posyandu");
Route::post('/admin/posyandu/update-admin/{pegawai}', 'Admin\MasterData\MasterPosyanduController@updateAdminPosyandu')->name("Update Admin Posyandu");

Route::get('/admin/posyandu/profile', 'Admin\MasterData\MasterPosyanduController@profilePosyandu')->name("Profile Posyandu");
Route::get('/admin/posyandu/edit', 'Admin\MasterData\MasterPosyanduController@editProfilePosyandu')->name("Edit Profile Posyandu");

Route::get('/admin/data-admin/all', 'Admin\MasterData\DataAdminController@listAdmin')->name("Data Admin");
Route::get('/admin/data-admin/detail', 'Admin\MasterData\DataAdminController@detailAdmin')->name("Detail Admin");

Route::get('/admin/data-kader/all', 'Admin\MasterData\DataKaderController@listKader')->name("Data Kader");
Route::get('/admin/data-kader/detail', 'Admin\MasterData\DataKaderController@detailKader')->name("Detail Kader");

Route::get('/admin/data-anggota/all', 'Admin\MasterData\DataAnggotaController@listAnggota')->name("Data Anggota");
Route::get('/admin/data-anggota/detail', 'Admin\MasterData\DataAnggotaController@detailAnggota')->name("Detail Anggota");



//Informasi
Route::get('/admin/informasi/informasi-penting/home', function(){
    return view('pages.admin.informasi.informasi-penting');
})->name('informasi-penting.home');

Route::get('/admin/informasi/persebaran-posyandu/home', function(){
    return view('pages.admin.informasi.sig-posyandu');
})->name('sig-posyandu.home');



Route::get('/user', function () {
    return view('pages/user/dashboard');
});

Route::get('/test', 'User\Auth\RegisController@test');

Route::get('/user/account/new-user', function () {
    return view('pages/auth/user/new-anggota');
})->name("form.add.anggota.keluarga");

// <<<<<<< HEAD
// Route::get('/password', function () {
//     return view('pages/auth/forgot-password');
// });

// =======
Route::get('/', function () {
    return view('pages/landing-page');
})->name('Landing Page');

Route::get('/test', function () {
    return view('test');
});




// >>>>>>> origin/loginRegis
// Ajax Dependent Select //
Route::get('/kecamatan/{id}', 'AjaxSearchLocation@kecamatan');
Route::get('/desa/{id}', 'AjaxSearchLocation@desa');
Route::get('/banjar/{id}', 'AjaxSearchLocation@banjar');




// REGISTER  USER//
Route::prefix('register')->namespace('User\Auth')->group(function() {
    Route::get('/landing', 'RegisController@landingRegis')->name('landing.regis');
    Route::post('/landing', 'RegisController@submitLanding')->name('landing.regis.submit');
    Route::get('/verif', 'RegisController@landingVerif')->name('landing.verif');
    Route::get('/user', 'RegisController@formRegisAwal')->name('register.pertama');
    Route::post('user/anak', 'RegisController@storeAnak')->name('anak.registrasi.submit');
    Route::post('user/ibu', 'RegisController@storeIbu')->name('ibu.registrasi.submit');
    Route::post('user/lansia', 'RegisController@storeLansia')->name('lansia.registrasi.submit');

    Route::prefix('data-diri')->group(function(){
        Route::get('/anak', 'RegisDataDiriController@showRegisFormAnak')->name('anak.data-diri.form');
        Route::get('/ibu', 'RegisDataDiriController@showRegisFormIbu')->name('ibu.data-diri.form');
        Route::get('/lansia', 'RegisDataDiriController@showRegisFormLansia')->name('lansia.data-diri.form');
        Route::post('/anak/store', 'RegisDataDiriController@storeDataAnak')->name('anak.data-diri.submit');
        Route::post('/ibu/store', 'RegisDataDiriController@storeDataIbu')->name('ibu.data-diri.submit');
        Route::post('/lansia/store', 'RegisDataDiriController@storeDataLansia')->name('lansia.data-diri.submit');
    });

});



// LOGIN //
Route::prefix('login')->group(function(){
    Route::prefix('admin')->namespace('Admin\Auth')->group(function(){
        Route::get('/', 'LoginController@showLoginForm')->name('form.admin.login');
        Route::post('/submit', 'LoginController@submitLogin')->name('submit.login.admin');
        Route::get('/logout', 'LoginController@logoutAdmin')->name('logout.admin');
        Route::get('/reset/password', 'ForgotPasswordController@showForm')->name('form.reset-password');
        Route::post('/reset/password', 'ForgotPasswordController@postEmail')->name('post.email');
        Route::get('/verify/token', 'ResetPasswordController@showForm')->name('form.verify.token');
        Route::post('/verify/token', 'ResetPasswordController@cekOTP')->name('cek.otp.token');
        Route::get('/password/reset/{otp_token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'ResetPasswordController@passwordUpdate')->name('password.update');

    });
    Route::prefix('user')->namespace('User\Auth')->group(function(){
        Route::get('/', 'LoginController@showForm')->name('form.user.login');
        Route::post('/submit', 'LoginController@submitLogin')->name('submit.user.login');
        Route::get('/logout', 'LoginController@logoutUser')->name('logout.user');
        Route::get('/reset/password', 'ForgotPasswordController@showForm')->name('user.form.reset-password');
        Route::post('/reset/password', 'ForgotPasswordController@postEmail')->name('user.post.email');
        Route::post('/forget-password/request-token/telegram', 'ForgotPasswordController@postTelegram')->name('user.forget.tele');
        Route::get('/verify/token', 'ResetPasswordController@showForm')->name('user.form.verify.token');
        Route::post('/verify/token', 'ResetPasswordController@cekOTP')->name('user.cek.otp.token');
        Route::get('/password/reset/{otp_token}', 'ResetPasswordController@showResetForm')->name('user.password.reset');
        Route::post('/password/reset', 'ResetPasswordController@passwordUpdate')->name('user.password.update');
    });
});


//ADMIN DASBOARD//
Route::prefix('admin')->namespace('Admin\Auth')->group(function(){
    Route::get('/', 'AdminController@index')->name('Admin Home');
    Route::get('/profile', 'AdminController@profile')->name('profile.admin');
    Route::get('/verify', 'AdminController@showVerifyUser')->name('show.verify');
    Route::get('/verify/detail', 'AdminController@detailVerifyUser')->name('detail.verify');
    Route::prefix('edit')->group(function(){
        Route::post('/profile', 'AdminController@profileUpdate')->name('edit.profile');
        Route::post('/account', 'AdminController@accountUpdate')->name('edit.account');
        Route::post('/password', 'AdminController@passwordUpdate')->name('edit.password');
    });
    Route::prefix('account')->group(function(){
        Route::get('/new-admin/show', 'RegisController@formAddAdmin')->name('Add Admin');
        Route::get('/new-user/show', 'RegisController@formAddUser')->name('Add User');
        Route::get('/new-kader/show', 'RegisController@formAddKader')->name('Add Kader');
        Route::post('/new-admin/store', 'RegisController@storeAdmin')->name('create.add.admin.kader');
        Route::post('/new-user-ibu/store', 'RegisController@storeUserIbu')->name('create.account.ibu');
        Route::post('/new-user-anak/store', 'RegisController@storeUserAnak')->name('create.account.anak');
        Route::post('/new-user-lansia/store', 'RegisController@storeUserLansia')->name('create.account.lansia');
    });
});



//USER DASBOARD//
Route::prefix('user')->namespace('User\Auth')->group(function(){
    Route::get('/', 'UserController@anakhome')->name('anak.home');
    Route::get('/ibu', 'UserController@ibuhome')->name('ibu.home');
    Route::get('/lansia', 'UserController@lansiahome')->name('lansia.home');

    Route::get('/profile', 'UserController@profile')->name('profile.user');
    Route::prefix('edit')->group(function(){
        Route::post('/profile', 'AdminController@updateProfile')->name('edit.profile');
        Route::post('/password', 'AdminController@updatePassword')->name('edit.password');
        Route::post('/account', 'AdminController@updateAccount')->name('edit.account');
    });

});



//Blog
Route::get('/blog', function () {
    return view('pages/user/blog/news');
})->name("berita");
Route::get('/penyuluhan', function () {
    return view('user/blog/penyuluhan');
})->name('Penyuluhan');



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


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

// Route::get('/', function () {
//     return view('landing_page');
// })->name("Landing Page");



//Admin
Route::get('/refresh-captcha', 'Admin\Auth\ChangeCaptcha@refreshCaptcha');



//Data Posyandu
Route::get('/admin/posyandu/all', 'Admin\MasterData\MasterPosyanduController@listPosyandu')->name("Data Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::get('/admin/posyandu/new', 'Admin\MasterData\MasterPosyanduController@addPosyandu')->name("Add Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::post('/admin/posyandu/add', 'Admin\MasterData\MasterPosyanduController@storePosyandu')->name("New Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::get('/admin/posyandu/detail/{posyandu}', 'Admin\MasterData\MasterPosyanduController@detailPosyandu')->name("Detail Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::get('/admin/posyandu/edit/{posyandu}', 'Admin\MasterData\MasterPosyanduController@editPosyandu')->name("Edit Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::post('/admin/posyandu/update/{posyandu}', 'Admin\MasterData\MasterPosyanduController@updatePosyandu')->name("Update Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::post('/admin/posyandu/update-admin/', 'Admin\MasterData\MasterPosyanduController@updateAdminPosyandu')->name("Update Posyandu-Admin")->middleware("cek:super admin,param2,param3,param4,param5");

//Profile Posyandu
Route::get('/admin/profile-posyandu/profile', 'Admin\MasterData\DataPosyanduController@profilePosyandu')->name("Profile Posyandu")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::get('/admin/profile-posyandu/edit/{posyandu}', 'Admin\MasterData\DataPosyanduController@editProfilePosyandu')->name("Edit Profile Posyandu")->middleware("cek:head admin,kader,tenaga kesehatan,admin,param5");
Route::post('/admin/profile-posyandu/update/{posyandu}', 'Admin\MasterData\DataPosyanduController@updateProfilePosyandu')->name("Update Profile Posyandu")->middleware("cek:head admin,admin,param3,param4,param5");
Route::post('/admin/profile-posyandu/update-admin/', 'Admin\MasterData\DataPosyanduController@updateAdminPosyandu')->name("Update Admin Posyandu")->middleware("cek:head admin,param2,param3,param4,param5");

//Data Admin
Route::get('/admin/data-admin/all', 'Admin\MasterData\DataAdminController@listAdmin')->name("Data Admin")->middleware("cek:super admin,head admin,admin,param4,param5");
Route::get('/admin/data-admin/detail/{pegawai}', 'Admin\MasterData\DataAdminController@detailAdmin')->name("Detail Admin")->middleware("cek:super admin,head admin,admin,param4,param5");
Route::post('/admin/data-admin/update/{pegawai}', 'Admin\MasterData\DataAdminController@updateAdmin')->name("Update Data Admin")->middleware("cek:super admin,head admin,param3,param4,param5");

//Data Kader
Route::get('/admin/data-kader/all', 'Admin\MasterData\DataKaderController@listKader')->name("Data Kader")->middleware("cek:super admin,head admin,admin,kader,tenaga kesehatan");
Route::get('/admin/data-kader/detail/{pegawai}', 'Admin\MasterData\DataKaderController@detailKader')->name("Detail Kader")->middleware("cek:super admin,head admin,admin,kader,tenaga kesehatan");
Route::post('/admin/data-kader/update/{pegawai}', 'Admin\MasterData\DataKaderController@updateKader')->name("Update Data Kader")->middleware("cek:super admin,head admin,admin,param4,param5");

//Data Anggota
Route::get('/admin/data-anggota/all', 'Admin\MasterData\DataAnggotaController@listAnggota')->name("Data Anggota")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::get('/admin/data-anggota/detail/ibu/{ibu}', 'Admin\MasterData\DataAnggotaController@detailAnggotaIbu')->name("Detail Anggota Ibu")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::get('/admin/data-anggota/detail/anak/{anak}', 'Admin\MasterData\DataAnggotaController@detailAnggotaAnak')->name("Detail Anggota Anak")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::get('/admin/data-anggota/detail/lansia/{lansia}', 'Admin\MasterData\DataAnggotaController@detailAnggotaLansia')->name("Detail Anggota Lansia")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::post('/admin/data-anggota/update/ibu/{ibu}', 'Admin\MasterData\DataAnggotaController@updateAnggotaIbu')->name("Update Anggota Ibu")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::post('/admin/data-anggota/update/anak/{anak}', 'Admin\MasterData\DataAnggotaController@updateAnggotaAnak')->name("Update Anggota Anak")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::post('/admin/data-anggota/update/lansia/{lansia}', 'Admin\MasterData\DataAnggotaController@updateAnggotaLansia')->name("Update Anggota Lansia")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");



//Konsultasi
Route::get('nakes/konsultasi', 'Admin\KesehatanKeluarga\KonsultasiController@tambahKonsultasi')->name("Tambah Konsultasi");
Route::get('nakes/konsultasi/ibu/{ibu}', 'Admin\KesehatanKeluarga\KonsultasiController@konsultasiIbu')->name("Konsultasi Ibu");
Route::get('nakes/konsultasi/anak/{anak}', 'Admin\KesehatanKeluarga\KonsultasiController@konsultasiAnak')->name("Konsultasi Anak");
Route::get('nakes/konsultasi/lansia/{lansia}', 'Admin\KesehatanKeluarga\KonsultasiController@konsultasiLansia')->name("Konsultasi Lansia");



//Pemeriksaan
Route::get('nakes/pemeriksaan', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahPemeriksaan')->name("Tambah Pemeriksaan");
Route::get('nakes/pemeriksaan/ibu/{ibu}', 'Admin\KesehatanKeluarga\PemeriksaanController@pemeriksaanIbu')->name("Pemeriksaan Ibu");
Route::get('nakes/pemeriksaan/anak/{anak}', 'Admin\KesehatanKeluarga\PemeriksaanController@pemeriksaanAnak')->name("Pemeriksaan Anak");
Route::get('nakes/pemeriksaan/lansia/{lansia}', 'Admin\KesehatanKeluarga\PemeriksaanController@pemeriksaanLansia')->name("Pemeriksaan Lansia");



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


Route::get('/test', function () {
    return view('test');
});



// Ajax Dependent Select
    Route::get('/kecamatan/{id}', 'AjaxSearchLocation@kecamatan');
    Route::get('/desa/{id}', 'AjaxSearchLocation@desa');
    Route::get('/banjar/{id}', 'AjaxSearchLocation@banjar');
// End Ajax Dependent Select




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
        Route::get('/', 'LoginController@showLoginForm')->name('form.admin.login')->middleware('guest');
        Route::post('/submit', 'LoginController@submitLogin')->name('submit.login.admin');
        Route::get('/logout', 'LoginController@logoutAdmin')->name('logout.admin');
        Route::get('/reset/password', 'ForgotPasswordController@showForm')->name('form.reset-password');
        Route::post('/reset/password', 'ForgotPasswordController@postEmail')->name('post.email');
        Route::post('/reset/password/telegram', 'ForgotPasswordController@postTelegram')->name('post.telegram');
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
    Route::get('/verify', 'AdminController@showVerifyUser')->name('show.verify')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::get('/verify/detail/anak/{id}', 'AdminController@detailVerifyAnak')->name('detail.verify.anak')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::get('/verify/detail/lansia/{id}', 'AdminController@detailVerifyLansia')->name('detail.verify.lansia')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::get('/verify/detail/ibu/{id}', 'AdminController@detailVerifyIbu')->name('detail.verify.ibu')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::post('/verify/terima', 'AdminController@terimaUser')->name('terima.user')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::post('/verify/tolak', 'AdminController@tolakUser')->name('tolak.user')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::post('/status/update', 'AdminController@updateStatus')->name('edit.status.admin')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');

    Route::prefix('edit')->group(function(){
        Route::post('/profile', 'AdminController@profileUpdate')->name('edit.profile');
        Route::post('/account', 'AdminController@accountUpdate')->name('edit.account');
        Route::post('/password', 'AdminController@passwordUpdate')->name('edit.password');
    });
    Route::prefix('account')->group(function(){
        Route::get('/new-admin/show', 'RegisController@formAddAdmin')->name('Add Admin')->middleware('cek:head admin,super admin,test,param4,param5');
        Route::get('/new-user/show', 'RegisController@formAddUser')->name('Add User')->middleware('cek:kader,admin,head admin,tenaga kesehatan,param5');
        Route::get('/new-kader/show', 'RegisController@formAddKader')->name('Add Kader')->middleware('cek:super admin, kader,admin,head admin,param5');
        Route::post('/new-admin/store', 'RegisController@storeAdminKader')->name('create.add.admin.kader');
        Route::post('/new-user-ibu/store', 'RegisController@storeUserIbu')->name('create.account.ibu');
        Route::post('/new-user-anak/store', 'RegisController@storeUserAnak')->name('create.account.anak');
        Route::post('/new-user-lansia/store', 'RegisController@storeUserLansia')->name('create.account.lansia');
    });
});



//USER DASBOARD//
Route::prefix('user')->namespace('User\Auth')->group(function(){
    Route::get('/', 'UserController@anakhome')->name('anak.home')->middleware('userAkses:0,user:anak');
    Route::get('/ibu', 'UserController@ibuhome')->name('ibu.home')->middleware('userAkses:1,user:ibu');
    Route::get('/lansia', 'UserController@lansiahome')->name('lansia.home')->middleware('userAkses:2,user:lansia');

    Route::get('/anak/tambah-keluarga', 'TambahKeluargaController@formAnak')->name('Tambah Keluarga Anak');
    Route::get('/ibu/tambah-keluarga', 'TambahKeluargaController@formIbu')->name('Tambah Keluarga Ibu');
    Route::get('/lansia/tambah-keluarga', 'TambahKeluargaController@formLansia')->name('Tambah Keluarga Lansia');
    Route::post('/ibu/store', 'TambahKeluargaController@storeIbu')->name('ibu.store');
    Route::post('/anak/store', 'TambahKeluargaController@storeAnak')->name('anak.store');
    Route::post('/lansia/store', 'TambahKeluargaController@storeLansia')->name('lansia.store');

    Route::prefix('profile')->group(function(){
        Route::get('/anak', 'EditProfileController@anak')->name('anak.profile');
        Route::get('/ibu', 'EditProfileController@ibu')->name('ibu.profile');
        Route::get('/lansia', 'EditProfileController@lansia')->name('lansia.profile');
    });
    Route::prefix('edit')->group(function(){
        Route::post('/profile', 'EditProfileController@updateProfile')->name('edit.profile.user');
        Route::post('/password', 'EditProfileController@updatePassword')->name('edit.password.user');
        Route::post('/personal/user', 'EditProfileController@updatePersonalAnak')->name('edit.account.anak');
        Route::post('/personal/ibu', 'EditProfileController@updatePersonalIbu')->name('edit.account.ibu');
        Route::post('/personal/lansia', 'EditProfileController@updatePersonalLansia')->name('edit.account.lansia');
    });
});



//Riwayat Kesehatan Anggota Keluarga User
Route::prefix('keluarga')->namespace('User\Auth')->group(function(){
    Route::get('/anak', 'RiwayatKeluargaController@keluargaAnak')->name('Keluarga Anak');
    Route::get('/ibu', 'RiwayatKeluargaController@keluargaIbu')->name('Keluarga Ibu');
    Route::get('/lansia', 'RiwayatKeluargaController@keluargaLansia')->name('Keluarga Lansia');
    Route::prefix('riwayat')->group(function(){
        Route::get('/detail/anak', 'RiwayatKeluargaController@riwayatKeluargaAnak')->name('Riwayat Keluarga Anak');
        Route::get('/detail/ibu', 'RiwayatKeluargaController@riwayatKeluargaIbu')->name('Riwayat Keluarga Ibu');
        Route::get('/detail/lansia', 'RiwayatKeluargaController@riwayatKeluargaLansia')->name('Riwayat Keluarga Lansia');
    });
});

//Landing
Route::get('/', 'Landing\LandingController@index')->name('Landing Page');

//Blog User
Route::get('/blog', 'Landing\BlogController@index')->name("Berita");

Route::get('/blog/detail/{slug}', 'Landing\BlogController@show')->name("Detail Berita");

Route::get('/penyuluhan', 'Landing\PenyuluhanController@index')->name('Penyuluhan');
Route::get('/data-diri/bayi-balita', function () {
    return view('pages/auth/anak/data-diri-anak');
})->name("Data Diri Anak");

Route::get('/penyuluhan/detail/{slug}', 'Landing\PenyuluhanController@show')->name('Detail Penyuluhan');



//Informasi Penting
Route::get('/admin/informasi-penting/home', 'InformasiPentingController@index')->name('informasi_penting.home');
Route::get('/admin/informasi-penting/create', 'InformasiPentingController@create')->name('informasi_penting.create');
Route::post('/admin/informasi-penting/store', 'InformasiPentingController@store')->name('informasi_penting.store');
Route::get('/admin/informasi-penting/show/{id}', 'InformasiPentingController@show')->name('informasi_penting.show');
Route::post('/admin/informasi-penting/update/{id}', 'InformasiPentingController@update')->name('informasi_penting.update');
Route::get('/admin/informasi-penting/get-img/{id}', 'InformasiPentingController@getImage')->name('informasi_penting.get_img');
Route::post('/admin/informasi-penting/delete', 'InformasiPentingController@delete')->name('informasi_penting.delete');

//Penyuluhan
Route::get('/admin/penyuluhan/home', 'PenyuluhanController@index')->name('penyuluhan.home');
Route::get('/admin/penyuluhan/create', 'PenyuluhanController@create')->name('penyuluhan.create');
Route::post('/admin/penyuluhan/store', 'PenyuluhanController@store')->name('penyuluhan.store');
Route::get('/admin/penyuluhan/show/{id}', 'PenyuluhanController@show')->name('penyuluhan.show');
Route::post('/admin/penyuluhan/update/{id}', 'PenyuluhanController@update')->name('penyuluhan.update');
Route::get('/admin/penyuluhan/get-img/{id}', 'PenyuluhanController@getImage')->name('penyuluhan.get_img');
Route::post('/admin/penyuluhan/delete', 'PenyuluhanController@delete')->name('penyuluhan.delete');

//Pengumuman
Route::get('/admin/pengumuman/home', 'PengumumanController@index')->name('pengumuman.home');
Route::get('/admin/pengumuman/create', 'PengumumanController@create')->name('pengumuman.create');
Route::post('/admin/pengumuman/store', 'PengumumanController@store')->name('pengumuman.store');
Route::get('/admin/pengumuman/show/{id}', 'PengumumanController@show')->name('pengumuman.show');
Route::post('/admin/pengumuman/update/{id}', 'PengumumanController@update')->name('pengumuman.update');
Route::post('/admin/pengumuman/delete', 'PengumumanController@delete')->name('pengumuman.delete');
Route::get('/admin/pengumuman/get-img/{id}', 'PengumumanController@getImage')->name('pengumuman.get_img');

//Kegiatan
Route::get('/admin/kegiatan/home', 'KegiatanController@index')->name('kegiatan.home');
Route::get('/admin/kegiatan/create', 'KegiatanController@create')->name('kegiatan.create');
Route::post('/admin/kegiatan/store', 'KegiatanController@store')->name('kegiatan.store');
Route::get('/admin/kegiatan/show/{id}', 'KegiatanController@show')->name('kegiatan.show');
Route::post('/admin/kegiatan/update/{id}', 'KegiatanController@update')->name('kegiatan.update');
Route::post('/admin/kegiatan/delete', 'KegiatanController@delete')->name('kegiatan.delete');
Route::get('/admin/kegiatan/broadcast/{id}', 'KegiatanController@broadcast')->name('kegiatan.broadcast');


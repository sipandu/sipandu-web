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


//Landing Page
Route::get('/', 'Landing\LandingController@index')->name('Landing Page');

//Blog User
Route::get('/blog', 'Landing\BlogController@index')->name("Berita");
Route::get('/blog/detail/{slug}', 'Landing\BlogController@show')->name("Detail Berita");

//Penyuluhan
Route::get('/penyuluhan', 'Landing\PenyuluhanController@index')->name('Penyuluhan');
Route::get('/penyuluhan/detail/{slug}', 'Landing\PenyuluhanController@show')->name('Detail Penyuluhan');



//Login Admin dan User
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

//Refresh Captcha
Route::get('/refresh-captcha', 'Admin\Auth\ChangeCaptcha@refreshCaptcha');



//Registrasi User
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



//Admin
Route::prefix('admin')->namespace('Admin\Auth')->group(function(){
    Route::get('/', 'AdminController@index')->name('Admin Home');
    Route::get('/profile', 'AdminController@profile')->name('profile.admin');
    Route::post('/status/update', 'AccountController@updateStatus')->name('edit.status.admin')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');

    Route::get('/get-img', 'AdminController@getProfileImage')->name('profile.admin.get_img');
    Route::prefix('edit')->group(function(){
        Route::post('/profile', 'AdminController@profileUpdate')->name('edit.profile.admin');
        Route::post('/account', 'AdminController@accountUpdate')->name('edit.account');
        Route::post('/password', 'AdminController@passwordUpdate')->name('edit.password');
    });
});



//Management Account
Route::prefix('account')->namespace('Admin\Auth')->group(function(){
    //Add Account
    Route::get('/new-admin/show', 'RegisController@formAddAdmin')->name('Add Admin')->middleware('cek:head admin,super admin,param3,param4,param5');
    Route::get('/new-user/show', 'RegisController@formAddUser')->name('Add User')->middleware('cek:kader,admin,head admin,tenaga kesehatan,param5');
    Route::get('/new-kader/show', 'RegisController@formAddKader')->name('Add Kader')->middleware('cek:super admin,kader,admin,head admin,param5');

    //Store Account
    Route::post('/new-admin/store', 'RegisController@storeAdminKader')->name('create.add.admin.kader');
    Route::post('/new-user-ibu/store', 'RegisController@storeUserIbu')->name('create.account.ibu');
    Route::post('/new-user-anak/store', 'RegisController@storeUserAnak')->name('create.account.anak');
    Route::post('/new-user-lansia/store', 'RegisController@storeUserLansia')->name('create.account.lansia');

    //Image Verify Users
    Route::get('/verify', 'AccountController@showVerifyUser')->name('show.verify')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::get('/get-img/verify/{id}', 'AccountController@getKKImage')->name('verify.get_img')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');

    //Detail Verify Users
    Route::get('/verify/detail/anak/{id}', 'AccountController@detailVerifyAnak')->name('detail.verify.anak')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::get('/verify/detail/lansia/{id}', 'AccountController@detailVerifyLansia')->name('detail.verify.lansia')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::get('/verify/detail/ibu/{id}', 'AccountController@detailVerifyIbu')->name('detail.verify.ibu')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');

    //Verify Users
    Route::post('/verify/terima', 'AccountController@terimaUser')->name('terima.user')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');
    Route::post('/verify/tolak', 'AccountController@tolakUser')->name('tolak.user')->middleware('cek:head admin,admin,kader,tenaga kesehatan,param5');

    //Change Role
    Route::get('/role/change', 'AccountController@gantiJabatan')->name('Ganti Jabatan')->middleware('cek:super admin,param2,param3,param4,param5');
    Route::post('/role/change/update', 'AccountController@updateJabatan')->name('Update Jabatan')->middleware('cek:super admin,param2,param3,param4,param5');
});



//Dashboard User
Route::prefix('user')->namespace('User\Auth')->group(function(){
    Route::get('/anak', 'UserController@anakhome')->name('anak.home')->middleware('userAkses:0,user:anak');
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



//CRUD Data Posyandu
Route::get('/admin/posyandu/all', 'Admin\MasterData\DataPosyanduController@listPosyandu')->name("Data Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::get('/admin/posyandu/new', 'Admin\MasterData\DataPosyanduController@addPosyandu')->name("Add Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::post('/admin/posyandu/add', 'Admin\MasterData\DataPosyanduController@storePosyandu')->name("New Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::get('/admin/posyandu/detail/{posyandu}', 'Admin\MasterData\DataPosyanduController@detailPosyandu')->name("Detail Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::get('/admin/posyandu/edit/{posyandu}', 'Admin\MasterData\DataPosyanduController@editPosyandu')->name("Edit Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");
Route::post('/admin/posyandu/update/{posyandu}', 'Admin\MasterData\DataPosyanduController@updatePosyandu')->name("Update Posyandu")->middleware("cek:super admin,param2,param3,param4,param5");



//CRUD Profile Posyandu
Route::get('/admin/profile-posyandu/profile', 'Admin\MasterData\ProfilePosyanduController@profilePosyandu')->name("Profile Posyandu")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::get('/admin/profile-posyandu/edit/{posyandu}', 'Admin\MasterData\ProfilePosyanduController@editProfilePosyandu')->name("Edit Profile Posyandu")->middleware("cek:head admin,admin,param3,param4,param5");
Route::post('/admin/profile-posyandu/update/{posyandu}', 'Admin\MasterData\ProfilePosyanduController@updateProfilePosyandu')->name("Update Profile Posyandu")->middleware("cek:head admin,admin,param3,param4,param5");



//CRUD Data Admin
Route::get('/admin/data-admin/all', 'Admin\MasterData\DataAdminController@listAdmin')->name("Data Admin")->middleware("cek:super admin,head admin,admin,param4,param5");
Route::get('/get-img/data-admin/{id}', 'Admin\MasterData\DataAdminController@getImage')->name('Get Image Data Admin')->middleware("cek:super admin,head admin,admin,tenaga kesehatan,kader");
Route::get('/get-img/data-admin/ktp/{id}', 'Admin\MasterData\DataAdminController@getImageKTP')->name('Get Image Data Admin KTP')->middleware("cek:super admin,head admin,admin,tenaga kesehatan,kader");
Route::get('/admin/data-admin/detail/{pegawai}', 'Admin\MasterData\DataAdminController@detailAdmin')->name("Detail Admin")->middleware("cek:super admin,head admin,admin,param4,param5");
Route::post('/admin/data-admin/update/{pegawai}', 'Admin\MasterData\DataAdminController@updateAdmin')->name("Update Data Admin")->middleware("cek:super admin,head admin,param3,param4,param5");



//CRUD Data Kader
Route::get('/admin/data-kader/all', 'Admin\MasterData\DataKaderController@listKader')->name("Data Kader")->middleware("cek:super admin,head admin,admin,kader,tenaga kesehatan");
Route::get('/get-img/data-kader/{id}', 'Admin\MasterData\DataKaderController@getImage')->name('Get Image Data Kader')->middleware("cek:super admin,head admin,admin,tenaga kesehatan,kader");
Route::get('/get-img/data-kader/ktp/{id}', 'Admin\MasterData\DataKaderController@getImageKTP')->name('Get Image Data Kader KTP')->middleware("cek:super admin,head admin,admin,tenaga kesehatan,kader");
Route::get('/admin/data-kader/detail/{pegawai}', 'Admin\MasterData\DataKaderController@detailKader')->name("Detail Kader")->middleware("cek:super admin,head admin,admin,kader,tenaga kesehatan");
Route::post('/admin/data-kader/update/{pegawai}', 'Admin\MasterData\DataKaderController@updateKader')->name("Update Data Kader")->middleware("cek:super admin,head admin,admin,param4,param5");



//CRUD Data Anggota
Route::get('/admin/data-anggota/all', 'Admin\MasterData\DataAnggotaController@listAnggota')->name("Data Anggota")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::get('/get-img/data-anggota/{id}', 'Admin\MasterData\DataAnggotaController@getImage')->name('Get Image Data Anggota')->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::get('/get-img/data-anggota/kk/{id}', 'Admin\MasterData\DataAnggotaController@getImageKK')->name('Get Image Data Anggota KK')->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");

Route::get('/admin/data-anggota/detail/ibu/{ibu}', 'Admin\MasterData\DataAnggotaController@detailAnggotaIbu')->name("Detail Anggota Ibu")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::post('/admin/data-anggota/update/ibu/{ibu}', 'Admin\MasterData\DataAnggotaController@updateAnggotaIbu')->name("Update Anggota Ibu")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");

Route::get('/admin/data-anggota/detail/anak/{anak}', 'Admin\MasterData\DataAnggotaController@detailAnggotaAnak')->name("Detail Anggota Anak")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::post('/admin/data-anggota/update/anak/{anak}', 'Admin\MasterData\DataAnggotaController@updateAnggotaAnak')->name("Update Anggota Anak")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");

Route::get('/admin/data-anggota/detail/lansia/{lansia}', 'Admin\MasterData\DataAnggotaController@detailAnggotaLansia')->name("Detail Anggota Lansia")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::post('/admin/data-anggota/update/lansia/{lansia}', 'Admin\MasterData\DataAnggotaController@updateAnggotaLansia')->name("Update Anggota Lansia")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::post('/admin/data-anggota/pj/tambah/{lansia}', 'Admin\MasterData\DataAnggotaController@tambahPjLansia')->name("Tambah Pj Lansia")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");
Route::post('/admin/data-anggota/pj/update/{pjLansia}', 'Admin\MasterData\DataAnggotaController@updatePjLansia')->name("Update Pj Lansia")->middleware("cek:head admin,admin,kader,tenaga kesehatan,param5");



//Konsultasi
Route::get('nakes/konsultasi', 'Admin\KesehatanKeluarga\KonsultasiController@tambahKonsultasi')->name("Tambah Konsultasi")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::get('nakes/konsultasi/ibu/{ibu}', 'Admin\KesehatanKeluarga\KonsultasiController@konsultasiIbu')->name("Konsultasi Ibu")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::get('nakes/konsultasi/anak/{anak}', 'Admin\KesehatanKeluarga\KonsultasiController@konsultasiAnak')->name("Konsultasi Anak")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::get('nakes/konsultasi/lansia/{lansia}', 'Admin\KesehatanKeluarga\KonsultasiController@konsultasiLansia')->name("Konsultasi Lansia")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");

//Tambah Konsultasi
Route::get('/get-img/data-anggota/konsultasi/{id}', 'Admin\KesehatanKeluarga\KonsultasiController@getImage')->name('Get Image Anggota Konsultasi')->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::get('nakes/konsultasi-ibu/{ibu}', 'Admin\KesehatanKeluarga\KonsultasiController@storeKonsultasiIbu')->name("Tambah Konsultasi Ibu")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::get('nakes/konsultasi-anak/{anak}', 'Admin\KesehatanKeluarga\KonsultasiController@storeKonsultasiAnak')->name("Tambah Konsultasi Anak")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::get('nakes/konsultasi-lansia/{lansia}', 'Admin\KesehatanKeluarga\KonsultasiController@storeKonsultasiLansia')->name("Tambah Konsultasi Lansia")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");



//Pemeriksaan
Route::get('nakes/pemeriksaan', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahPemeriksaan')->name("Tambah Pemeriksaan")->middleware("cek:tenaga kesehatan,kader,param3,param4,param5");
Route::get('nakes/pemeriksaan/ibu/{ibu}', 'Admin\KesehatanKeluarga\PemeriksaanController@pemeriksaanIbu')->name("Pemeriksaan Ibu")->middleware("cek:tenaga kesehatan,kader,param3,param4,param5");
Route::get('nakes/pemeriksaan/anak/{anak}', 'Admin\KesehatanKeluarga\PemeriksaanController@pemeriksaanAnak')->name("Pemeriksaan Anak")->middleware("cek:tenaga kesehatan,kader,param3,param4,param5");
Route::get('nakes/pemeriksaan/lansia/{lansia}', 'Admin\KesehatanKeluarga\PemeriksaanController@pemeriksaanLansia')->name("Pemeriksaan Lansia")->middleware("cek:tenaga kesehatan,kader,param3,param4,param5");

//Tambah Data Kesehatan User Tambahan
Route::post('nakes/tambah-alergi/{user}', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahAlergi')->name("Tambah Alergi")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::post('nakes/pemeriksaan-user/penyakit-bawaan/{user}', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahPenyakitBawaan')->name("Tambah Penyakit Bawaan")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");

Route::post('nakes/pemeriksaan-anak/data-kelahiran/{anak}', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahKelahiranAnak')->name("Tambah Data Kelahiran Anak")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");

Route::post('nakes/pemeriksaan-ibu/data-kelahiran/{ibu}', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahPersalinanIbu')->name("Tambah Data Persalinan")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");

Route::post('nakes/pemeriksaan-lansia/riwayat_penyakit/{lansia}', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahRiwayatPenyakit')->name("Tambah Riwayat Penyakit")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");

//Tambah Pemeriksaan
Route::get('/get-img/data-anggota/pemeriksaan/{id}', 'Admin\KesehatanKeluarga\PemeriksaanController@getImage')->name('Get Image Anggota Pemeriksaan')->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::post('nakes/pemeriksaan-lansia/{lansia}', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahPemeriksaanLansia')->name("Tambah Pemeriksaan Lansia")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::post('nakes/pemeriksaan-anak/{anak}', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahPemeriksaanAnak')->name("Tambah Pemeriksaan Anak")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::post('nakes/pemeriksaan-ibu/{ibu}', 'Admin\KesehatanKeluarga\PemeriksaanController@tambahPemeriksaanIbu')->name("Tambah Pemeriksaan Ibu")->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");

//Pemberian Imunisasi
Route::post('nakes/pemeriksaan-anak/tambah-imunisasi/{anak}', 'Admin\KesehatanKeluarga\PemberianImunisasiController@imunisasiAnak')->name('Imunisasi Anak')->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::post('nakes/pemeriksaan-ibu/tambah-imunisasi/{ibu}', 'Admin\KesehatanKeluarga\PemberianImunisasiController@imunisasiIbu')->name('Imunisasi Ibu')->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::post('nakes/pemeriksaan-lansia/tambah-imunisasi/{lansia}', 'Admin\KesehatanKeluarga\PemberianImunisasiController@imunisasiLansia')->name('Imunisasi Lansia')->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");

//Pemberian Vitamin
Route::post('nakes/pemeriksaan-anak/tambah-vitamin/{anak}', 'Admin\KesehatanKeluarga\PemberianVitaminController@vitaminAnak')->name('Vitamin Anak')->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::post('nakes/pemeriksaan-ibu/tambah-vitamin/{ibu}', 'Admin\KesehatanKeluarga\PemberianVitaminController@vitaminIbu')->name('Vitamin Ibu')->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");
Route::post('nakes/pemeriksaan-lansia/tambah-vitamin/{lansia}', 'Admin\KesehatanKeluarga\PemberianVitaminController@vitaminLansia')->name('Vitamin Lansia')->middleware("cek:tenaga kesehatan,param2,param3,param4,param5");



//Data & Riwayat Kesehatan
Route::get('nakes/data-kesehatan', 'Admin\KesehatanKeluarga\DataRiwayatKesehatanController@dataKesehatan')->name("Data Kesehatan")->middleware("cek:param1,param2,admin,kader,tenaga kesehatan");
Route::get('nakes/data-kesehatan/kesehatan-ibu/{ibu}', 'Admin\KesehatanKeluarga\DataRiwayatKesehatanController@kesehatanIbu')->name("Data Kesehatan Ibu")->middleware("cek:param1,param2,admin,kader,tenaga kesehatan");
Route::get('nakes/data-kesehatan/kesehatan-anak/{anak}', 'Admin\KesehatanKeluarga\DataRiwayatKesehatanController@kesehatanAnak')->name("Data Kesehatan Anak")->middleware("cek:param1,param2,admin,kader,tenaga kesehatan");
Route::get('nakes/data-kesehatan/kesehatan-lansia/{lansia}', 'Admin\KesehatanKeluarga\DataRiwayatKesehatanController@kesehatanLansia')->name("Data Kesehatan Lansia")->middleware("cek:param1,param2,admin,kader,tenaga kesehatan");



//Imunisasi
Route::get('nakes/imunisasi/tambah-imunisasi', 'Admin\ImunisasiVitamin\ImunisasiController@tambahImunisasi')->name("Tambah Imunisasi")->middleware("cek:super admin,param2,param3,param4,param5");
Route::post('nakes/imunisasi/tambah', 'Admin\ImunisasiVitamin\ImunisasiController@storeImunisasi')->name("Store Imunisasi")->middleware("cek:super admin,param2,param3,param4,param5");
Route::get('nakes/imunisasi/jenis-imunisasi', 'Admin\ImunisasiVitamin\ImunisasiController@jenisImunisasi')->name("Jenis Imunisasi")->middleware("cek:super admin,head admin,admin,kader,tenaga kesehatan");
Route::get('nakes/imunisasi/detail/{imunisasi}', 'Admin\ImunisasiVitamin\ImunisasiController@detailImunisasi')->name("Detail Imunisasi")->middleware("cek:super admin,head admin,admin,kader,tenaga kesehatan");
Route::post('nakes/imunisasi/update/{imunisasi}', 'Admin\ImunisasiVitamin\ImunisasiController@updateImunisasi')->name("Update Imunisasi")->middleware("cek:super admin,param2,param3,param4,param5");



//Vitamin
Route::get('nakes/vitamin/tambah-vitamin', 'Admin\ImunisasiVitamin\VitaminController@tambahVitamin')->name("Tambah Vitamin")->middleware("cek:super admin,param2,param3,param4,param5");
Route::post('nakes/vitamin/tambah', 'Admin\ImunisasiVitamin\VitaminController@storeVitamin')->name("Store Vitamin")->middleware("cek:super admin,param2,param3,param4,param5");
Route::get('nakes/vitamin/jenis-vitamin', 'Admin\ImunisasiVitamin\VitaminController@jenisVitamin')->name("Jenis Vitamin")->middleware("cek:super admin,head admin,admin,kader,tenaga kesehatan");
Route::get('nakes/vitamin/detail-vitamin/{vitamin}', 'Admin\ImunisasiVitamin\VitaminController@detailVitamin')->name("Detail Vitamin")->middleware("cek:super admin,head admin,admin,kader,tenaga kesehatan");
Route::post('nakes/vitamin/update/{vitamin}', 'Admin\ImunisasiVitamin\VitaminController@updateVitamin')->name("Update Vitamin")->middleware("cek:super admin,param2,param3,param4,param5");

//Laporan
Route::prefix('admin')->middleware("cek:super admin,head admin,admin,kader,tenaga kesehatan")->namespace('Admin\Laporan')->group(function() {

    Route::get('/laporan/kegiatan' , 'LaporanController@laporankegiatan')->name('laporan.kegiatan');
    Route::get('/laporan/bulanan' , 'LaporanController@laporanbulanan')->name('laporan.bulanan');
    Route::get('/laporan/tahunan' , 'LaporanController@laporantahunan')->name('laporan.tahunan');

    // Ajax Laporan
    Route::prefix('ajax')->group( function () {
      Route::post('/laporan/kegiatan' , 'LaporanController@ajaxchartkegiatan');
      Route::post('/laporan/bulanan' , 'LaporanController@ajaxchartbulanan');
      Route::post('/laporan/tahunan' , 'LaporanController@ajaxcharttahunan');
      Route::get('/posyandu' , 'LaporanController@ajaxposyandu');
      Route::get('/filter/{type}' , 'LaporanController@ajaxfilter');
      Route::get('/filter/l/{type}' , 'LaporanController@filter');
    });

  });

  // File Update ----
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
  // ------

//Informasi Penting
Route::get('/admin/informasi-penting/home', 'InformasiPentingController@index')->name('informasi_penting.home')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::get('/admin/informasi-penting/create', 'InformasiPentingController@create')->name('informasi_penting.create')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::post('/admin/informasi-penting/store', 'InformasiPentingController@store')->name('informasi_penting.store')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::get('/admin/informasi-penting/show/{id}', 'InformasiPentingController@show')->name('informasi_penting.show')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::post('/admin/informasi-penting/update/{id}', 'InformasiPentingController@update')->name('informasi_penting.update')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::get('/admin/informasi-penting/get-img/{id}', 'InformasiPentingController@getImage')->name('informasi_penting.get_img');
Route::post('/admin/informasi-penting/delete', 'InformasiPentingController@delete')->name('informasi_penting.delete')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");

//SIG Posyandu
Route::get('/admin/informasi/persebaran-posyandu/home', 'SIGPosyanduController@index')->name('sig-posyandu.home')->middleware('auth:admin');
Route::get('/admin/informasi/sig-posyandu/polos', 'SIGPosyanduController@sigPolosan')->name('sig-posyandu.polos');
Route::get('/admin/informasi/persebaran-posyandu/get-data', 'SIGPosyanduController@getData')->name('sig-posyandu.get_data')->middleware('auth:admin');
Route::get('/api/kk/show-file/{no_kk}', 'User\Auth\RegisController@showKKFile')->name('kk.show_file');



//Penyuluhan
Route::get('/admin/penyuluhan/home', 'PenyuluhanController@index')->name('penyuluhan.home')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::get('/admin/penyuluhan/create', 'PenyuluhanController@create')->name('penyuluhan.create')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::post('/admin/penyuluhan/store', 'PenyuluhanController@store')->name('penyuluhan.store')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::get('/admin/penyuluhan/show/{id}', 'PenyuluhanController@show')->name('penyuluhan.show')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::post('/admin/penyuluhan/update/{id}', 'PenyuluhanController@update')->name('penyuluhan.update')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");
Route::get('/admin/penyuluhan/get-img/{id}', 'PenyuluhanController@getImage')->name('penyuluhan.get_img');
Route::post('/admin/penyuluhan/delete', 'PenyuluhanController@delete')->name('penyuluhan.delete')->middleware('auth:admin')->middleware("cek:super admin,head admin,admin,kader,param5");



//Pengumuman
Route::get('/admin/pengumuman/home', 'PengumumanController@index')->name('pengumuman.home')->middleware(['auth:admin','cek:param1,head admin,admin,kader,param5']);
Route::get('/admin/pengumuman/create', 'PengumumanController@create')->name('pengumuman.create')->middleware('auth:admin')->middleware("cek:supparam1,head admin,admin,kader,param5");
Route::post('/admin/pengumuman/store', 'PengumumanController@store')->name('pengumuman.store')->middleware('auth:admin')->middleware("cek:supparam1,head admin,admin,kader,param5");
Route::get('/admin/pengumuman/show/{id}', 'PengumumanController@show')->name('pengumuman.show')->middleware('auth:admin')->middleware("cek:param1,head admin,admin,kader,param5");
Route::post('/admin/pengumuman/update/{id}', 'PengumumanController@update')->name('pengumuman.update')->middleware(['auth:admin','cek:param1,head admin,admin,kader,param5']);
Route::post('/admin/pengumuman/delete', 'PengumumanController@delete')->name('pengumuman.delete')->middleware('auth:admin')->middleware("cek:supparam1,head admin,admin,kader,param5");
Route::get('/admin/pengumuman/get-img/{id}', 'PengumumanController@getImage')->name('pengumuman.get_img');

//Kegiatan
Route::get('/admin/kegiatan/home', 'KegiatanController@index')->name('kegiatan.home')->middleware("cek:param1,head admin,admin,kader,param5");
Route::get('/admin/kegiatan/create', 'KegiatanController@create')->name('kegiatan.create')->middleware("cek:param1,head admin,admin,kader,param5");
Route::post('/admin/kegiatan/store', 'KegiatanController@store')->name('kegiatan.store')->middleware("cek:param1,head admin,admin,kader,param5");
Route::get('/admin/kegiatan/show/{id}', 'KegiatanController@show')->name('kegiatan.show')->middleware("cek:param1,head admin,admin,kader,param5");
Route::post('/admin/kegiatan/update/{id}', 'KegiatanController@update')->name('kegiatan.update')->middleware("cek:param1,head admin,admin,kader,param5");
Route::post('/admin/kegiatan/delete', 'KegiatanController@delete')->name('kegiatan.delete')->middleware("cek:param1,head admin,admin,kader,param5");
Route::get('/admin/kegiatan/broadcast/{id}', 'KegiatanController@broadcast')->name('kegiatan.broadcast')->middleware("cek:param1,head admin,admin,kader,param5");

//Riwayat Kegiatan
Route::get('/admin/riwayat-kegiatan/home', 'RiwayatKegiatanController@index')->name('riwayat_kegiatan.home');
Route::get('/admin/riwayat-kegiatan/home/{id}', 'RiwayatKegiatanController@show')->name('riwayat_kegiatan.show');
Route::get('/admin/riwayat-kegiatan/dokumentasi-kegiatan/create/{id}', 'RiwayatKegiatanController@createDokumentasi')->name('dokumentasi.create');
Route::get('/admin/riwayat-kegiatan/dokumentasi-kegiatan/show/{id}', 'RiwayatKegiatanController@showDokumentasi')->name('dokumentasi.show');
Route::post('/admin/riwayat-kegiatan/dokumentasi-kegiatan/store', 'RiwayatKegiatanController@storeDokumentasi')->name('dokumentasi.store');
Route::post('/admin/riwayat-kegiatan/dokumentasi-kegiatan/update/{id}', 'RiwayatKegiatanController@updateDokumentasi')->name('dokumentasi.update');
Route::post('/admin/riwayat-kegiatan/dokumentasi-kegiatan/delete', 'RiwayatKegiatanController@deleteDokumentasi')->name('dokumentasi.delete');
Route::get('/admin/riwayat-kegiatan/dokumentasi-kegiatan/get-img/{id}', 'RiwayatKegiatanController@showImgDokumentasi')->name('dokumentasi.get_img');

//Command Bot
Route::get('/admin/command-bot/pertanyaan-konsultasi/home', 'BotCommandController@index')->name('pertanyaan-konsultasi.home');
Route::get('/admin/command-bot/pertanyaan-konsultasi/create', 'BotCommandController@create')->name('pertanyaan-konsultasi.create');
Route::post('/admin/command-bot/pertanyaan-konsultasi/store', 'BotCommandController@store')->name('pertanyaan-konsultasi.store');
Route::get('/admin/command-bot/pertanyaan-konsultasi/show/{id}', 'BotCommandController@show')->name('pertanyaan-konsultasi.show');
Route::get('/admin/command-bot/pertanyaan-konsultasi/kosongkan/{id}', 'BotCommandController@kosongkanParent')->name('pertanyaan-konsultasi.kosongkan');
Route::post('/admin/command-bot/pertanyaan-konsultasi/update/{id}', 'BotCommandController@update')->name('pertanyaan-konsultasi.update');
Route::post('/admin/command-bot/pertanyaan-konsultasi/add-parent', 'BotCommandController@addParent')->name('pertanyaan-konsultasi.add-parent');
Route::post('/admin/command-bot/pertanyaan-konsultasi/delete', 'BotCommandController@delete')->name('pertanyaan-konsultasi.delete');

// Ajax Dependent Select
Route::get('/kecamatan/{id}', 'AjaxSearchLocation@kecamatan');
Route::get('/desa/{id}', 'AjaxSearchLocation@desa');
Route::get('/banjar/{id}', 'AjaxSearchLocation@banjar');

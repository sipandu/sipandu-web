<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Ibu;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/test', function (Request $request){
    return response()->json(Ibu::all());
});

Route::prefix('mobileuser')->group(function(){
    // auth
    Route::post('/Login', 'User\Auth\Api\ApiLoginController@login');
    Route::get('/Logout', 'User\Auth\Api\ApiLoginController@logout')->middleware('auth:sanctum');
    Route::post('/register', 'User\Auth\Api\ApiRegisterController@firstRegis');
    Route::post('/register-anak', 'User\Auth\Api\ApiRegisterController@storeAnak');
    Route::post('/register-ibu', 'User\Auth\Api\ApiRegisterController@storeIbu');
    Route::post('/register-lansia', 'User\Auth\Api\ApiRegisterController@storeLansia');

    // regist tahap 2 stuff
    Route::get('/regist-data-posyandu', 'User\Auth\Api\ApiRegisterController@getAllPosyandu');
    Route::post('/register-data-anak', 'User\Auth\Api\ApiRegisterDataDiriController@storeDataAnak');
    Route::post('/register-data-ibu', 'User\Auth\Api\ApiRegisterDataDiriController@storeDataIbu');
    Route::post('/register-data-lansia', 'User\Auth\Api\ApiRegisterDataDiriController@storeDataLansia');

    // posyandu data stuff
    Route::get('/get-posyandu', 'User\Auth\Api\GetData@dataPosyandu')->middleware('auth:sanctum');
    Route::post('/get-posyandu-bolong', 'User\Auth\Api\ApiPosyanduDataController@getPosyandu');
    Route::post('/get-posyandu-kegiatan', 'User\Auth\Api\ApiPosyanduDataController@getPosyanduKegiatan');
    Route::post('/get-posyandu-nakes', 'User\Auth\Api\ApiPosyanduDataController@getTenagaKesehatanPosyandu');
    Route::post('/get-posyandu-pengumuman', 'User\Auth\Api\ApiPosyanduDataController@getPengumuman');

    //user data stuff
    Route::post('/user/get-user-anak', 'User\Auth\Api\ApiUserDataController@getUserAnak');
    Route::post('/user/get-user-ibu', 'User\Auth\Api\ApiUserDataController@getUserIbu');
    Route::post('/user/get-user-lansia', 'User\Auth\Api\ApiUserDataController@getUserLansia');

    // informasi stuff
    Route::get('/get-informasi-home', 'User\Auth\Api\ApiInformasiController@getInformasiHome');
    Route::post('/get-informasi', 'User\Auth\Api\ApiInformasiController@getInformasi');
    Route::post('/get-image', 'User\Auth\Api\ApiInformasiController@getImage');


    // other
    Route::get('/get-loginbg-video', 'User\Auth\Api\ApiLoginController@videoBg');
});




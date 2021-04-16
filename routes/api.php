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
    Route::post('/Login', 'User\Auth\Api\ApiLoginController@login');
    Route::get('/Logout', 'User\Auth\Api\ApiLoginController@logout')->middleware('auth:sanctum');
    Route::post('/register', 'User\Auth\Api\ApiRegisterController@firstRegis');
    Route::post('/register-anak', 'User\Auth\Api\ApiRegisterController@storeAnak');
    Route::post('/register-ibu', 'User\Auth\Api\ApiRegisterController@storeIbu');
    Route::post('/register-lansia', 'User\Auth\Api\ApiRegisterController@storeLansia');

    Route::get('/get-posyandu', 'User\Auth\Api\GetData@dataPosyandu')->middleware('auth:sanctum');
    Route::post('/get-posyandu-bolong', 'User\Auth\Api\ApiUserDataController@getPosyandu');

    Route::get('/get-loginbg-video', 'User\Auth\Api\ApiLoginController@videoBg');

    Route::post('/user/get-user-anak', 'User\Auth\Api\ApiUserDataController@getUserAnak');
    Route::post('/user/get-user-ibu', 'User\Auth\Api\ApiUserDataController@getUserIbu');
    Route::post('/user/get-user-lansia', 'User\Auth\Api\ApiUserDataController@getUserLansia');

    Route::get('/regist-data-posyandu', 'User\Auth\Api\ApiRegisterController@getAllPosyandu');
    Route::post('/register-data-anak', 'User\Auth\Api\ApiRegisterDataDiriController@storeDataAnak');
    Route::post('/register-data-ibu', 'User\Auth\Api\ApiRegisterDataDiriController@storeDataIbu');
    Route::post('/register-data-lansia', 'User\Auth\Api\ApiRegisterDataDiriController@storeDataLansia');

    Route::get('/get-informasi-home', 'User\Auth\Api\ApiBlogController@getInformasiHome');
    Route::post('/get-image', 'User\Auth\Api\ApiBlogController@getImage');
});




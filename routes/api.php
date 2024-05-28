<?php

use App\Http\Controllers\AbsenApiController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ApiController::class)->group(function(){
    Route::get('/tracert-study/{sekolah}/{id}/{tanggal_lahir}/json', 'getDataTracertStudy')
            ->middleware('auth:sanctum')->name('api.getDataTracertStudy');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/absen/get', [AbsenApiController::class, 'absenGet'])
    ->middleware('auth:sanctum')->name('api.absenGet');
});

Route::post('/absen/post', [AbsenApiController::class, 'post'])->name('api.post')->middleware('auth:sanctum');

Route::post('/user/login', [AuthTokenController::class, 'loginUser']);

//abvsde-4342198493-00a7
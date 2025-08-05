<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\AssetController;
use App\Http\Controllers\API\JadwalController;
use App\Http\Controllers\API\StatusController;

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


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/products/search/{title}', [ProductController::class, 'search']);
});
Route::apiResource('products', ProductController::class)->middleware('auth:api');
Route::get('menus/all', [MenuController::class, 'all'])->middleware('auth:api');
Route::get('menus/category/{cat}', [MenuController::class, 'category'])->middleware('auth:api');
Route::get('menus/search/{title}', [MenuController::class, 'search'])->middleware('auth:api');
Route::apiResource('menus', MenuController::class)->middleware('auth:api');


Route::get('assets/search/{title}', [AssetController::class, 'search'])->middleware('auth:api');
Route::get('assets/detail/{code}', [AssetController::class, 'detail'])->middleware('auth:api');
Route::apiResource('assets', AssetController::class)->middleware('auth:api');

Route::get('jadwal/search/{title}', [JadwalController::class, 'search'])->middleware('auth:api');
Route::apiResource('jadwal', JadwalController::class)->middleware('auth:api');

Route::get('status/search/{title}', [StatusController::class, 'search'])->middleware('auth:api');
Route::apiResource('status', StatusController::class)->middleware('auth:api');

Route::post('profile/update', [AuthController::class, 'profileupdate'])->middleware('auth:api');
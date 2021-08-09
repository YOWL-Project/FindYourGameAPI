<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;

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

Route::post("visit", [DashboardController::class, 'add_visit']);



Route::post("register",[PassportAuthController::class,'register']);

Route::post("login",[PassportAuthController::class,'login']);

Route::post("logout", [PassportAuthController::class,'logout']);

Route::get("tests",[TestController::class,'listTests']);

Route::get("topics/votes/count", [DashboardController::class,'count_vote_topic']);
 
Route::post("test",[TestController::class,'addTest'])->middleware('auth:api');

//route dasboard
Route::get("conversion", [DasboardController::class, 'conversion']);

Route::group(['prefix' => 'count'], function () {
    Route::get("/visits/{duration}", [DasboardController::class, 'count_visit']);
    Route::get("/inscriptions/{duration}", [DasboardController::class, 'count_inscription']);
    // Route::get("/comments/{duration}", [DasboardController::class, 'count_inscription']);
    // Route::get("/games", [DasboardController::class, 'count_inscription']);
});


// routes users
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{page}/{limit}', [UserController::class, 'index']);
    // Route::get('create', [UserController::class, 'create']);
    // Route::post('/', [UserController::class, 'store']);
    Route::get('{id}', [UserController::class, 'show']);
    // Route::get('{id}/edit', [UserController::class, 'edit']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});
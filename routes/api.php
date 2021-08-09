<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CommentController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\VoteTopicController;
use App\Http\Controllers\VotePostController;

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

Route::post("register",[PassportAuthController::class,'register']);

Route::post("login",[PassportAuthController::class,'login']);

Route::post("logout", [PassportAuthController::class,'logout']);

Route::get("tests",[TestController::class,'listTests']);
 
Route::post("test",[TestController::class,'addTest'])->middleware('auth:api');

Route::group(['prefix' => 'comments'], function () {
    Route::get('/', [CommentController::class, 'index']);
    Route::get('{id}', [CommentController::class, 'show']);
    Route::delete('{id}', [CommentController::class, 'destroy']);
    Route::post('/', [CommentController::class, 'store']);
    Route::put('{id}', [CommentController::class, 'update']);
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

// routes topics
Route::group(['prefix' => 'topics'], function () {
    Route::get('/', [TopicController::class, 'index']);
    Route::get('/{page}/{limit}', [TopicController::class, 'index']);
    // Route::get('create', [UserController::class, 'create']);
    Route::post('/', [TopicController::class, 'store']);
    Route::get('{id}', [TopicController::class, 'show']);
    // Route::get('{id}/edit', [UserController::class, 'edit']);
    Route::put('{id}', [TopicController::class, 'update']);
    Route::delete('{id}', [TopicController::class, 'destroy']);
});

// routes votestopics
Route::group(['prefix' => 'votestopics'], function () {
    Route::get('/', [VoteTopicController::class, 'index']);
    Route::get('/{page}/{limit}', [VoteTopicController::class, 'index']);
    // Route::get('create', [VoteTopicController::class, 'create']);
    Route::post('/', [VoteTopicController::class, 'store']);
    Route::get('{id}', [VoteTopicController::class, 'show']);
    // Route::get('{id}/edit', [VoteTopicController::class, 'edit']);
    // Route::put('{id}', [VoteTopicController::class, 'update']);
    Route::delete('{id}', [VoteTopicController::class, 'destroy']);
});

// routes votesposts
Route::group(['prefix' => 'votesposts'], function () {
    Route::get('/', [VotePostController::class, 'index']);
    Route::get('/{page}/{limit}', [VotePostController::class, 'index']);
    // Route::get('create', [VoteTopicController::class, 'create']);
    Route::post('/', [VotePostController::class, 'store']);
    Route::get('{id}', [VotePostController::class, 'show']);
    // Route::get('{id}/edit', [VoteTopicController::class, 'edit']);
    // Route::put('{id}', [VoteTopicController::class, 'update']);
    Route::delete('{id}', [VotePostController::class, 'destroy']);
});
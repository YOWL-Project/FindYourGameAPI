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
use App\Http\Controllers\VoteCommentController;
use App\Http\Controllers\UserTopicSavedController;
use App\Http\Controllers\UserPostSavedController;

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
    Route::get('{id}', [UserController::class, 'show']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'destroy']);
});

// routes topics
Route::group(['prefix' => 'topics'], function () {
    Route::get('/', [TopicController::class, 'index']);
    Route::get('/{page}/{limit}', [TopicController::class, 'index']);
    Route::post('/', [TopicController::class, 'store']);
    Route::get('{id}', [TopicController::class, 'show']);
    Route::put('{id}', [TopicController::class, 'update']);
    Route::delete('{id}', [TopicController::class, 'destroy']);
});

// routes votestopics
Route::group(['prefix' => 'votestopics'], function () {
    Route::get('/', [VoteTopicController::class, 'index']);
    Route::get('/{page}/{limit}', [VoteTopicController::class, 'index']);
    Route::post('/', [VoteTopicController::class, 'store']);
    Route::get('{id}', [VoteTopicController::class, 'show']);
    Route::delete('{id}', [VoteTopicController::class, 'destroy']);
});

// routes votesgames
Route::group(['prefix' => 'votesgames'], function () {
    Route::get('/', [VotePostController::class, 'index']);
    Route::get('/{page}/{limit}', [VotePostController::class, 'index']);
    Route::post('/', [VotePostController::class, 'store']);
    Route::get('{id}', [VotePostController::class, 'show']);
    Route::delete('{id}', [VotePostController::class, 'destroy']);
});

// routes votescomments
Route::group(['prefix' => 'votescomments'], function () {
    Route::get('/', [VoteCommentController::class, 'index']);
    Route::get('/{page}/{limit}', [VoteCommentController::class, 'index']);
    Route::post('/', [VoteCommentController::class, 'store']);
    Route::get('{id}', [VoteCommentController::class, 'show']);
    Route::delete('{id}', [VoteCommentController::class, 'destroy']);
});


// routes usertopicssaved
Route::group(['prefix' => 'topicssaved'], function () {
    Route::get('/', [UserTopicSavedController::class, 'index']);
    Route::get('/{page}/{limit}', [UserTopicSavedController::class, 'index']);
    Route::post('/', [UserTopicSavedController::class, 'store']);
    Route::get('{id}', [UserTopicSavedController::class, 'show']);
    Route::delete('{id}', [UserTopicSavedController::class, 'destroy']);
});

// routes usergamessaved
Route::group(['prefix' => 'gamessaved'], function () {
    Route::get('/', [UserPostSavedController::class, 'index']);
    Route::get('/{page}/{limit}', [UserPostSavedController::class, 'index']);
    Route::post('/', [UserPostSavedController::class, 'store']);
    Route::get('{id}', [UserPostSavedController::class, 'show']);
    Route::delete('{id}', [UserPostSavedController::class, 'destroy']);
});
<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
// use App\Http\Controllers\TestController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
// use App\Http\Controllers\VoteTopicController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("register", [PassportAuthController::class, 'register']);

Route::post("login", [PassportAuthController::class, 'login']);

//route comments
Route::get('comments', [CommentController::class, 'index']);
Route::get('comments/{id}', [CommentController::class, 'show']);

// routes topics
Route::group(['prefix' => 'topics'], function () {
    Route::get('/', [TopicController::class, 'index']);
    Route::get('/{page}/{limit}', [TopicController::class, 'index']);
    Route::get('{id}', [TopicController::class, 'show']);
});

// routes votesgames
Route::group(['prefix' => 'votesgames'], function () {
    Route::get('/', [VotePostController::class, 'index']);
    Route::get('/{page}/{limit}', [VotePostController::class, 'index']);
    Route::get('{id}', [VotePostController::class, 'show']);
});

// routes votescomments
Route::group(['prefix' => 'votescomments'], function () {
    Route::get('/', [VoteCommentController::class, 'index']);
    Route::get('/{page}/{limit}', [VoteCommentController::class, 'index']);
    Route::get('{id}', [VoteCommentController::class, 'show']);
});

// routes usertopicssaved
Route::group(['prefix' => 'topicssaved'], function () {
    Route::get('/', [UserTopicSavedController::class, 'index']);
    Route::get('/{page}/{limit}', [UserTopicSavedController::class, 'index']);
    Route::get('{id}', [UserTopicSavedController::class, 'show']);
});

// routes usergamessaved
Route::group(['prefix' => 'gamessaved'], function () {
    Route::get('/', [UserPostSavedController::class, 'index']);
    Route::get('/getgamessaved/{user_id}', [UserPostSavedController::class, 'getgamessaved']);
    Route::get('/{page}/{limit}', [UserPostSavedController::class, 'index']);
    Route::get('{id}', [UserPostSavedController::class, 'show']);
});

//route add visit
Route::post("visit", [DashboardController::class, 'add_visit']);

//route authenticate
Route::group(['middleware' => 'auth:api'], function () {

    Route::post("logout", [PassportAuthController::class, 'logout']);

    //route comments
    Route::group(['prefix' => 'comments'], function () {
        Route::delete('{id}', [CommentController::class, 'destroy']);
        Route::post('/', [CommentController::class, 'store']);
        Route::put('{id}', [CommentController::class, 'update']);
    });

    // routes topics
    Route::group(['prefix' => 'topics'], function () {
        Route::post('/', [TopicController::class, 'store']);
        Route::put('{id}', [TopicController::class, 'update']);
        Route::delete('{id}', [TopicController::class, 'destroy']);
    });

    // routes votesgames
    Route::group(['prefix' => 'votesgames'], function () {
        Route::post('/', [VotePostController::class, 'store']);
        Route::delete('{id}', [VotePostController::class, 'destroy']);
        Route::put('{id}', [VotePostController::class, 'update']);
    });

    // routes votescomments
    Route::group(['prefix' => 'votescomments'], function () {
        Route::post('/', [VoteCommentController::class, 'store']);
        Route::delete('{id}', [VoteCommentController::class, 'destroy']);
    });


    // routes usertopicssaved
    Route::group(['prefix' => 'topicssaved'], function () {
        Route::post('/', [UserTopicSavedController::class, 'store']);
        Route::delete('{id}', [UserTopicSavedController::class, 'destroy']);
    });

    // routes usergamessaved
    Route::group(['prefix' => 'gamessaved'], function () {
        Route::post('/', [UserPostSavedController::class, 'store']);
        Route::delete('{id}', [UserPostSavedController::class, 'destroy']);
    });

    Route::group(['middleware' => 'isadmin'], function () {

        // routes users
        Route::group(['prefix' => 'users'], function () {
            Route::get('users/{id}', [UserController::class, 'show']);
            Route::get('/', [UserController::class, 'index']);
            Route::get('/{page}/{limit}', [UserController::class, 'index']);
            Route::put('{id}', [UserController::class, 'update']);
            Route::delete('{id}', [UserController::class, 'destroy']);
        });

        //route dashboard
        Route::get("conversion", [DashboardController::class, 'conversion']);
        Route::group(['prefix' => 'count'], function () {
            Route::get("/visits/{duration}", [DashboardController::class, 'count_visits']);
            Route::get("/inscriptions/{duration}", [DashboardController::class, 'count_inscriptions']);
            Route::get("/comments/{duration}", [DashboardController::class, 'count_comments']);
            Route::get("/games/{number}", [DashboardController::class, 'count_games_popularity']);
            Route::get("/comments/popularity/{number}", [DashboardController::class, 'count_comments_popularity']);
            Route::get("/topics/{number}", [DashboardController::class, 'count_topics_popularity']);
        });
    });
});


// routes votestopics
// Route::group(['prefix' => 'votestopics'], function () {
//     Route::get('/', [VoteTopicController::class, 'index']);
//     Route::get('/{page}/{limit}', [VoteTopicController::class, 'index']);
//     Route::post('/', [VoteTopicController::class, 'store']);
//     Route::get('{id}', [VoteTopicController::class, 'show']);
//     Route::delete('{id}', [VoteTopicController::class, 'destroy']);
// });

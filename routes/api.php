<?php

use Illuminate\Support\Facades\Route;
use DvojkaT\Forumkit\Http\Controllers\ThreadCategoryController;
use DvojkaT\Forumkit\Http\Controllers\ThreadCommentaryController;
use DvojkaT\Forumkit\Http\Controllers\ThreadController;
use DvojkaT\Forumkit\Http\Controllers\ThreadLikeController;

Route::group(['prefix' => 'v1', 'middleware' => 'api'],function () {
    Route::get('/threads/categories/{category_id}', [ThreadController::class, 'index']);
    Route::apiResource('/threads', ThreadController::class)->only(['show']);
    Route::get('commentaries/{id}', [ThreadCommentaryController::class, 'show']);
    Route::get('/categories', [ThreadCategoryController::class, 'getCategories']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::apiResource('/threads', ThreadController::class)->only(['store', 'update', 'destroy']);
        Route::post('/commentaries/thread', [ThreadCommentaryController::class, 'storeForThread']);
        Route::post('/commentaries/commentary', [ThreadCommentaryController::class, 'storeForCommentary']);
        Route::post('/likes/thread/{thread_id}', [ThreadLikeController::class, 'setLikeToThread']);
        Route::post('/likes/commentaries/{commentary_id}', [ThreadLikeController::class, 'setLikeToCommentary']);
        Route::delete('/likes/thread/{thread_id}', [ThreadLikeController::class, 'unsetThreadLike']);
        Route::delete('/likes/commentaries/{thread_id}', [ThreadLikeController::class, 'unsetCommentaryLike']);
    });
});

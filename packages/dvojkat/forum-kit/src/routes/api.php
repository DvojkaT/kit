<?php

use DvojkaT\Forumkit\Http\Controllers\ThreadCategoryController;
use Dvojkat\Forumkit\Http\Controllers\ThreadCommentaryController;
use DvojkaT\Forumkit\Http\Controllers\ThreadController;
use DvojkaT\Forumkit\Http\Controllers\ThreadLikeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1', 'middleware' => 'api'],function () {
        Route::get('/threads/categories/{category_id}', [ThreadController::class, 'index']);
        Route::apiResource('/threads', ThreadController::class)->only(['show', 'store', 'update', 'destroy']);

        Route::post('/commentaries/thread', [ThreadCommentaryController::class, 'storeForThread']);
        Route::post('/commentaries/commentary', [ThreadCommentaryController::class, 'storeForCommentary']);

        Route::post('/likes/thread/{thread_id}', [ThreadLikeController::class, 'setLikeToThread']);
        Route::post('/likes/commentaries/{commentary_id}', [ThreadLikeController::class, 'setLikeToCommentary']);

        Route::delete('/likes/thread/{thread_id}', [ThreadLikeController::class, 'unsetThreadLike']);
        Route::delete('/likes/commentaries/{thread_id}', [ThreadLikeController::class, 'unsetCommentaryLike']);

        Route::get('commentaries/{id}', [ThreadCommentaryController::class, 'show']);
    Route::get('/categories', [ThreadCategoryController::class, 'getCategories']);
});

<?php

use DvojkaT\Forumkit\Http\Controllers\ThreadCategoryController;
use Dvojkat\Forumkit\Http\Controllers\ThreadCommentaryController;
use DvojkaT\Forumkit\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1', 'middleware' => 'api'],function () {
        Route::get('/threads/categories/{category_id}', [ThreadController::class, 'index']);
        Route::apiResource('/threads', ThreadController::class)->only(['show', 'store', 'update', 'destroy']);

        Route::post('/commentaries/thread', [ThreadCommentaryController::class, 'storeForThread']);
        Route::post('/commentaries/commentary', [ThreadCommentaryController::class, 'storeForCommentary']);

        Route::get('commentaries/{id}', [ThreadCommentaryController::class, 'show']);
    Route::get('/categories', [ThreadCategoryController::class, 'getCategories']);
});

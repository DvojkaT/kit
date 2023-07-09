<?php

use DvojkaT\Forumkit\Http\Controllers\ThreadCategoryController;
use DvojkaT\Forumkit\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1', 'middleware' => 'api'],function () {
        Route::get('/threads/categories/{category_id}', [ThreadController::class, 'index']);
        Route::apiResource('/threads', ThreadController::class)->only(['show', 'store', 'update', 'destroy']);
    Route::get('/categories', [ThreadCategoryController::class, 'getCategories']);
});

<?php

use DvojkaT\Forumkit\Http\Controllers\ThreadController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v1/thread'],function () {
   Route::get('/', [ThreadController::class, 'getThreads']);
});

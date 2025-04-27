<?php

use Src\Application\Controller\User\GetUserController;
use Illuminate\Support\Facades\Route;

Route::name('api.')->prefix('api')->group(function () {
    Route::get('/users/{id}', GetUserController::class);
});
<?php

use Src\Application\Controller\User\GetUserController;
use Src\Application\Controller\User\GetUsersController;
use Illuminate\Support\Facades\Route;

# User
Route::get('/users/{id}', GetUserController::class);
Route::get('/users', GetUsersController::class);

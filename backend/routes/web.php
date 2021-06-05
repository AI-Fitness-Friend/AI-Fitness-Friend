<?php

use Simple\Routing\Route;
use App\Middlewares\AuthMiddleware;

// get
Route::add('get', '/', '\App\Controllers\IndexController::workout', [AuthMiddleware::class]);
Route::add('get', '/workout', '\App\Controllers\IndexController::workout', [AuthMiddleware::class]);
Route::add('get', '/record', '\App\Controllers\IndexController::record', [AuthMiddleware::class]);
Route::add('get', '/setting', '\App\Controllers\IndexController::setting', [AuthMiddleware::class]);
Route::add('get', '/contact', '\App\Controllers\IndexController::contact', [AuthMiddleware::class]);

Route::add('get', '/workout/{routine_id}', '\App\Controllers\WorkoutController::routine', [AuthMiddleware::class]);
Route::add('get', '/workout/{routine_id}/{movement_id}', '\App\Controllers\WorkoutController::movement', [AuthMiddleware::class]);

Route::add('get', '/google/login', '\App\Controllers\AuthController::login');
Route::add('get', '/google/logout', '\App\Controllers\AuthController::logout');


// post
Route::add('post', '/setting', '\App\Controllers\IndexController::changeSetting', [AuthMiddleware::class]);
Route::add('post', '/workout/{routine_id}/{movement_id}', '\App\Controllers\WorkoutController::recordMovement', [AuthMiddleware::class]);
Route::add('post', '/contact', '\App\Controllers\IndexController::postContact', [AuthMiddleware::class]);


<?php

namespace App\Providers;

use Simple\Support\ServiceProvider;
use Simple\Routing\Route;

class RouteServiceProvider extends ServiceProvider
{
    public static function register() {
        require_once dirname(__DIR__, 2) . '/routes/webpage.php';
    }
    
    public static function boot() {
        Route::run();
    }
}
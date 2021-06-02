<?php

namespace App\Providers;

use Simple\Support\ServiceProvider;
use Simple\Session\DatabaseSessionHandler;

class SessionServiceProvider extends ServiceProvider
{
    public static function register() {
        session_set_save_handler(new DatabaseSessionHandler());
    }
    
    public static function boot() {
        session_start();
    }
}
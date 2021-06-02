<?php

namespace App\Middlewares;

use Simple\Routing\Middleware;

class AuthMiddleware extends Middleware
{
    public static function process() {
        if(array_key_exists('user_id', $_SESSION)) {
            return true;
        }
        return header('Location: /google/login');
    }
}
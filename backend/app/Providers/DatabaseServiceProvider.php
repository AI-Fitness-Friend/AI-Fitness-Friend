<?php

namespace App\Providers;

use Simple\Support\ServiceProvider;
use Simple\Database\Adaptor;

class DatabaseServiceProvider extends ServiceProvider
{
    public static function register() {
        require_once dirname(__DIR__, 2) . '/private/db_setup.php';
    }
}
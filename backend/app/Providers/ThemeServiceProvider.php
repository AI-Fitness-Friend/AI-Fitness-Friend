<?php

namespace App\Providers;

use Simple\Support\ServiceProvider;
use Simple\Support\Theme;

class ThemeServiceProvider extends ServiceProvider
{
    public static function register() {
        Theme::setLayout(dirname(__DIR__, 2) . '/resources/views/layouts/app.php');
    }
}
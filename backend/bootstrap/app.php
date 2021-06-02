<?php

use Simple\Application;

$app = new Application([
    \App\Providers\DatabaseServiceProvider::class,
    \App\Providers\SessionServiceProvider::class,
    \App\Providers\ThemeServiceProvider::class,
    \App\Providers\RouteServiceProvider::class
]);

return $app;
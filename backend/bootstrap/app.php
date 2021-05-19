<?php

use Simple\Application;

$app = new Application([
    \App\Providers\RouteServiceProvider::class
]);

return $app;
<?php

namespace App\Controllers;

class IndexController 
{
    public static function index() {
        include dirname(__DIR__, 2) . '/resources/index.php';
    }
}
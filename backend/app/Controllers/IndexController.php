<?php

namespace App\Controllers;

use Simple\Support\Theme;
use Simple\Database\Adaptor;
use App\Services\IndexService;

class IndexController 
{
    public static function workout() {
        return Theme::view('workout',
        [
            'routines' => IndexService::getRoutines()
        ]);
    }

    public static function record() {
        return Theme::view('record',
        [
            'records' => IndexService::getRecords()
        ]);
    }

    public static function contact() {
        return Theme::view('contact',
        [
            'user' => IndexService::getUser()
        ]);
    }

    public static function setting() {
        return Theme::view('setting');
    }
}
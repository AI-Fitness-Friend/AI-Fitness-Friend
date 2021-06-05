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
        return Theme::view('setting', [
            'voice' => IndexService::getVoice()
        ]);
    }


    //post

    public static function changeSetting() {
        IndexService::changeVoice((int)$_POST['voice']);
        return Theme::view('setting', [
            'voice' => IndexService::getVoice()
        ]);
    }

    public static function postContact() {
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];
        IndexService::postContact($name, $email, $message);
        return Theme::view('success');
    }
}
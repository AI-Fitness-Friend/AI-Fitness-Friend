<?php

namespace App\Controllers;

use Simple\Support\Theme;
use Simple\Database\Adaptor;
use App\Services\WorkoutService;
use App\Services\IndexService;

class WorkoutController 
{
    public static function routine($routine_id) {
        return Theme::view('routine',
        [
            'movements' => WorkoutService::getMovements($routine_id),
            'routine' => WorkoutService::getRoutine($routine_id)
        ]);
    }

    public static function movement($routine_id, $movement_id) {
        $voice = IndexService::getVoice();

        return Theme::view('movement',
        [
            'voice' => $voice,
            'movement' => WorkoutService::getMovement($routine_id, $movement_id)
        ]);
    }


    // post
    public static function recordMovement($routine_id, $movement_id) {
        $times = WorkoutService::getTimes($routine_id, $movement_id);
        WorkoutService::recordMovement($_SESSION['user_id'], $movement_id, $times);
        return;
    }


}
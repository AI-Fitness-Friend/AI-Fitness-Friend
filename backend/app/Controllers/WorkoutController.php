<?php

namespace App\Controllers;

use Simple\Support\Theme;
use Simple\Database\Adaptor;
use App\Services\WorkoutService;

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
        $times = WorkoutService::getTimes($routine_id, $movement_id);
        WorkoutService::recordMovement($_SESSION['user_id'], $movement_id, $times);
        return Theme::view('movement',
        [
        ]);
    }


}
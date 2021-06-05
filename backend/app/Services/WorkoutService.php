<?php

namespace App\Services;

use Simple\Database\Adaptor;


class WorkoutService
{
    public static function getTimes($routine_id, $movement_id) {
        $routine_movement = current(Adaptor::getAll('SELECT * FROM routine_movement WHERE routine_id = ? and movement_id = ?', [$routine_id, $movement_id]));
        return $routine_movement->times;
    }

    public static function getMovement($routine_id, $movement_id) {
        $times = self::getTimes($routine_id, $movement_id);
        $movement = current(Adaptor::getAll('SELECT * FROM movement WHERE id = ?', [$movement_id]));
        $movement->times = $times;

        return $movement;
    }

    public static function getRoutine($routine_id) {
        return current(Adaptor::getAll('SELECT * FROM routine WHERE id = ?', [$routine_id]));
    }

    public static function getMovements($routine_id) {
        $movements = [];
        $rms = Adaptor::getAll('SELECT * FROM routine_movement WHERE routine_id = ?', [$routine_id]);
        foreach($rms as $rm) {
            $movement =  Adaptor::getAll('SELECT * FROM movement WHERE id = ?', [$rm->movement_id])[0];
            $movement->times = $rm->times;
            $movements[] = $movement;
        }
        return $movements;
    }

    public static function recordMovement($user_id, $movement_id, $times) {
        Adaptor::exec (
            'INSERT INTO record(user_id, movement_id, times) VALUES(?, ?, ?)', 
            [$user_id, $movement_id, $times]
        );
    }

    
}
<?php

namespace App\Services;

use Simple\Database\Adaptor;


class IndexService 
{

    /*
            'routines' => [
                '0' => [
                    'name' => 'Athene',
                    'description' => 'Full Body Routine',
                    'movements' => [
                        '0' => [
                            'name' => 'squate',
                            'times' => 10
                        ]

                        '1' => [
                            'name' => 'jump',
                            'times' => 15
                        ]
                    ]
                ]
            ]
        */
    public static function getRoutines() {
        $rs = Adaptor::getAll('SELECT * FROM routine');
        $routines = [];
        foreach($rs as $r) {
            $routine = [];
            $routine['name'] = $r->name;
            $routine['movements'] = [];
            $routine['description'] = $r->description;
            $routine['id'] = $r->id;
            $rms = Adaptor::getAll('SELECT * FROM routine_movement WHERE routine_id = ?', [$r->id]);
            foreach($rms as $rm) {
                $movement = [];
                $mv =  Adaptor::getAll('SELECT * FROM movement WHERE id = ?', [$rm->movement_id])[0];
                $movement['name'] = $mv->name;
                $movement['times'] = $rm->times;
                $routine['movements'][] = $movement;
            }
            $routines[] = $routine;
        }
        return $routines;
    }


    public static function getRecords() {
        $records =  Adaptor::getAll('SELECT * FROM record WHERE user_id = ? ORDER BY exercised_at DESC', [$_SESSION['user_id']]);
        foreach($records as $record) {
            $movement_name = current(Adaptor::getAll('SELECT * FROM movement WHERE id = ?', [$record->movement_id]))->name;
            $record->movement_name = $movement_name;
        }
        return $records;
    }


    public static function getUser() {
        return current(Adaptor::getAll('SELECT * FROM user WHERE id = ?', [$_SESSION['user_id']]));
    }
}
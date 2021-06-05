<?php

namespace App\Services;

use Simple\Database\Adaptor;


class IndexService 
{
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

    public static function getVoice() {
        $voice = current(Adaptor::getAll('SELECT * FROM user_voice WHERE user_id = ?', [$_SESSION['user_id']]));
        if(!$voice) {
            Adaptor::exec('INSERT INTO user_voice(user_id, voice_id) VALUES (?, ?)', [$_SESSION['user_id'], 1]);
            $voice = current(Adaptor::getAll('SELECT * FROM user_voice WHERE user_id = ?', [$_SESSION['user_id']]));
        }

        $v = current(Adaptor::getAll('SELECT * FROM voice WHERE id = ?', [$voice->voice_id]));
        $voice->name = $v->name;
        $voice->path = $v->path;

        return $voice;
    }

    public static function changeVoice($voice_id) {
        Adaptor::exec('DELETE FROM user_voice WHERE user_id = ?', [$_SESSION['user_id']]);
        Adaptor::exec('INSERT INTO user_voice(user_id, voice_id) VALUES (?, ?)', 
        [
            $_SESSION['user_id'], 
            $voice_id
        ]);
    }

    public static function postContact($name, $email, $message) {
        Adaptor::exec('INSERT INTO contact(user_id, name, email, message) VALUES (?, ?, ?, ?)', 
        [
            $_SESSION['user_id'], 
            $name,
            $email,
            $message
        ]);
    }
}
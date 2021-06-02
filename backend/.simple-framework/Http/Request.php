<?php

namespace Simple\Http;

class Request
{
    public static function getMethod() {
        return filter_input(INPUT_POST, '_method') ?: $_SERVER['REQUEST_METHOD'];
    }

    public static function getPath() {
        return current(explode('?', $_SERVER['REQUEST_URI']));
    }
}
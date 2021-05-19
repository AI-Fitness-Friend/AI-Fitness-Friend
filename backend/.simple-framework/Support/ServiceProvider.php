<?php

namespace Simple\Support;

//interface로 만들면 세부내용을 무조건 구현해야하기 때문에 abstract class를 사용.
// (register의 경우 사용 안 할 수도 있어서.)
abstract class ServiceProvider 
{
    public static function register() {

    }

    public static function boot() {

    }
}
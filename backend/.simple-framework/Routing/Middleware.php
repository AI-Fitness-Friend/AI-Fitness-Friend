<?php
namespace Simple\Routing;

abstract class Middleware 
{
    abstract public static function process();
}
<?php

namespace Simple\Routing;

use Simple\Routing\RequestContext;
use Simple\Http\Request;

class Route 
{
    private static $contexts = [];

    public static function add($method, $path, $handler, $middlewares = []) {
        self::$contexts[] = new RequestContext($method, $path, $handler, $middlewares);
    }

    public static function run() {
        foreach(self::$contexts as $context) {
            if($context->method === strtolower(Request::getMethod()) && 
                is_array($urlParams = $context->match(Request::getPath())))
                {
                    if($context->runMiddlewares()) {
                        return \call_user_func($context->handler, ...$urlParams);
                    }
                    return false;
                }
        }

        //http_response_code(404);
        header("HTTP/1.0 404 Not Found");
        die('404 Not Found');
    }
}
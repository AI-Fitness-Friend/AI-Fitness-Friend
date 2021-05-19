<?php

namespace Simple\Routing;

class RequestContext {
    public $method;
    public $path;
    public $handler;
    public $middlewares;

    public function __construct($method, $path, $handler, $middlewares = []) {
        $this->method = $method;
        $this->path = $path;
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }

    //path(url)를 매칭. 매칭되면 array를 반환.
    public function match($url) {
        $urlParts = explode('/', $url);
        $urlPatternParts = explode('/', $this->path);
        $urlParams = [];

        if(count($urlParts) !== count($urlPatternParts)) return null;

        foreach($urlPatternParts as $idx => $part) {
            if(preg_match('/^\{.*\}$/', $part)) {
                $urlParams[] = $urlParts[$idx];
            } 
            else {
                if($urlParts[$idx] !== $part) {
                    return null;
                }
            }
        }
        return $urlParams;
    }

    public function runMiddlewares() {
        foreach ($this->middlewares as $middleware) {
            if(! $middleware::process()) {
                return false;
            }
        }
        return true;
    }

}
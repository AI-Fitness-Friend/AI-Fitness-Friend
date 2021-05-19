<?php

namespace Simple;

use Simple\Support\ServiceProvider;



class Application
{
    private $providers = [];

    // app 시작 전에 설정해야할 것들 (db연결, session키기, 환경설정, 에러 핸들러 등록, ....)을 
    // service provider로써 등록 후 실행
    public function __construct($providers = []) {
        $this->providers = $providers;
        array_walk($this->providers, fn ($provider) => $provider::register());
    }

    public function boot() {
        array_walk($this->providers, fn($provider) => $provider::boot());
    }

}
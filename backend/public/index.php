<?php
require_once dirname(__DIR__, 1) . '/vendor/autoload.php';

////
$app = require_once dirname(__DIR__, 1) . '/bootstrap/app.php';
$app->boot();
die();
////


use Simple\Database\Adaptor;
use Simple\Http\Request;
use Simple\Routing\Route;
use Simple\Session\DatabaseSessionHandler;
use Simple\Support\ServiceProvider;
use Simple\Application;

class DatabaseServiceProvider extends ServiceProvider
{
    public static function register() {
        Adaptor::setup('mysql:dbname=aifitnessfriend', 'root', '1111');
    }
    public static function boot() {
    }
}

class SessionServiceProvider extends ServiceProvider
{
    public static function register() {
        ini_set('session.gc_maxlifetime', 10);
        session_set_save_handler(new DatabaseSessionHandler());
    }
    public static function boot() {
        session_start();
    }
}

class RouteServiceProvider extends ServiceProvider
{
    public static function register() {
        Route::add('get', '/', function() {
            echo 'Hello, World';
        });

        Route::add('get', '/login/google', function() {
            echo 'Google login';
        });

        Route::add('get', '/users/{id}', function($id) {
            var_dump(Adaptor::getAll('SELECT * FROM user WHERE id = ?', [$id]));
        });
    }
    public static function boot() {
        Route::run();
    }
}


$app = new Application([
    DatabaseServiceProvider::class, 
    SessionServiceProvider::class, 
    RouteServiceProvider::class
]);

$app->boot();




// $_SESSION['msg'] = 'Hello, World!';
// $_SESSION['user_id'] = 1;



// $handler->open();
// $handler->close();
// $handler->read('test');
// $handler->write('test', 'something');
// $handler->destory('test');

// $_SESSION['user_id'] = 1;
// $_SESSION['msg'] = 'HIHI';
// die(var_dump($_SESSION));




// die(var_dump($_SERVER));

// Adaptor::setup('mysql:dbname=aifitnessfriend', 'root', '1111');
// class User
// {

// }
// $users = Adaptor::getAll('SELECT * FROM user', [], User::class);
// var_dump($users);


// $_SERVER['REQUEST_METHOD'] = 'GET';
// $_SERVER['REQUEST_URI'] = '/users/1';

// Adaptor::setup('mysql:dbname=aifitnessfriend', 'root', '1111');

// Route::add('get', '/', function() {
//     echo 'Hello, World';
// });

// Route::add('get', '/login/google', function() {
//     echo 'Google login';
// });

// Route::add('get', '/users/{id}', function($id) {
//     var_dump(Adaptor::getAll('SELECT * FROM user WHERE id = ?', [$id]));
// });
// Route::run();




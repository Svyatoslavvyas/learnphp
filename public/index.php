<?php
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js)$/', $_SERVER["REQUEST_URI"])) {
    return false;    // serve the requested resource as-is.
}



if (is_file(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    spl_autoload_register(static function ($class) {
        $prefix = 'App\\';
        if (strncmp($class, $prefix, strlen($prefix)) !== 0) {
            return;
        }
        $file = __DIR__ . '/../src/' . str_replace('\\', '/', substr($class, strlen($prefix))) . '.php';
        if (is_file($file)) {
            require_once $file;
        }
    });
}

require_once __DIR__ . '/../helpers.php';
require_once __DIR__ . '/../routes.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start(['cookie_httponly' => true, 'cookie_samesite' => 'Lax']);
}

$router = new App\Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
$match = $router->match();
if ($match) {
    if(is_callable($match['action'])){
        call_user_func($match['action']);
    } else if(is_array($match['action'])){
        $class = $match['action'][0];
        $controller = new $class();
        $method = $match['action'][1];
        $controller->$method();
    }
    
} else {
    http_response_code(404);
    echo '<img src="https://http.cat/404"></img>';
}
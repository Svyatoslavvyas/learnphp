<?php
namespace App;

class Router {
    private static $routes = [];

    private $path;
    private $method;

    public function __construct($url, $method)
    {
        $this->path = parse_url($url, PHP_URL_PATH);
        $this->method = $method;
    }

    public function match(){
        foreach(self::$routes as $route) {
            if($this->path === $route['path'] && $this->method === $route['method']) {
                return $route;
            }
        }
    }

    public static function getRoutes(){
        return self::$routes;
    }

    public static function addRoute($method, $path, $action) {
        self::$routes[] = ['method' => $method, 'path' => $path, 'action' => $action];
    }

    public static function get($path, $action) {
        self::addRoute('GET', $path, $action);
    }

    public static function post($path, $action) {
        self::addRoute('POST', $path, $action);
    }
}
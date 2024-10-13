<?php

class Router {
    private static $routes = [];

    public static function get($uri, $action) {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post($uri, $action) {
        self::$routes['POST'][$uri] = $action;
    }

    public static function put($uri, $action) {
        self::$routes['PUT'][$uri] = $action;
    }

    public static function patch($uri, $action) {
        self::$routes['PATCH'][$uri] = $action;
    }

    public static function delete($uri, $action) {
        self::$routes['DELETE'][$uri] = $action;
    }

    public static function direct($uri, $method) {
        $uri = trim($uri, '/');
        foreach (self::$routes[$method] as $route => $action) {
            $routePattern = preg_replace('/\{([a-zA-Z]+)\}/', '([a-zA-Z0-9]+)', trim($route, '/'));
            if (preg_match("#^$routePattern$#", $uri, $matches)) {
                array_shift($matches);
                return self::callAction($action, $matches);
            }
        }

        http_response_code(404);
        echo "404 - Not Found";
    }

    protected static function callAction($action, $parameters = []) {
        [$controller, $method] = $action;
        // require_once "{$controller}.php";
        (new $controller)->$method(...$parameters);
    }
}

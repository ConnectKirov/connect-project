<?php

class Router {
    private $routes;
    private $params;
    private $path;

    public function __construct() {
        $this->path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $this->params = $_GET;
        $this->routes = [];
    }

    public function get($path, callable $callback) {
        if (!is_array($path)) {
            $path = [$path];
        }
        array_walk($path, function ($item) use ($callback) {
            $this->routes[$item] = $callback;
        });
    }

    public function __destruct() {
        echo call_user_func($this->routes[$this->path], $this->params);
    }
}
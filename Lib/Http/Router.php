<?php

namespace App\Lib\Http;

class Router {
    private $routes;
    private $params;
    private $path;
    /**
     * @var Request
     */
    private $req;
    /**
     * @var Response
     */
    private $res;
    const ALLOWED_METHODS = ['POST', 'GET'];

    public function __construct() {
        // отсекаем параметры из адресной строки
        // например: /users?foo=bar => /users
        $this->path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $this->params = $_GET;
        $this->routes = [];
        $this->req = new Request();
        $this->req->params = $this->params;
        $this->req->body = $_POST;
        $this->req->method = $_SERVER['REQUEST_METHOD'];
        $this->req->cookies = $_COOKIE;
        if (!in_array($_SERVER['REQUEST_METHOD'], Router::ALLOWED_METHODS)) {
            header('405 Not Allowed');
            // throw new Error('Method not allowed', 405);
        }
        $this->res = new Response();
    }


    private function addHandler($method, $paths, $callback) {
        if (!is_array($paths)) {
            $paths = [$paths];
        }
        // записываем для каждого пути путь => обработчик
        // пример: $paths = ['/users'] $callback = function() { ... }
        // стало: $this->routes['/users'] = function() { ... }
        array_walk($paths, function ($path) use ($callback, $method) {
            $this->routes[$method][$path] = $callback;
        });
        return null;
    }

    public function get($paths, callable $callback) {
        return $this->addHandler('GET', $paths, $callback);
    }

    public function post($paths, callable $callback) {
        return $this->addHandler('POST', $paths, $callback);
    }

    public function put($paths, callable $callback) {
        return $this->addHandler('PUT', $paths, $callback);
    }

    public function delete($paths, callable $callback) {
        return $this->addHandler('DELETE', $paths, $callback);
    }

    /**
     * Вызывается по уничтожении класса.
     * Как правило, при завершении работы страницы
     */
    public function __destruct() {
        $func = $this->routes[$this->req->method][$this->path];
        if (!isset($func)) {
            header('404 Not Found');
           // throw new Error('Not Found', 404);
        }
        // Вызываем обработчик, который соответствует текущему пути в массиве $this->routes
        echo call_user_func($func, $this->req, $this->res);
    }
}


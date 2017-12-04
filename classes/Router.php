<?php

class Router {
    private $routes;
    private $params;
    private $path;

    public function __construct() {
        // отсекаем параметры из адресной строки
        // например: /users?foo=bar => /users
        $this->path = explode('?', $_SERVER['REQUEST_URI'])[0];
        $this->params = $_GET;
        $this->routes = [];
    }

    /**
     * @param string|array $paths Путь, например, '/users' или ['/users','/polzovateli']
     * @param callable $callback Функция-обработчик, которая будет вызвана
     */
    public function get($paths, callable $callback) {
        // возможность передавать в путь строку или массив
        if (!is_array($paths)) {
            $paths = [$paths];
        }
        // записываем для каждого пути путь => обработчик
        // пример: $paths = ['/users'] $callback = function() { ... }
        // стало: $this->routes['/users'] = function() { ... }
        array_walk($paths, function ($path) use ($callback) {
            $this->routes[$path] = $callback;
        });
    }

    /**
     * Вызывается по уничтожении класса.
     * Как правило, при завершении работы страницы
     */
    public function __destruct() {
        // Вызываем обработчик, который соответствует текущему пути в массиве $this->routes
        echo call_user_func($this->routes[$this->path], $this->params);
    }
    public static function getFile($url) {
        return $url.'?'.filemtime($_SERVER['DOCUMENT_ROOT'].$url );
    }
}
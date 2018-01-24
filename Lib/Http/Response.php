<?php

namespace App\Lib\Http;

class Response {
    public function json($data) {
        header('Content-type: application/json');

        return json_encode($data);
    }

    public function redirect($url) {
        header("Location: {$url}");
        return null;
    }

    public function status($status) {
        header("Status: {$status}");
    }

    public function setCookie($name, $value, $expire = null, $path = '/', ...$args) {
        $expire = $expire ?? time() + 60 * 60 * 24 * 30;
        setcookie($name, $value, $expire, $path, ...$args);
    }
}
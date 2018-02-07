<?php

namespace App\Lib\Http;

class Request {
    public $headers;
    public $params;
    public $body;
    public $method;
    public $cookies;


    public function getCookie($name) {
        return $this->cookies[$name];
    }
}
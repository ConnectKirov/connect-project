<?php

class Response {
    public function json($data) {
        header('Content-type: application/json');

        return json_encode($data);
    }

    public function redirect($url) {
        header("Location: {$url}");
        return null;
    }
}
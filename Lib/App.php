<?php

namespace App\Lib;

use ATehnix\VkClient\Auth;

class App {
    /**
     * @var Template
     */
    public $templating;
    /**
     * @var Auth
     */
    public $auth;

    public function __construct() { }

    public function setTemplating(Template $templating) {
        $this->templating = $templating;
    }

    public function setVkAuth(Auth $auth) {
        $this->auth = $auth;
    }
}
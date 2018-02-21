<?php

namespace App\Lib;

use App\Lib\Database\Models\User;
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
    /**
     * @var User
     */
    public $user;

    public function __construct() { }

    public function setTemplating(Template $templating) {
        $this->templating = $templating;
    }

    public function setVkAuth(Auth $auth) {
        $this->auth = $auth;
    }

    public function setUser(?User $user) {
        $this->user = $user;
    }
}
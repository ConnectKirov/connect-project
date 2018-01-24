<?php

namespace App\Lib;

class App {
    /**
     * @var Template
     */
    public $templating;

    public function __construct() { }

    public function setTemplating(Template $templating) {
        $this->templating = $templating;
    }
}
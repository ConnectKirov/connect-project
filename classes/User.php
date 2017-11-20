<?php

class User {
    public $fistName;
    public $lastName;
    public $avatar;

    public function __construct($firstName, $lastName, $avatar) {
        $this->fistName = $firstName;
        $this->lastName = $lastName;
        $this->avatar = $avatar;
    }

    public function fullName() {
        return $this->fistName . ' ' . $this->lastName;
    }
}
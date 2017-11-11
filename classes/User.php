<?php

class User {
    public $firstName;
    public $lastName;
    public $avatar;

    public function __construct($firstName, $lastName, $avatar) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->avatar = $avatar;
    }

    public function fullName() {
        return $this->firstName . ' ' . $this->lastName;
    }
}

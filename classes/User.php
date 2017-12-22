<?php

class User {
    public $firstName;
    public $lastName;
    public $avatar;
    public $id;

    public function __construct($id, $firstName, $lastName, $avatar) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->avatar = $avatar;
        $this->id = $id;
    }

    public function fullName() {
        return $this->firstName . ' ' . $this->lastName;
    }
}

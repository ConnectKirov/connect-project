<?php

class user {
    public $firstname;
    public $lastname;
    public $picture;
    public $email;
    public $gender;
    public $age;

    public function __construct($firstname, $lastname, $picture, $email, $gender, $age){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->picture = $picture;
        $this->email = $email;
        $this->gender = $gender;
        $this->age = $age;
    }


    public function nameAgeGender()
    {
        return $this->firstname .' '. $this->age .' '. $this->gender;
    }

}



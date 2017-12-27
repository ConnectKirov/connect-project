<?php

/**
 * Class User
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property string $avatar
 */
class User extends Model {
    public const tableName = 'users';

    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $avatar;
    public $role = "USER";
    public $createdAt;

    private function hashPassword($pass) {
        return password_hash($pass, PASSWORD_BCRYPT);
    }


    public function fullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function setPassword($password) {
        $this->password = $this->hashPassword($password);
    }

    public function comparePassword($password) {
        return $this->hashPassword($this->password) === $this->hashPassword($password);
    }
}

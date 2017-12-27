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

    public function fullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function comparePassword($password) {
        return password_verify($password, $this->password);
    }
}

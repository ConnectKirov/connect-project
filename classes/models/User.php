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
    public $avatar;

    public function fullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }
}

<?php

namespace App\Lib\Database\Models;

$config = include_once "../../../config.php";

use \App\Lib\Database\Model;

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
    public $updatedAt;
    private $password;

    public function fullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function comparePassword($password) {
        return password_verify($password, $this->password);
    }

    public static function fromRequest(\App\Lib\Http\Request $req) {
        $token = AuthToken::findOne([ 'token' => $req->cookies[COOKIE_TOKEN] ]);
        if (!$token) {
            throw new HttpException('Token now found');
        }
        if ($token->dateUntil < new DateTime()) {
            throw new HttpException('Token exiped');
        }
        return User::findOne($token->user);
    }

    public static function authWithVk() {

    }
}

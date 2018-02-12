<?php

namespace App\Lib\Database\Models;

use \App\Lib\Database\Model;
use App\Lib\Http\Request;
use ATehnix\VkClient\Auth;
use DateTime;

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
    public $vkId;
    public $password;
    const AUTH_COOKIE = "COOKIE_TOKEN";

    public function fullName(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function comparePassword($password) {
        return password_verify($password, $this->password);
    }

    public static function fromRequest(Request $req) {
        $token = AuthToken::findOne([ 'token' => $req->getCookie(User::AUTH_COOKIE)]);
        if (!$token) {
            throw new \HttpException('Token now found');
        }
        if ($token->dateUntil < new DateTime()) {
            throw new \HttpException('Token expried');
        }
        return User::findOne($token->user);
    }

    public static function authWithVk() {
        $auth = new Auth('client_id', 'client_secret', 'redirect_uri');

        echo "<a href='{$auth->getUrl()}'>ClickMe<a>";

        // ...

        $token = $auth->getToken($_GET['code']);
    }
}
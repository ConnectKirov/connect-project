<?php

namespace App\Lib\Database\Models;

use \App\Lib\Database\Model;

/**
 * Class AuthToken
 *
 * @property int $id
 * @property User $user
 * @property string $token
 * @property \DateTime $dateUntil
 */
class AuthToken extends Model {
    public const tableName = 'auth_tokens';

    public $id;
    public $user;
    public $token;
    public $dateUntil;

    public function generate() {
        $this->token = bin2hex(openssl_random_pseudo_bytes(16));
    }

    protected function beforeSave() {
        $this->dateUntil = $this->dateUntil->format(MYSQL_DATETIME_FORMAT);
    }
}

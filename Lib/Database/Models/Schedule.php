<?php

namespace App\Lib\Database\Models;

use \App\Lib\Database\Model;

/**
 * Class Schedule
 *
 * @property int $id
 * @property User $user
 * @property DateTime $dateStart
 * @property DateTime $dateEnd
 */
class Schedule extends Model {
    public const tableName = 'schedule';

    public $id;
    /**
     * @var User
     */
    public $user;
    public $dateStart;
    public $dateEnd;
}
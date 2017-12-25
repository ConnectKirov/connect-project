<?php


/**
 * Class Schedule
 *
 * @property int $id
 * @property User $user
 * @property string $dateStart
 * @property string $dateEnd
 */
class Schedule extends Model {
    public const tableName = 'schedule';

    public $id;
    public $user;
    public $dateStart;
    public $dateEnd;
}

<?php


class Migration extends Model {
    public const tableName = 'migrations';

    public $id;
    public $filename;
    public $migratedAt;
}
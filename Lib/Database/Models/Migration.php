<?php

namespace App\Lib\Database\Models;

use \App\Lib\Database\Model;


class Migration extends Model {
    public const tableName = 'migrations';

    public $id;
    public $filename;
    public $migratedAt;
}
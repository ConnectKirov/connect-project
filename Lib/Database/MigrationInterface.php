<?php

namespace App\Lib\Database;

interface MigrationInterface {
    public static function up();
    public static function down();
}
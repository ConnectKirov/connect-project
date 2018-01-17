<?php

interface MigrationInterface {
    public static function up();
    public static function down();
}
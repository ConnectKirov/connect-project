<?php

use App\Lib\Database\MigrationInterface;
use App\Lib\Database\Schema;
use App\Lib\Database\Table;

class CreateAuthTokenAndVkColmnMigration implements MigrationInterface {
    public static function up() {
        Schema::createTable('auth_tokens', function (Table $table) {
           $table->primary();
           $table->int('user')->unsigned();
           $table->string('token')->unique();
           $table->date('dateUntil');
        });
        Schema::table('users', function (Table $table) {
           $table->int('vkId')
               ->length(20)
               ->unique();
        });
    }

    public static function down() {
        Schema::dropTable("auth_tokens");

        Schema::table('users', function (Table $table) {
            $table->dropColumn('vkId');
        });
    }
}
<?php

include_once "../classes/Migration.php";
include_once "../classes/Schema.php";

class CreateUsersTableMigration implements Migration {
    public static function up() {
        Schema::createTable('users1', function (Table $table) {
            $table->primary();
            $table->timestamps();

            $table->string('email')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('avatar');
            $table->enum('role', ['USER', 'ADMIN']);
        });
    }

    public static function down() {
        Schema::dropTable('users1');
    }
}
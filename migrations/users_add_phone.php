<?php

include_once "../classes/Migration.php";
include_once "../classes/Schema.php";

class UsersAddPhoneMigration implements Migration {
    public static function up() {
        Schema::table('users1', function (Table $table) {
            $table->string('phone');
        });
    }

    public static function down() {
        Schema::table('users1', function (Table $table) {
            $table->dropColumn('email');
            $table->dropColumn('role');
        });
    }
}
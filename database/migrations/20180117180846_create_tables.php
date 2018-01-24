<?php

use App\Lib\Database\MigrationInterface;
use App\Lib\Database\Schema;
use App\Lib\Database\Table;

class CreateTablesMigration implements MigrationInterface {
    public static function up() {
        print_r("Creating users... \n\n");
        Schema::createTable("users", function (Table $table) {
            $table->primary();
            $table->timestamps();
            $table->enum('role', ['ADMIN', 'USER']);
            $table->string('firstName');
            $table->string('lastName');
            $table->string('avatar');
            $table->string('password');
        });

        print_r("Creating schedule... \n");
        Schema::createTable("schedule", function (Table $table) {
            $table->primary();
            $table->timestamps();

            $table->date('dateStart');
            $table->date('dateEnd');
            $table->foreign('user');
        });
    }

    public static function down() {
        Schema::dropTable("users");
        Schema::dropTable("schema");
    }
}
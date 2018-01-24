<?php

namespace App\Lib\Database;

class Schema {

    private static $dbh;

    public static function setConnection(\PDO $dbh) {
        self::$dbh = $dbh;
    }

    /**
     * Создает таблицу с заданным именем, и вызывает коллбек с  $table первым аргументом
     *
     * @param string $tableName
     * @param callable $callback
     */
    public static function createTable(string $tableName, callable $callback) {
        $sql = "CREATE TABLE {$tableName} ";
        $table = new Table($tableName);
        $callback($table);
        $sql = $sql . "(" . $table->getCreatedSql() . ");";
        self::query($sql);
    }

    /**
     * Выбирает таблицу с заданным именем, и вызывает коллбек с  $table первым аргументом
     *
     * @param string $tableName
     * @param callable $callback
     */
    public static function table(string $tableName, callable $callback) {
        $sql = "ALTER TABLE {$tableName}";
        $table = new Table($tableName);
        $callback($table);
        $sql .= " " . $table->getAddedSql();
        $sql .= $table->getDeletedSql();
        $sql .= ";";
        self::query($sql);
    }

    public static function dropTable(string $tableName) {
        $sql = "DROP TABLE {$tableName};";
        self::query($sql);
    }

    public static function renameTable(string $oldName, string $newName) {
        $sql = "RENAME TABLE {$oldName} TO {$newName};";
        self::query($sql);
    }

    public static function query($sql) {
        // print $sql;
        self::$dbh->query($sql);
    }
}
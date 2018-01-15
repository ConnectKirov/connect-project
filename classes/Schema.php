<?php

include_once __DIR__ . "/Table.php";

class Schema {


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
        // TODO: implement db query
        print "SQL: \n\n";
        print $sql;
        print "\n";
    }
}
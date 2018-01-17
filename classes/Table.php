<?php

include_once __DIR__ . "/Column.php";

class Table {
    private $tableName;
    /**
     * @var Column[]
     */
    private $columns = [];
    private $deletedcolumns = [];
    private $renamedcolumns = [];

    public function __construct($tableName) {
        $this->tableName = $tableName;
    }

    public function column(string $name, string $type): Column {
        $column = new Column($name, $type);
        $this->columns[] = $column;
        return $column;
    }

    public function getCreatedSql(): string {
        $sql = '';
        $sqls = [];
        foreach ($this->columns as $column) {
            $sqls[] = $column->getSql();
        }
        return implode(", ", $sqls);
    }

    public function getDeletedSql(): string {
        $sqls = array_map(function ($column) {
            return "DROP COLUMN {$column}";
        }, $this->deletedcolumns);
        return implode(", ", $sqls);
    }

    public function getAddedSql(): string {
        $sql = '';
        $sqls = [];
        foreach ($this->columns as $column) {
            $sqls[] = "ADD COLUMN {$column->getSql()}";
        }
        return implode(", ", $sqls);
    }

    public function int(string $columnName): Column {
        return $this->column($columnName, 'integer');
    }

    public function string(string $columnName): Column {
        return $this->column($columnName, 'varchar');
    }

    public function date(string $columnName): Column {
        return $this->column($columnName, 'datetime');
    }

    public function enum($columnName, array $values): Column {
        return $this->column($columnName, 'enum')->values($values);
    }

    public function primary($columnName = 'id'): Column {
        return $this->column($columnName, 'integer')
            ->key('PRIMARY')
            ->autoIncrement()
            ->unsigned();
    }

    // TODO: implement foreign in db
    public function foreign($columnName): Column {
        return $this->column($columnName, 'integer')
            ->unsigned();
    }

    public function timestamps($createdAt = 'createdAt', $updatedAt = 'updatedAt') {
        $this->column($createdAt, 'datetime')
            ->default(Column::CURRENT_TIMESTAMP);

        $this->column($updatedAt, 'datetime')
            ->default(Column::CURRENT_TIMESTAMP)
            ->onUpdate(Column::CURRENT_TIMESTAMP);
    }

    public function dropColumn(string $columnName) {
        $this->deletedcolumns[] = $columnName;
    }

    public function renameColumn(string $oldName, string $newName) {
        // TODO: not implemented
        throw new ErrorException("NOT IMPLEMENTED");
        $this->renamedcolumns[] = [$oldName, $newName];
    }
}
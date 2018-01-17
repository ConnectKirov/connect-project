<?php

class Column {
    private $columnName;
    private $type;
    private $autoIncrement;
    private $notNullable;
    private $default;
    private $key;
    private $index;
    private $comment;
    private $length;
    private $unique;
    private $unsigned;
    private $onUpdate;
    private $onDelete;
    private $referencesTable;
    private $referencesColumn;
    private $values = [];

    public const CURRENT_TIMESTAMP = "CURRENT_TIMESTAMP";


    public function __construct(string $name, string $type) {
        $this->columnName = $name;
        $this->type = $type;
    }

    public function getSql(): string {
        $sqls = ["{$this->columnName}"];
        $length = $this->length;
        $type = $this->type;
        switch (strtoupper($this->type)) {
            case 'ENUM':
                $length = implode(',', array_map(function ($value) {
                    return "'{$value}'";
                }, $this->values));
                break;
            case 'VARCHAR':
                $length = $length ?? 255;
                break;
            case 'INTEGER':
                $length = $length ?? 11;
                break;

        }
        $type = $length ? "{$type}({$length})" : $type;

        $sqls[] = $type;

        if ($this->default) {
            $sqls[] = "DEFAULT {$this->default}";
        }

        if ($this->unique) {
            $sqls[] = "UNIQUE";
        }

        if ($this->notNullable) {
            $sqls[] = "NOT NULL";
        }

        if ($this->unsigned) {
            $sqls[] = "UNSIGNED";
        }

        if ($this->onUpdate) {
            $sqls[] = "ON UPDATE {$this->onUpdate}";
        }

        if ($this->comment) {
            $sqls[] = "COMMENT '{$this->comment}'";
        }

        if ($this->key) {
            $sqls[] = "{$this->key} KEY";
        }

        if ($this->autoIncrement) {
            $sqls[] = "AUTO_INCREMENT";
        }

        if ($this->referencesTable && $this->referencesColumn) {
            $sqls[] = "REFERENCES {$this->referencesTable}({$this->referencesColumn})";
            $this->onDelete = $this->onDelete ?? "CASCADE";
        }

        if ($this->onDelete) {
            $sqls[] = "ON DELETE {$this->onDelete}";
        }

        return implode(" ", $sqls);
    }

    public function type(string $type) {
        $this->type = strtoupper($type);
        return $this;
    }

    public function references(string $columnName) {
        $this->referencesColumn = $columnName;
        return $this;
    }

    public function inTable(string $tableName) {
        $this->referencesTable = $tableName;
        return $this;
    }

    public function autoIncrement(bool $autoIncrement = true) {
        $this->autoIncrement = $autoIncrement;
        return $this;
    }

    public function notNullable(bool $notNullable = true) {
        $this->notNullable = $notNullable;
        return $this;
    }

    public function comment(string $comment) {
        $this->comment = $comment;
        return $this;
    }

    public function values(array $values) {
        $this->values = $values;
        return $this;
    }

    public function key(string $key) {
        $this->key = $key;
        return $this;
    }

    public function length(int $length) {
        $this->length = $length;
        return $this;
    }

    public function unsigned(bool $unsigned = true) {
        $this->unsigned = $unsigned;
        return $this;
    }

    public function default(string $default) {
        $this->default = $default;
        return $this;
    }

    public function unique(bool $unique = true) {
        $this->unique = $unique;
        return $this;
    }

    public function onUpdate(string $onUpdate) {
        $this->onUpdate = $onUpdate;
        return $this;
    }
}
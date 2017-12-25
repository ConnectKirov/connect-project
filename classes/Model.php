<?php

define('MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

// TODO:
// autotimestamps
// autotypes on load and save
// autorelations on load and save

interface ModelType {
    public static function load($value);
    public static function save($value);
    public static function serialize($value);
}

class SimpleArrayType implements ModelType {
    public static function load($value) {
        return explode($value, ',');
    }
    public static function save($value) {
        return implode($value, ',');
    }
    public static function serialize($value) {
        return $value;
    }
}


class DateType implements ModelType {
    public static function load($value) {
        return DateTime::createFromFormat(MYSQL_DATETIME_FORMAT, $value);
    }
    public static function save($value) {
        return $value->format(MYSQL_DATETIME_FORMAT);
    }
    public static function serialize($value) {
        return $value->format(DATE_ISO8601);
    }
}


class Model implements JsonSerializable {
    public static $PDO;

    public static function setPdo($PDO) {
        self::$PDO = $PDO;
    }

    private static function buildWhereString($where) {
        if (!count($where)) return "";
        $strings = array_map(function ($key) {
            return "`{$key}` = :{$key}";
        }, array_keys($where));
        return " WHERE " . implode(' AND ', $strings);
    }


    public static function find($where = []): array {
        $sth = self::$PDO->prepare("SELECT * FROM `" . static::tableName . "`" . self::buildWhereString($where));
        $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
        var_dump("SELECT * FROM `" . static::tableName . "`" . self::buildWhereString($where));
        $sth->execute($where);

        return $sth->fetchAll();
    }

    public static function findOne($id): Model {
        $sth = self::$PDO->prepare("SELECT * FROM `" . static::$tableName . "` WHERE id = ?", [$id]);
        $sth->execute();

        return $sth->fetch(PDO::FETCH_CLASS, static::class);
    }

    public static function save(Model $record) {
        if ($record->id) {
            $sth = self::$PDO->prepare("UPDATE `" . static::$table . "` VALUES ", $record);
            $sth->execute();

            return $sth->fetch(PDO::FETCH_CLASS, self::class);
        } else {
            // insert
        }
    }

    public function __set($name, $value) {
        var_dump("TEst");
        if ($name === 'dateStart' && is_string($value)) {
            $this->${$name} = DateTime::createFromFormat(MYSQL_DATETIME_FORMAT, $value);
        } else {
            $this->${$name} = $value;
        }
    }


    // TODO:
    public function jsonSerialize() {
        return [];
    }
}
<?php

namespace App\Lib\Database;

define('MYSQL_DATETIME_FORMAT', 'Y-m-d H:i:s');

// TODO:
// autotimestamps
// autotypes on load and save
// autorelations on load and save

interface ModelType {
    public static function load(string $value);

    public static function save($value): string;

    public static function serialize($value);
}

class SimpleArrayType implements ModelType {
    public static function load(string $value) {
        return explode($value, ',');
    }

    public static function save($value): string {
        return implode($value, ',');
    }

    public static function serialize($value) {
        return $value;
    }
}


class DateType implements ModelType {
    public static function load(string $value) {
        return \DateTime::createFromFormat(MYSQL_DATETIME_FORMAT, $value);
    }

    /**
     * @param $value \DateTime
     * @return string
     */
    public static function save($value): string {
        return $value->format(MYSQL_DATETIME_FORMAT);
    }

    /**
     * @param $value \DateTime
     * @return string
     */
    public static function serialize($value) {
        return $value->format(DATE_ISO8601);
    }
}

/**
 * Class Model
 *
 * @property \PDO $PDO
 */
class Model implements \JsonSerializable {
    public static $PDO;

    public static function init(\PDO $PDO) {
        static::$PDO = $PDO;
    }

    private static function buildWhere($where): string {
        if (!count($where)) {
            return "";
        }
        $strings = array_map(function ($key) {
            return "`{$key}` = :{$key}";
        }, array_keys($where));
        return " WHERE " . implode(' AND ', $strings);
    }

    private static function buildValuesInsert($vars): string {
        $keys = array_keys($vars);
        $fields = array_map(function ($key) {
            return "`${key}`";
        }, $keys);
        $fields = implode(',', $fields);
        $values = array_map(function ($key) {
            return ":${key}";
        }, $keys);
        $values = implode(',', $values);
        return " (${fields}) VALUES ({$values})";
    }

    private static function buildValuesUpdate($vars): string {
        $keys = array_keys($vars);
        $fields = array_map(function ($key) {
            return "`${key}` = :{$key}";
        }, $keys);
        $fields = implode(',', $fields);
        return "SET {$fields}";
    }


    /**
     * Получаем несколько записей из бд по условию или без
     *
     * @param array $where массив с условиями ['name' => 'Vova'] sql будет WHERE `name` = 'Vova'
     * @return [Model]
     */
    public static function find($where = []): array {
        $sql = "SELECT * FROM `" . static::tableName . "`" . self::buildWhere($where);
        $sth = self::$PDO->prepare($sql);
        $sth->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);
        $sth->execute($where);

        return $sth->fetchAll();
    }

    /**
     * Возвращаем запись по id
     *
     * @param $id
     * @return Model
     */
    public static function findOne($where): ?Model {
        $where = is_array($where) ? $where : ['id' => $where];
        $sql = "SELECT * FROM `" . static::tableName . "`" . self::buildWhere($where);
        $sth = self::$PDO->prepare($sql);
        $sth->execute($where);
        $sth->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, static::class);

        $res = $sth->fetch();

        if (method_exists($res, 'afterInit')) {
            $res->afterInit();
        }

        return $res ? $res : null;
    }

    /**
     * Обновляем текущие данные из бд
     */
    public function refresh() {
        $sth = self::$PDO->prepare("SELECT * FROM `" . static::tableName . "` WHERE id = ?");
        $sth->execute([$this->id]);
        $sth->setFetchMode(\PDO::FETCH_INTO, $this);
        return $sth->fetch();
    }

    public function getArray(): array {
        return array_filter(get_object_vars($this), function ($item) {
            return $item !== null;
        });
    }

    /*
     * Сохраняем поля текущего класса в бд
     */
    public function save() {
        if (method_exists($this, 'beforeSave')) {
            $this->beforeSave();
        }
        // выбираем только существующие поля
        $vars = $this->getArray();
        // если нет id, то считаем, что запись новая
        if (!$this->id) {
            $sql = "INSERT INTO `" . static::tableName . "`" . self::buildValuesInsert($vars);
            $sth = self::$PDO->prepare($sql);
            $sth->execute($vars);
            $this->id = self::$PDO->lastInsertId();
        } else {
            $sql = "UPDATE `" . static::tableName . "` " . self::buildValuesUpdate($vars) . self::buildWhere([
                    'id' => $this->id
                ]);
            $sth = self::$PDO->prepare($sql);
            $sth->execute($vars);
        }
        $this->refresh();
        return $this;
    }

    // TODO:
    public function jsonSerialize() {
        return $this->getArray();
    }
}
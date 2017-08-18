<?php

namespace Classes\Database;

require_once $_SERVER['DOCUMENT_ROOT']."/mystory/vendor/autoload.php";

use Classes\Config\Config;

class DB
{
    private static $_instance = null;
    private $pdo,
            $query,
            $_error = false,
            $results,
            $count = 0,
            $lastInserted = null;

    private function __construct()
    {
        try {
            $this->pdo = new \PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/db') , Config::get('mysql/username'), Config::get('mysql/password'));
        } catch(\PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new DB();
        }

        return self::$_instance;
    }


    public function query($sql, $params = array())
    {
        $this->_error = false;

        if ($this->query = $this->pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->query->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->query->execute()) {
                $this->results = $this->query->fetchAll(\PDO::FETCH_OBJ);
                $this->count = $this->query->rowCount();

            } else {
                $this->_error = true;
            }
        }

        return $this;
    }

    private function action($action, $table, $where = array())
    {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=');

            $field     = $where[0];
            $operator = $where[1];
            $value     = $where[2];

            if(in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
    }

    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where);
    }

    public function all($table)
    {
        return $this->query("SELECT * from $table", [])->results();
    }

    public function delete($table, $where)
    {
        return $this->action('DELETE ', $table, $where);
    }

    public function insert($table, $fields = array())
    {
        if (count($fields)) {
            $keys = array_keys($fields);
            $values = '?';
            $x = 1;

            foreach ($fields as $field) {

                if ($x < count($fields)) {
                    $values .= ", ?";
                }

                $x++;
            }


            $sql = "INSERT INTO {$table} (".implode(',', $keys).") VALUES ({$values})";

            if (!$this->query($sql, $fields)->error()) {
                return true;
            }


        }

        return false;
    }

    public function update($table, $id, $fields = array())
    {

        $set = '';
        if (count($fields)) {
            $x = 1;
            foreach ($fields as $key => $value) {
                $set .= "{$key} = ?";
                if ($x < count($fields)) {
                    $set .= ", ";
                }
                $x++;
            }
        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";

        if(!$this->query($sql, $fields)->error()) {
            return true;
        }

        return false;
    }

    public function results()
    {
        return $this->results;
    }

    public function first()
    {
        return $this->results[0];
    }

    public function error()
    {
        return $this->_error;
    }

    public function count()
    {
        return $this->count;
    }

    public function lastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }
}
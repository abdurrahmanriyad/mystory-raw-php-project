<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/3/17
 * Time: 12:38 PM
 */

namespace Classes\Database;
use Classes\ErrorMessage\ErrorMessage;


class DbHelper
{

    private $database_conneciton;
    private $errorMessage;

    /**
     * DbHelper constructor.
     * @param $database_conneciton
     */
    public function __construct()
    {
        $this->errorMessage = new ErrorMessage();
        $this->database_conneciton = new MysqlConnection();
        $this->database_conneciton = $this->database_conneciton->connect();
    }

    public function select($table = "", array $fields, string $where = "", string $order_by = "")
    {
        $field_names = "*";
        if (!empty($fields)) {
            global $field_names;
            $field_names = implode(',', $fields);
        }

        $where_clause = '';
        if (!empty($where)) {
            global $where_clause;
            $where_clause = $where;
        }

        $order_by_clause = '';
        if (!empty($order_by)) {
            global $order_by_clause;
            $order_by_clause = $order_by;
        }
        $sql = "SELECT $field_names FROM $table".$where_clause.$order_by_clause;
        $query = $this->database_conneciton->prepare($sql);
        foreach ($fields as $value) {
            $query->bindValue(":$value", $value);
        }
        $query->execute();
        return $result = $query->fetchAll(\PDO::FETCH_OBJ);

    }

    public function query($query)
    {
        $query = $this->database_conneciton->prepare($query);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_OBJ);
    }


    public function insert($table, array $data)
    {

        $field_names = implode(',', array_keys($data));
        $field_binders = ':' . implode(', :', array_keys($data));

        $query = $this->database_conneciton->prepare("INSERT INTO $table ($field_names) VALUES ($field_binders)");

        foreach ($data as $key => $value) {
            $query->bindValue(":$key", $value);
        }

        $result = $query->execute();

        if ($result) {
            return $this->database_conneciton->lastInsertId();
        } else {
            return false;
        }
    }

    public function update($table, $data, $where)
    {

        $fieldDetails = NULL;
        foreach($data as $key=> $value) {
            $fieldDetails .= "$key=:$key,";
        }
        $fieldDetails = rtrim($fieldDetails, ',');

        $sql = "UPDATE $table SET $fieldDetails WHERE $where";
        $query = $this->database_conneciton->prepare($sql);

        foreach ($data as $key => $value) {
            $query->bindValue(":$key", $value);
        }

        $result = $query->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $where)
    {
        return $this->database_conneciton->exec("DELETE FROM $table WHERE $where");
    }
}
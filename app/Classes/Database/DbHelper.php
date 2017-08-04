<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/3/17
 * Time: 12:38 PM
 */

namespace Classes\Database;
use Classes\ErrorMessage\ErrorMessage;

require_once "../../../vendor/autoload.php";

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


    public function select($query)
    {
        
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
            return true;
        } else {
            return false;
        }
    }

    public function update($query)
    {

    }

    public function delete($query)
    {

    }
}
<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/3/17
 * Time: 12:40 PM
 */

namespace Classes\Database;


class MysqlConnection implements DatabaseConnection
{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "root";
    private $db_name = "mystory";

    public function connect(DatabaseConnection $connection)
    {

    }
}
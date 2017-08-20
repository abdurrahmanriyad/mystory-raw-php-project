<?php

class db{

    private $dbhost = "localhost";
    private $dbname = "api_easytiffin";
    private $dbuser = "root";
    private $dbpass = "root";

    /**
     * connect to db
     * @return PDO
     */

    public function connect() {
        try {
            $mysql_con_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
            $db_connection = new PDO($mysql_con_str, $this->dbuser, $this->dbpass);
            $db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db_connection;
        } catch(PDOException $e){
            echo "Connection Error: " . $e->getMessage();
        }
        return "";
    }
}
<?php
require_once 'db.php';
class Dbfunctions{
    private $dbconnection = '';

    function __construct(){
        $db = new db();
        $this->dbconnection = $db->connect();
    }

    /**
     * create student
     * @param $name
     * @param $father_name
     * @param $mother_name
     * @param $mobile
     * @param $address
     * @param $username
     * @param $pass
     * @return array|bool
     */
    public function createStudent($name, $father_name, $mother_name, $mobile, $address, $username, $pass) {

        if($this->dbconnection) {
            try {
                $apiKey = $this->generateApiKey();
                $sql = "INSERT INTO student
                        (name, father_name, mother_name, mobile, address, username, password, apikey)
                         VALUES
                        (:name, :father_name, :mother_name, :mobile, :address, :username, :pass, :apikey)";
                $stmt = $this->dbconnection->prepare($sql);

                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':father_name', $father_name);
                $stmt->bindParam(':mother_name', $mother_name);
                $stmt->bindParam(':mobile', $mobile);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':pass', $pass);
                $stmt->bindParam(':apikey', $apiKey);
                if($stmt->execute()) {
                    $id = $this->dbconnection->lastInsertId();
                    $stmt = $this->dbconnection->prepare("SELECT * FROM student WHERE id = :id");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } else {
                    return false;
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
        return false;
    }

    /**
     * login user by email and password
     * @param $email
     * @param $pass
     * @return bool|mixed
     */
    public function getUserByEmailAndPassword($email, $pass) {
        if($this->dbconnection) {
            try {
                $sql = "SELECT * FROM user WHERE email = :email AND password = :password";
                $stmt = $this->dbconnection->prepare($sql);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $pass);
                if($stmt->execute()){
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }
                else {
                    return false;
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        return false;

    }


    /**
     * update single user
     * @param $id
     * @param $name
     * @return bool|mixed
     */
    public function updateUser($id, $name){
        if($this->dbconnection) {
            try {
                $sql = "UPDATE user SET name = :name WHERE id = :id";
                $stmt = $this->dbconnection->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":name", $name);
                if($stmt->execute()){
                    $stmt = $this->dbconnection->prepare("SELECT * FROM user WHERE id = :id");
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    return $stmt->fetch(PDO::FETCH_ASSOC);
                }
                else {
                    return false;
                }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteUser($id){
        if($this->dbconnection) {
            try {

                $sql = "DELETE FROM user WHERE id = :id";
                $stmt = $this->dbconnection->prepare($sql);
                $stmt->bindParam(":id", $id);
                return $stmt->execute();

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }

        return false;
    }


    /**
     * @return string
     */
    private function generateApiKey() {
        return md5(uniqid(rand(), true));
    }

    /**
     * @param $api_key
     * @return bool
     */
    public function isValidApiKey($api_key) {
        $stmt = $this->dbconnection->prepare("SELECT id from user WHERE apikey = :apikey");
        $stmt->bindParam("apikey", $api_key);
        $stmt->execute();
        $num_rows = $stmt->rowCount();
        return $num_rows > 0;
    }

    /**
     * @param $api_key
     * @return mixed|null
     */
    public function getUserId($api_key) {
        $stmt = $this->dbconnection->prepare("SELECT id FROM user WHERE apikey = :apikey");
        $stmt->bindParam("apikey", $api_key);
        if ($stmt->execute()) {
            $user_id = $stmt->fetch(PDO::FETCH_ASSOC);
            return $user_id;
        } else {
            return NULL;
        }
    }


    /**
     * @param $table
     * @return array|null
     */
    public function getAll($table) {
        $stmt = $this->dbconnection->prepare("SELECT * FROM ".$table);
        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return NULL;
        }
    }

    public function get($query) {
        $stmt = $this->dbconnection->prepare($query);
        if ($stmt->execute()) {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } else {
            return NULL;
        }
    }

}
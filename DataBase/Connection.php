<?php
namespace DataBase;
use PDO;

include('../config.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

Class Connection {

    private $servername = DBHOST;
    private $username = DBUSER;
    private $password = DBPWD;
    private $dbname = DBNAME;
    protected $con;

       public function openConnection()
    {
        try
        {
            $this->con = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->con;
        } catch (PDOException $e)
        {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public function all($model,$limit,$addition){
        $table = $model->getTable();
        if($limit == ""){
            $sql ="SELECT * FROM $table $addition";
        }else {
            $sql ="SELECT * FROM $table limit $limit $addition";
        }

        $stmt = $this->openConnection()->query($sql);
        $users = array();
        while ($user = $stmt->fetchObject(get_class($model))) {

            $users[] = $user;
        }
        return $users;
    }

    public function closeConnection() {
        $this->con = null;
    }

    public function getWEREData($model,$sql) {

        $stmt = $this->openConnection()->query($sql);
        $users = array();
        while ($user = $stmt->fetchObject(get_class($model))) {

            $users[] = $user;
        }
        if(count($users) > 1){
            return $users;
        }else if(count($users) == 1){
            return $users[0];
        }else  return null;
    }
    public function deleteData($sql, $data)
    {
        $del = $this->openConnection()->prepare($sql);
        $del->execute($data);
        $this->closeConnection();
        return true;

    }

    public function saveData($sql, $data)
    {
        $this->openConnection()->prepare($sql)->execute($data);
        $lastid= $this->con->lastInsertId();
        $this->closeConnection();
        return $lastid;

    }

    public function getTableNames($table){
        $q = $this->openConnection()->query("DESCRIBE $table");
        return $q->fetchAll(PDO::FETCH_COLUMN);
    }
}

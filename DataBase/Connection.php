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

       protected function openConnection()
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
    public function all($model){
        $table = $model->getTable();
        $sql ="SELECT * FROM $table";
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
        }else  trigger_error("Nothing found in table check sql query".$sql, E_USER_ERROR);
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

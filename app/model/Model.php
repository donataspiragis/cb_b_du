<?php
namespace App\Model;

use DataBase\Connection;
use Carbon\Carbon;

class Model {
    protected $db;
    public static $carb;

    public function __construct()
    {
        $this->db = new Connection();
    }

    public static function carbonTime(){
        self::$carb = Carbon::now()->setTimezone('Europe/Vilnius');
        return self::$carb;
    }

    public function getData($string){
        $data = [];
        foreach ($this->db->openConnection()->query($string) as $row) {
            $data[] = $row;
        }
        $this->db->closeConnection();
        return $data;
    }
}




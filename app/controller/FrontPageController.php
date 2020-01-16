<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use DataBase\Connection;

class FrontPageController extends BaseController  {
    public function index(){
        $raw = (new Connection)->getData("SELECT * FROM courses limit 6");
        $discounted =  (new Connection)->getData("SELECT * FROM courses limit 1");
        return $this->render('index', ['courses' => $raw, 'discount' => $discounted]);
    }


}


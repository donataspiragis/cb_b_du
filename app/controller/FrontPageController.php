<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use DataBase\Connection;
use App\Model\Course;
use App\Model\Offer;

class FrontPageController extends BaseController  {
    public function index(){;
        $raw = Course::getAll(6);
        $offer = Offer::getWere('course_id=2' );
        $discounted = Course::getAll(1);
        $all = Offer::getAll();
        return $this->render('index', ['courses' => $raw, 'offer' => $offer, 'discount' => $discounted, 'all' => $all]);
    }
    public function showall(){
        $raw = (new Connection)->getData("SELECT * FROM courses");
        $offer = (new Connection)->getData("SELECT * FROM offer WHERE course_id=2");
        $discounted =  (new Connection)->getData("SELECT * FROM courses limit 1");
        return $this->render('index', ['courses' => $raw, 'discount' => $discounted, 'offer' => $offer]);
    }


}

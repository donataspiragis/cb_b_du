<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use DataBase\Connection;
use App\Model\Course;
use App\Model\Offer;

class FrontPageController extends BaseController  {
    public function index(){
        $raw = Course::getAll(6);
        $offer = Offer::getWere('course_id=2' );
        $discounted = Course::getWere('id=2');
        $all = Offer::getAll();
        $time = Carbon::now();
        return $this->render('index', ['courses' => $raw, 'offer' => $offer, 'discount' => $discounted, 'all' => $all, 'time'=>$time]);
    }
    public function showall(){
        $raw = Course::getAll();
        $offer = Offer::getWere('course_id=2' );
        $discounted = Course::getWere('id=2');
        $all = Offer::getAll();
        $time = Carbon::now();
        return $this->render('index', ['courses' => $raw, 'offer' => $offer, 'discount' => $discounted, 'all' => $all, 'time'=>$time]);
    }


}

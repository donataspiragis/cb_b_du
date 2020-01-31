<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Model;
use App\Model\Lecture;
use App\Model\LecturesList;
use App\Model\Order;
use App\Model\User;
use App\Model\Course;

use function Composer\Autoload\includeFile;

class LectureController extends BaseController  {
    private $courses=[];
    private $allcourses = [];
    public function index($id){
    }
    function cmp($a, $b) {
       // echo $a->order;
        return strcmp($a->order, $b->order);
    }

    public function show($course_id){
        
        $bool = false;
        session_start();
        if($_SESSION['userId'] != null){
            $userid = $_SESSION['userId'];
            $us = User::getWere('ID = ' . $userid);
            $user_email = $us->email;
        }else{
            header("Location: ".App::INSTALL_FOLDER);
            exit();
        }
        
        $orders = Order::getWere("user_id = $userid");
        if(is_object($orders)){
            if($orders->course_id == $course_id && $orders->payment_status == 1){
                $bool = true;
            }
        }else{
            foreach($orders as $value){
                if($value->course_id == $course_id && $value->payment_status == 1){
                    $bool = true;
                }
            }
        }
        $lectlist = LecturesList::getWere("course_id = $course_id");
            if(is_array($lectlist)){
                foreach ($lectlist as $key =>$value){
                    $lecture[] = Lecture::getWere("ID = $value->lecture_id");
                    $lecture[$key]->order = $value->order_num;
                }
            }else{
                $lecture[0] = Lecture::getWere("ID = $lectlist->lecture_id");
                $lecture[0]->order = $lectlist->order_num;
            }
            usort($lecture, array($this, "cmp"));
            $this->getCourses($userid);
        if($bool){         
            return $this->render('lecturesview',['lectures' => $lecture,'data' => $this->courses,'allcourse' => $this->allcourses,'value'=>"id$course_id",'menu'=>'collapseTwo']);
        }else{
            return $this->render('lockLecturesview',['lectures' => $lecture,'email' =>  $user_email,'course_id'=>$course_id,'menu'=>'collapseTwo','value'=>"id$course_id",'data' => $this->courses,'allcourse' => $this->allcourses]);
        }
    }
    private function getCourses($id){
        $coursesarr ="";
       $allcourse=[];
        $boughtAny = false;
        $orders = Order::getWere("user_id = $id");
        if(is_object($orders)){
            if($orders->payment_status == 1){
            $this->courses[] = Course::getWere("ID = $orders->course_id");
            $coursesarr .= "ID <> '$orders->course_id'";
            $boughtAny = true;
            }else{
                $allcourse = Course::getAll();
            }
            
           
        }else{
            foreach ($orders as $order){
                if($order->payment_status == 1){
                    $this->courses[] = Course::getWere("ID = $order->course_id");
                    $coursesarr .= "AND ID <> '$order->course_id'";
                    $boughtAny = true;
                    }else{
                        $this->allcourse = Course::getAll();
                    }

                
            }
            $coursesarr = substr($coursesarr,3);
        }
        if($boughtAny){
            $allcourse = Course::getWere($coursesarr);
        }
        
        if(is_object($allcourse)){
            $this->allcourses[] = $allcourse;
        }else{
            $this->allcourses = $allcourse;
        }
    }
}


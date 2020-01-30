<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Model;
use App\Model\Lecture;
use App\Model\LecturesList;
use App\Model\Order;

use function Composer\Autoload\includeFile;

class LectureController extends BaseController  {
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
        }else{
            header("Location: ".App::INSTALL_FOLDER);
            exit();
        }
        
        $orders = Order::getWere("user_id = $userid");
        if(is_object($orders)){
            if($orders->course_id == $course_id){
                $bool = true;
            }
        }else{
            foreach($orders as $value){
                if($value->course_id == $course_id){
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
        if($bool){         
            return $this->render('lecturesview',['lectures' => $lecture]);
        }else{
            return $this->render('lockLecturesview',['lectures' => $lecture]);
        }
    }
}


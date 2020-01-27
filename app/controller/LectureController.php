<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Model;
use App\Model\Lecture;
use App\Model\LecturesList;

use function Composer\Autoload\includeFile;

class LectureController extends BaseController  {
    public function index($id){
    }
    function cmp($a, $b) {
        echo $a->order;
        return strcmp($a->order, $b->order);
    }

    public function show($id){
        $lectlist = LecturesList::getWere("course_id = $id");
        if(is_array($lectlist)){
            foreach ($lectlist as $key =>$value){
                $lecture[] = Lecture::getWere("ID = $value->lecture_id");
                $lecture[$key]->order = $value->order;
            }
        }else{
            $lecture[0] = Lecture::getWere("ID = $lectlist->lecture_id");
            $lecture[0]->order = $lectlist->order;
        }
        usort($lecture, array($this, "cmp"));
        return $this->render('lecturesview',['lectures' => $lecture]);

    }
}


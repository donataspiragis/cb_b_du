<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Model;
use App\Model\Lecture;
use App\Model\Lecturelist;
use function Composer\Autoload\includeFile;

class LectureController extends BaseController  {
    public function index($id){
    }
public function show($id){

        $lectlist = Lecturelist::getWere("course_id = '$id'");
        if(is_array($lectlist)){
            foreach ($lectlist as $value){
                $lecture[] = Lecture::getWere("ID = '$value->lecture_id'");
            }
        }else{
            $lecture[] = Lecture::getWere("ID = '$lectlist->lecture_id'");
        }


        return $this->render('lecturesview',['lectures' => $lecture]);

    }
}


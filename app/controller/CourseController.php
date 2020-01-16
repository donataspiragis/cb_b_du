<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class CourseController extends BaseController  {
    public function index(){
    }
    public function create(){
        //this one will be changed in service
        $videosService=new LectureController;
        $videoList=$videosService->getVideos();
        return $this->render('newcourseformlayout',['lecture' =>$videoList]);

    }


}


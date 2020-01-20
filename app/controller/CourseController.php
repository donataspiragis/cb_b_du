<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;

class CourseController extends BaseController  {
    public function index(){
    }
    public function create()
    {
        $videosService = new \App\services\GetVideosUrl;
        $videoList = $videosService->getVideos();
        $new_course_form = new \App\Objects\NewCourseForm();
        return $this->render('backlayout', ['lecture' => $videoList, 'newcourseform' => $new_course_form->getData()]);
    }
    public function store() {
        var_dump($_POST);
    }


}

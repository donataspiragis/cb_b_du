<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Course;
use App\Model\Lecture;

class CourseController extends BaseController  {
    public function index(){
    }
    public function create()
    {
        if (!empty($_POST)) {
            print '<pre>';
            print_r($_POST);
//            die();

            $omg = new Course();
        }
        $videosService = new \App\services\GetVideosUrl;
        $videoList = $videosService->getVideos();
        $new_course_form = new \App\Objects\NewCourseForm();
        $new_course_form->addCheckboxInputs('videos', $videoList);
        $form_data = $new_course_form->render('newcourseformlayout', $new_course_form->getData());

        return $this->render('backlayout', ['newCourseForm' => $form_data]);
    }
    public function store() {
        die($_POST);
    }


}

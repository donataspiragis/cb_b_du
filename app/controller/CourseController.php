<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use App\Model\LecturesList;
use App\Model\Order;
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

            $videos = [];
            foreach ($_POST['videos_list'] as $video_info) {
                if (!empty($video_info['url']) && !empty($video_info['order'])) {
                    $videos[] = $video_info;
                }
            }

            $new_course = new Course();
            $new_course->name=$_POST['course_name'] ?? 'incognito';
            $new_course->about=$_POST['course_description'] ?? 'no description';
            $new_course->status=$_POST['is_active'] ?? '';
            $new_course->picture=$_POST['cover_photo'] ?? 'example_photo.jpg';
            $new_course->save();


            foreach ($videos as $video) {
                $lecture = new Lecture();
                $lecture->video_url = $video['url'];
                $lecture->save();

                $in_order = new LecturesList();
                $in_order->lecture_id = $lecture->ID;
                var_dump($lecture->ID);
                $in_order->order_num = $video['order'];
                var_dump($video['order']);
                $in_order->course_id = $new_course->ID;
                var_dump($new_course->ID);
                $in_order->save();
            }
        }

        $videosService = new \App\services\GetVideosUrl;
        $videoList = $videosService->getVideos();
        $new_course_form = new \App\Objects\NewCourseForm();
        $new_course_form->addCheckboxInputs('videos_list', $videoList);
        $form_data = $new_course_form->render('newcourseformlayout', $new_course_form->getData());

        return $this->render('backlayout', ['newCourseForm' => $form_data]);
    }
    public function store() {
        die($_POST);
    }


}

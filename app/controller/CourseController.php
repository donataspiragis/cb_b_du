<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use App\Model\LecturesList;
use App\Model\Order;
use App\Model\User;
use App\Objects\NewCourseForm;
use DataBase\Connection;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Course;
use App\Model\Lecture;
use App\Model\Offer;

class CourseController extends BaseController  {

    public function create() {
        $new_course_form = new \App\Objects\NewCourseForm('post', 'course/store');
        $new_course_form->fillWithRandomValues();

        $form_data = $new_course_form->render('newcourseformlayout', $new_course_form->getData());

        return $this->render('createcourse', ['newCourseForm' => $form_data]);
    }

    public function store() {
        if (!empty($_POST)) {
            $this->sendToDb();
            header("Location: " . App::INSTALL_FOLDER . '/course/display');
            exit();
        }
    }

    public function edit($id) {
        $edit_form = new NewCourseForm('post', 'course/update/' . $id);
        $edit_form->fillWithValuesFromDb($id);

        $form_data = $edit_form->render('newcourseformlayout', $edit_form->getData());

        return $this->render('createcourse', ['newCourseForm' => $form_data]);
    }

    public function update($course_id) {
        if (!empty($_POST)) {

            $this->sendToDb($course_id);

            header("Location: " . App::INSTALL_FOLDER . '/course/display');
            exit();
        }
    }

    public function sendToDb($course_id = null) {
        if (Course::courseNameExists($_POST['course_name'])) {
            die("Course with a name '" . $_POST['course_name'] . "' already exists. Go back!");
        }

        $course = !$course_id ? new Course : Course::getWere("ID = $course_id");

        $course->name = $_POST['course_name'];
        $course->about = $_POST['course_description'] ?? 'no description';
        $course->status = $_POST['is_active'] ?? '';

        if ($course_id) {
            $file_name_from_db = $course->picture;
            $file_name_from_global_FILES = $_FILES['cover_photo']['name'] ?? '';
            $course->picture = !empty($file_name_from_global_FILES) ? $file_name_from_global_FILES : $file_name_from_db;
        } else {
            $course->picture = $_FILES['cover_photo']['name'] ?? 'default.png';
        }

        $course->save();

        $offer = !$course_id ? new Offer : Offer::getWere("ID = $course_id");

        $offer->price = $_POST['price'];
        $offer->valid_from = date('Y-m-d H:i');
        $offer->valid_to = $_POST['valid_to_date'] . ' ' . $_POST['valid_to_time'];
        $offer->discount_offer = $_POST['disprice'] ?? intval(0);
        $offer->course_id = !$course_id ? $course->ID : $course_id;
        $offer->save();

        if ($course_id && count(LecturesList::courseByIdExists($course_id)) > 0) {
            $lectures_list = LecturesList::getWere("course_id = $course_id");

            foreach ($lectures_list as $lecture_in_a_list) {
                $lecture_in_a_list->delete();
            }
        }

        $videos = [];
        foreach ($_POST['videos_list'] as $video_info) {
            if (!empty($video_info['url'])) {
                $videos[] = $video_info;
            }
        }

        foreach ($videos as $video) {
            $query = "video_url = " . $video['url'];

            if (count(Lecture::urlExists($video['url'])) > 0) {
                $lecture_id = (Lecture::getWere($query))->ID;
            } else {
                $lecture = new Lecture();
                $lecture->video_url = $video['url'];
                $lecture->save();

                $lecture_id = $lecture->ID;
            }

            $order = new LecturesList();
            $order->lecture_id = $lecture_id;
            $order->order_num = !empty($video['order']) ? $video['order'] : null;
            $order->course_id = !$course_id ? $course->ID : $course_id;
            $order->save();
        }

        save_file($_FILES['cover_photo']);
    }

    public function index() {

    }

    public function  display(){
        session_start();
        if($_SESSION['userId'] != null){
            $id = $_SESSION['userId'];
            $us = User::getWere('ID = ' . $id);
            $user_email = $us->email;
        }else{
            header("Location: ".App::INSTALL_FOLDER);
            exit();
        }
        $coursesarr ="";
        $courses=[];
        $allcourses = [];
        $orders = Order::getWere("user_id = $id");
        if(is_object($orders)){
            $courses[] = Course::getWere("ID = $orders->course_id");
            $coursesarr .= "ID <> '$orders->course_id'";
        }else{
            foreach ($orders as $order){
                $courses[] = Course::getWere("ID = $order->course_id");
                $coursesarr .= "AND ID <> '$order->course_id'";
            }
            $coursesarr = substr($coursesarr,3);
        }
        $allcourse = Course::getWere($coursesarr);
        if(is_object($allcourse)){
            $allcourses[] = $allcourse;
        }else{
            $allcourses = $allcourse;
        }
        return $this->render('currentCourses',['data' => $courses,'allcourse' => $allcourses, 'email' =>  $user_email]);
//      $email = 'ugnius.staniulis@gmail.com';
//        $mailchimp = App::get('mailchimp');
//        $mailchimp->create($email,'subscribed',array('FNAME' => 'Misha','LNAME' => 'Rudrastyh'));
    }


}


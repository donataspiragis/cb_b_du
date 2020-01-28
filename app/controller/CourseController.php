<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use App\Model\LecturesList;
use App\Model\Order;
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

    public function edit($id) {
        $edit_form = new NewCourseForm('post', 'course/update/' . $id);
        $edit_form->fillWithValuesFromDb($id);

        $form_data = $edit_form->render('newcourseformlayout', $edit_form->getData());

        return $this->render('createcourse', ['newCourseForm' => $form_data]);
    }

    public function store() {
        $success = 0;
        if (!empty($_POST)) {
//            print '<pre>';
//            print_r($_POST);
//            die();

            $videos = [];
            foreach ($_POST['videos_list'] as $video_info) {
                if (!empty($video_info['url'])) {
                    $videos[] = $video_info;
                }
            }
            
            $course = new Course();
            $course->name = $_POST['course_name'];
            $course->about = $_POST['course_description'] ?? 'no description';
            $course->status = $_POST['is_active'] ?? '';
            $course->picture = 'images/' . $_FILES['cover_photo']['name'] ?? '';
            $course->save();

            $offer = new Offer();
            $offer->price = $_POST['price'];
            $offer->valid_from = date('Y-m-d H:i');
            $offer->valid_to = $_POST['valid_to_date'] . ' ' . $_POST['valid_to_time'];
            $offer->discount_offer = $_POST['disprice'];
            $offer->course_id = $course->ID;
            $offer->save();

            foreach ($videos as $video) {
                $query = "video_url = " . $video['url'];
                if (count(Lecture::urlExists($video['url'])) > 0) {
                    $id = (Lecture::getWere($query))->ID;
                } else {
                    $lecture = new Lecture();
                    $lecture->video_url = $video['url'];
                    $lecture->save();
                    $id = $lecture->ID;
                }

                $order = new LecturesList();
                $order->lecture_id = $id;
                $order->order_num = !empty($video['order']) ? $video['order'] : null;
                $order->course_id = $course->ID;
                $order->save();
            }

            save_file($_FILES['cover_photo']);

            header("Location: " . App::INSTALL_FOLDER . '/course/display');
            exit();
        }
    }

    public function update($id)
    {
        if (!empty($_POST)) {
//            print '<pre>';
//            print_r($_POST);
//            die();

            $course_id =$id;// explode('/', $_SERVER['REQUEST_URI'])[3];

            $videos = [];
            foreach ($_POST['videos_list'] as $video_info) {
                if (!empty($video_info['url'])) {
                    $videos[] = $video_info;
                }
            }

            $new_course = Course::getWere("ID = $course_id");
            $new_course->name = $_POST['course_name'];
            $new_course->about = $_POST['course_description'] ?? 'no description';
            $new_course->status = $_POST['is_active'] ?? '';
            $new_course->picture = 'images/' . $_FILES['cover_photo']['name'] ?? '';
            $new_course->save();

            $new_offer = Offer::getWere("course_id = $course_id");
            $new_offer->price = $_POST['price'];
            $new_offer->valid_from = date('Y-m-d H:i');
            $new_offer->valid_to = $_POST['valid_to_date'] . ' ' . $_POST['valid_to_time'];
            $new_offer->discount_offer = $_POST['disprice'];
            $new_offer->course_id = $course_id;
            $new_offer->save();

            if (count(LecturesList::courseExists($course_id)) > 0) {
                $lectures_list = LecturesList::getWere("course_id = $course_id");

                if (is_array($lectures_list)) {
                    foreach ($lectures_list as $lecture_in_a_list) {
                        $lecture_in_a_list->delete();
                    }
                } else {
                    $lectures_list->delete();
                }
            }

            foreach ($videos as $video) {
                $query = "video_url = " . $video['url'];

                if (count(Lecture::urlExists($video['url'])) > 0) {
                    $id = (Lecture::getWere($query))->ID;
                } else {
                    $lecture = new Lecture();
                    $lecture->video_url = $video['url'];
                    $lecture->save();
                    $id = $lecture->ID;
                }

                $in_order = new LecturesList();
                $in_order->lecture_id = $id;
                $in_order->order_num = !empty($video['order']) ? $video['order'] : null;
                $in_order->course_id = $course_id;
                $in_order->save();
            }

            save_file($_FILES['cover_photo']);

            header("Location: " . App::INSTALL_FOLDER . '/course/display');
            exit();
        }
    }


    public function index() {

    }

   public function  display(){
        session_start();
        if($_SESSION['userId'] != null){
            $id = $_SESSION['userId'];
        }else{
            header("Location: ".App::INSTALL_FOLDER);
            exit();
        }
        $coursesarr ="";
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

                $allcourses = Course::getWere($coursesarr);





                return $this->render('currentCourses',['data' => $courses,'allcourse' => $allcourses]);

//      $email = 'ugnius.staniulis@gmail.com';
//        $mailchimp = App::get('mailchimp');
//        $mailchimp->create($email,'subscribed',array('FNAME' => 'Misha','LNAME' => 'Rudrastyh'));

  }


}


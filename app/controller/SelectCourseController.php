<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Course;


class SelectCourseController extends BaseController
{

    public function selectCourseForEditing()
    {
        $raw = Course::getAll(6);
        return $this->render('coursesForEditing', ['courses' => $raw]);

    }
}
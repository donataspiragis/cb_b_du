<?php

namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use App\Model\LecturesList;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Course;
use App\Model\Lecture;
use App\Model\User;

class StudentsInfoController extends BaseController
{
    public function collectinfo()
    {
        $raw = User::getAll();
        $raw1 = Course::getAll();
        return $this->render('studentsInfoTable', ['users' => $raw, 'coursename' => $raw1]);



    }




};
<?php


namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use DataBase\Connection;

class UserController
{
    public function register()
    {
        return $this->render('register');
    }
}
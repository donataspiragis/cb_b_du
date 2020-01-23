<?php


namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use App\services\UserService;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use DataBase\Connection;

class UserController
{
    public function register()
    {

        return $this->render('register');
    }
    public function store()
    {
        $user= new UserService();
//        $user->createUser($name='vardenis', $surname='pavardenis', $email='pastas123', $password='123');
        echo 'sukure';
        echo '<pre>';
        var_dump($user->createUser($name='vardenis', $surname='pavardenis', $email='pastas123', $password='123'));
    }
}
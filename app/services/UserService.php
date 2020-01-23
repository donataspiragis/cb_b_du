<?php


namespace App\services;


use App\Model\User;
use Carbon\Carbon;

class UserService
{
    public function createUser($name, $surname, $email, $password){
        $newUser= new User();
        $newUser->name=$name;
        $newUser->surname=$surname;
        $newUser->email=$email;
        $newUser->password=password_hash($password, PASSWORD_DEFAULT);
        //https://www.php.net/manual/en/function.password-hash.php read more this is just for now will be added salt or something similar
        $newUser->role=0;
        $newUser->created_on=Carbon::now();
        $newUser->  user_discount=20;
        $newUser->save();
        return $newUser;
    }

}
<?php


namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use App\Model\User;
use App\services\PasswordValidator;
use App\services\UserService;


session_start();

class UserController extends BaseController
{
    public function register()
    {
        if($_POST==null){
            return $this->render('register',  []);
        }
        else{
            if($_POST['name']==null ||$_POST['surname']==null ||$_POST['email']==null||$_POST['password']==null){
                if($_POST['name']!=null) {
                    $data['nameValue']=$_POST['name'];
                }
                if($_POST['surname']!=null){
                    $data['surnameValue']=$_POST['surname'];
                }
                if($_POST['email']!=null) {
                    $data['emailValue']=$_POST['email'];
                }
                return $this->render('register',  ['data' => $data]);
            }
            else{
                $email=$_POST['email'];
                $user=User::getAll();
                foreach ($user as $u) {
                    if($u->email==$email) {
                        $data['emailValue']=$email.' - šis paštas jau užregistruotas';
                        return $this->render('register',  ['data' => $data]);
                    }
                }
                $password=$_POST['password'];
                $password2=$_POST['password2'];
                if($password!=$password2){
                    $data['nameValue']=$_POST['name'];
                    $data['surnameValue']=$_POST['surname'];
                    $data['emailValue']=$_POST['email'];
                    $data['password']='slaptažodžiai nesutampa';
                    return $this->render('register',  ['data' => $data]);
                }
                $name=$_POST['name'];
                $surname=$_POST['surname'];
                $this->store($email, $name, $surname, $password);
            }
        }
    }

    public function store($email, $name, $surname, $password)
    {
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
        $_SESSION['userId'] =  $newUser->ID;
        header("Location: ". App::INSTALL_FOLDER."/course/display");
    }

    public function login(){
        $email=$_POST['email'];
        $password=$_POST['password'];
        $user= User::getWere("email=$email");
        $pass=$user->password;

        if (password_verify($password, $pass)) {
            $_SESSION['userId'] = $user->ID;
            if($user->role==0){
                header("Location: ". App::INSTALL_FOLDER."/course/display");
                exit();
            }
            if($user->role==1){
                header("Location: ". App::INSTALL_FOLDER."/course/create");
                exit();
            }

        } else {
            header("Location: ". App::INSTALL_FOLDER);
            exit();
        }
    }
    public function logout(){
        $_SESSION['userId'] = null;
        header("Location: ". App::INSTALL_FOLDER);
        exit();
    }
}
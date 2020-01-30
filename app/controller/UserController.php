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
        if($_SESSION['temp']!=true){
            header("Location: ". App::INSTALL_FOLDER);
            exit();
        }
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
                    if($u->email==$email && $u->ID!=$_SESSION['userId']) {
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

    public function registerNew($hash)
    {
        $user=User::getAll();
        foreach ($user as $tempUser) {
            $password=str_replace('/','',$tempUser->password);
            if($password==$hash && $tempUser->name=='laikinas') {
                $_SESSION['userId'] =  $tempUser->ID;
                $_SESSION['temp'] = true;
                return $this->render('register',  []);
                    }
        }
        header("Location: ". App::INSTALL_FOLDER);
        exit();
    }

    public function store($email, $name, $surname, $password)
    {
        $newUser= new User();
        $newUser->name=$name;
        $newUser->surname=$surname;
        $newUser->email=$email;
        $newUser->password=password_hash($password, PASSWORD_DEFAULT);
        $newUser->role=0;
        $newUser->created_on=Carbon::now();
        $newUser->  user_discount=20;
        $newUser->ID=$_SESSION['userId'];
        $newUser->save();
        header("Location: ". App::INSTALL_FOLDER."/course/display");
        exit();
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

    public function changePassword(){
        if($_SESSION['userId']!=null){
            $user=User::getWere("ID=".$_SESSION['userId']);
            return $this->render('changePassword');

        }
        else{
            header("Location: ". App::INSTALL_FOLDER);
            exit();
        }
    }
    public function passwordStore(){
        $password=$_POST['newPassword'];
        $password2=$_POST['newPassword2'];
        if($password!=$password2){
            return $this->render('changePassword');
        }
        if($password==$password2){
            $user=User::getWere("ID=".$_SESSION['userId']);
            $user->password=password_hash($password, PASSWORD_DEFAULT);
            $user->save();
            header("Location: ". App::INSTALL_FOLDER."/course/display");
            exit();
        }
    }
    public function passwordReminder(){
        $email=$_POST['email2'];
        $user= User::getWere("email=$email");
        $user->	password_reminder= bin2hex(random_bytes(16));
        $user->save();
        $link='http://localhost'.App::INSTALL_FOLDER."/user/passwordForget/". $user->password_reminder;
        echo "<a href=$link>$link</a>";

    }
    public function passwordReminderChangePassword($hash){
        $user= User::getWere("password_reminder=$hash");
        $_SESSION['userId'] = $user->ID;
        $this->changePassword();
    }
}
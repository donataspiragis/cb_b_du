<?php
namespace App\Controller;
use App\App;
use App\Controller\BaseController;
use App\Model\Buyall;
use App\Model\Course;
use App\Model\Invoice;
use App\Model\Offer;
use App\Model\Order;
use App\Model\User;
use App\Services\WebToPay;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;
use App\Services\Paysera;

class OrderController extends BaseController  {
    public function index(){

    }

    public function statistics(){
        $all = Invoice::getAll();
        $nowtime =Carbon::now();
        $amount = ["thisYear"=>0,"thisMonth"=>0,"thisQuarter"=>0,"halfYear"=>0];

        foreach ($all as $alls){
            if(substr($alls->created_on, 0, 4) == $nowtime->year){
                $amount["thisYear"] += $alls->price;
                if(substr($alls->created_on, 5, 2) == $nowtime->month){
                    $amount["thisMonth"] += $alls->price;
                }
            }

            if(in_array(substr($alls->created_on, 0, 7), $this->monthsBack(3))){
                $amount["thisQuarter"] += $alls->price;
            }
            if(in_array(substr($alls->created_on, 0, 7), $this->monthsBack(6))){
                $amount["halfYear"] += $alls->price;
            }


        }
        return $this->render('statistics', ['all' => $all,'amount' => $amount,'value'=>"apyvarta",'menu'=>'collapseOne']);
    }
    private function monthsBack($backamount){
        $array = [];
        $nowtime = Carbon::now();

        for($i = 0; $i < $backamount; $i++){
            if($nowtime->month < 10){
                $array[]= $nowtime->year."-0".$nowtime->month;
            }else{
                $array[]= $nowtime->year."-".$nowtime->month;
            }

            if($nowtime->month  == 1){
                $nowtime->year -= 1;
                $nowtime->month = 12;
            }else{
                $nowtime->month -= 1;
            }

        }
        return $array;
    }

    public function createall(){

<<<<<<< Updated upstream
        return $this->render('createall');
=======
         return $this->render('createall',['value'=>'buyall']);
>>>>>>> Stashed changes
    }

    public function createallsave($id){

        $all = Buyall::getWere('ID = 1 ');
        $all->name = $_POST['name'];
        $all->price = $_POST['price'];
        $all->description = $_POST['description'];
        $all->save();
        header("Location: ". App::INSTALL_FOLDER."/order/statistics");
    }

    public function buyallview(){
        $all = Buyall::getWere('ID = 1');
        $info = '';
        return $this->render('buyall', ['info' => $info, 'all' => $all]);
    }

    public function buyall($id){
        $email = $_POST['email'];
        $user=User::getAll();
        foreach ($user as $u) {
            if($u->email == $email) {
                $info = 'Planavai pirkti viską bet pasiūlymas galioja tik naujiems vartotojams!';
                return $this->render('buyall', ['info'=>$info]);
            }
        }

        $amount_obj = Offer::getAll();
        $alltable= Buyall::getWere('ID = 1');


        $newUser= new User();
        $newUser->name='laikinas';
        $newUser->surname='laikinas';
        $newUser->password=password_hash(rand(1,100), PASSWORD_DEFAULT);
        $newUser->role=0;
        $newUser->email = $email;
        $newUser->created_on=Carbon::now();
        $newUser->user_discount=20;
        $newUser->save();

        $invoice = new Invoice();
        $invoice->price = $alltable->price * 100;
        $invoice->created_on = Carbon::now();
        $invoice->save();

        $courses=Course::getAll();
        if(is_object($courses)){
            $order = new Order();
            $order->user_id = $newUser->ID;
            $offer= Offer::getWere('course_id = ' . $courses->ID  );
            $order->offer_id = $offer->ID;
            $order->course_id = $courses->ID;
            $order->invoice_id = $invoice->ID;
            $order->payment_status=0;
            $order->save();
        } else {
        foreach ($courses as $course) {
            $order = new Order();
            $order->user_id = $newUser->ID;
            $offer= Offer::getWere('course_id = ' . $course->ID  );
            $order->offer_id = $offer->ID;
            $order->course_id = $course->ID;
            $order->invoice_id = $invoice->ID;
            $order->payment_status=0;
            $order->save();
        }
        }

        $amount = $invoice->price;
        $order_id_paysera = $order->ID . 'NOKOALL';
        $servisas = App::get('paysera');
        $servisas->pay($email, $amount, $order_id_paysera);
    }

    public function payexisting(){
        $email = $_POST['email'];
        $c_id = $_POST['id'];
        $amount_obj = Offer::getWere('course_id =' . $c_id );
        $amount = $amount_obj->price;
        $amount = ($amount * 100) * 0.8;

        $user=User::getWere('email = ' .$email);

        $invoice = new Invoice();
        $invoice->price = $amount / 100;
        $invoice->created_on = Carbon::now();
        $invoice->save();

        $order = new Order();
        $order->user_id = $user->ID;
        $offer= Offer::getWere('course_id = ' . $c_id  );
        $order->offer_id = $offer->ID;
        $order->course_id = $c_id ;
        $order->invoice_id = $invoice->ID;
        $order->payment_status=0;
        $order->save();

        $ino = $invoice->ID;
        $servisas = App::get('paysera');

        $order_id_paysera = $order->ID . 'OKOO';
        $servisas->pay($email, $amount, $order_id_paysera);
    }

    public function payload($id){
        $offer = Course::getWere('ID=' . $id );
        return $this->render('pay', ['id' => $id, 'offer' => $offer]);
    }

    public function d_payload($id){
        $offer = Course::getWere('ID=' . $id );
        return $this->render('payD', ['id' => $id, 'offer' => $offer]);

    }

    public function checkPrePayment($id){
        $email = $_POST['email'];
        $old = $_POST['old'];
        $amount_obj = Offer::getWere('course_id =' . $id);
        $user=User::getAll();

        foreach ($user as $u) {
            if($u->email == $email) {
                if($old == 'disc'){
                    $amount =  $amount_obj->discount_offer * 100;
                    return self::paid($id, 1, $email, $amount);
                } else {
                    $amount =  $amount_obj->price * 100;
                    return self::paid($id, 1, $email, $amount);
                }
            }
        }

        if($old == 'disc'){
            $amount =  $amount_obj->discount_offer * 100;
            return self::paid($id, 0, $email, $amount);
        } else {
            $amount =  $amount_obj->price * 100;
            return self::paid($id, 0, $email, $amount);
        }

    }

    public function paid ($id, $status, $email, $amount){

        if($status == 0) {
            $newUser= new User();
            $newUser->name='laikinas';
            $newUser->surname='laikinas';
            $newUser->password=password_hash(rand(1,100), PASSWORD_DEFAULT);
            $newUser->role=0;
            $newUser->email = $email;
            $newUser->created_on=Carbon::now();
            $newUser->user_discount=20;
            $newUser->save();

            $invoice = new Invoice();
            $invoice->price = $amount / 100;
            $invoice->created_on = Carbon::now();
            $invoice->save();

            $order = new Order();
            $order->user_id = $newUser->ID;
            $offer= Offer::getWere('course_id = ' . $id );
            $order->offer_id = $offer->ID;
            $order->course_id = $id;
            $order->invoice_id = $invoice->ID;
            $order->payment_status=0;
            $order->save();

            $order_id_paysera = $order->ID . 'NOKO';
        }
        else {
            $user=User::getWere('email = ' .$email);

            $invoice = new Invoice();
            $invoice->price = $amount / 100;
            $invoice->created_on = Carbon::now();
            $invoice->save();

            $order = new Order();
            $order->user_id = $user->ID;
            $offer= Offer::getWere('course_id = ' . $id );
            $order->offer_id = $offer->ID;
            $order->course_id = $id;
            $order->invoice_id = $invoice->ID;
            $order->payment_status=0;
            $order->save();

            $order_id_paysera = $order->ID . 'OKOO';
        }


        $servisas = App::get('paysera');
        $servisas->pay($email, $amount, $order_id_paysera);
    }


    public function answer($data) {

        $info = WebToPay::checkResponse($_GET, ['projectid' => 146155, 'sign_password' => 'ce28c97dcd8381b7d5a093ffd1deae38']);

        $newold = substr($info['orderid'], -4);
        $user = User::getWere('email = ' . $info['p_email'] );
        $order = Order::getWere('ID = ' . $info['orderid']);

        if($info['status'] == "1")
        {
            $hash = $user->password;
            $hash = str_replace('/', '', $hash);
            $hash = $user->password;
            $hash = str_replace('/', '', $hash);

            if($newold == 'NOKO'){
                $order->payment_status = 1;
                $order->save();
                header("Location: " . App::INSTALL_FOLDER. "/user/registerNew/" . $hash );

            }
            else if ($newold == 'OKOO'){
                $order->payment_status = 1;
                $order->save();
                header("Location: " . App::INSTALL_FOLDER. "/course/display/" );
            } else if($newold = 'NOKOALL'){
                $orders = Order::getWere('user_id = '. $user->ID );
                if(is_object($orders)) {
                    $orders->payment_status = 1;
                    $orders->save();
                } else {

                foreach ($orders as $order) {
                    $order->payment_status = 1;
                    $order->save();
                }
                }

                header("Location: " . App::INSTALL_FOLDER. "/user/registerNew/" . $hash );
            }



        }
        else {
            $status = "Laukiame mokėjimo patvirtinimo ir išsiuntėme Jums prisijungimą";
            return $this->render('waiting', ['info' => $status]);
        }

    }

    public function cancelPaysera() {
        return $this->render('canceled');
    }

    public function callbackpaysera($data) {
        return $this->render('callbackpaysera');
    }

}


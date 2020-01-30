<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
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
        return $this->render('statistics', ['all' => $all,'amount' => $amount]);
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

    public function payload($id){
        $offer = Course::getWere('ID=' . $id );
        return $this->render('pay', ['id' => $id, 'offer' => $offer]);

    }
    public function checkPrePayment($id){
        $email = $_POST['email'];
        $user=User::getAll();
        foreach ($user as $u) {
            if($u->email == $email) {
                return self::paid($id, 1, $email);
            }
        }
        return self::paid($id, 0, $email);
    }

    public function paid ($id, $status, $email){
        $amount_obj = Offer::getWere('course_id =' . $id);
        $amount = 0;
        if($amount_obj->discount_offer > 0) {
            $amount = $amount_obj->discount_offer;
        }
        else {
            $amount = $amount_obj->price;
        }
        $amount = $amount * 100;


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

        }
        else {
            $user=User::getWere('email = ' .$email);

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

        }


        $servisas = App::get('paysera');

        $servisas->pay($email, $amount);
    }


    public function answer($data) {

        $info = WebToPay::checkResponse($_GET, ['projectid' => 146155, 'sign_password' => 'ce28c97dcd8381b7d5a093ffd1deae38']);

        if($info['status'] == "1")
        {
            $user=User::getWere('email = ' . $info['p_email'] );
            $user->payment_status = 1;
            $hash = $user->password;
            $hash = str_replace('/', '', $hash);
           header("Location: " . App::INSTALL_FOLDER. "/user/registerNew/" . $hash );
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


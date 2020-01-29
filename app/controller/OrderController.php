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
        $invoices = Invoice::getAll();
        $orders = Order::getAll();

        var_dump('<br>');
        var_dump('<br>');var_dump('<br>');var_dump('<br>');
        foreach ($invoices as $val) {

            if ($val->created_on > Carbon::now() )
                var_dump('created on daugiau');
                var_dump( $val->created_on);
            var_dump('<br>');
            var_dump('<br>');

            if ($val->created_on < "2020-01-01 00:00:00" )
                var_dump('created on maziau');
                var_dump( $val->created_on);
            var_dump('<br>');
            var_dump('<br>');
            if ($val->created_on < Carbon::now() )
                var_dump('Carbon now');
                var_dump( $val->created_on);
            var_dump('<br>');
            var_dump('<br>');


        }



        return $this->render('statistics', ['invoices' => $invoices, 'orders' => $orders]);
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
            $newUser->payment_status=0;
            $newUser->save();

            $invoice = new Invoice();
            $invoice->price = $amount / 100;
            $invoice->created_on = Carbon::now();
            $invoice->save();
//
//            $order = new Order();
//            $order->user_id = $newUser->ID;
//            $order->course_id = $id;
//            $order->invoice_id = $invoice->ID;
//            $order->save();

        }
        else {
            $user=User::getAll();
            $user_id = 0;
             foreach ($user as $u) {
                 if($u->email == $email) {
                     $user_id = $u->ID;
                 }
             }

//            $invoice = new Invoice();
//            $invoice->price = $amount / 100;
//            $invoice->created_on = Carbon::now();
//            $invoice->save();

//            $order = new Order();
//            $order->user_id = $user_id;
//            $order->course_id = $id;
//            $order->invoice_id = $invoice->ID;
//            $order->save();

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
            return $this->render('pay', ['info' => $status]);
        }

    }



}


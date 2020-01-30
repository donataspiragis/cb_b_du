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
        $offer = Course::getWere('ID=' . $id );
        $email = $_POST['email'];
        $user=User::getAll();
        self::paid($id, 1, $email);


//        foreach ($user as $u) {
//            if($u->email== $_POST['email']) {
//                self::paid($id, 1, $email);
//            } else {
//                self::paid($id, 0, $email);
//            }
//        }
    }

    public function paid ($id, $status, $email){
        $email = $email;


        if($status == 0) {
            $newUser= new User();
            $newUser->name='laikinas';
            $newUser->surname='laikinas';
            $newUser->password=password_hash(rand(1,100), PASSWORD_DEFAULT);
            $newUser->role=0;
            $newUser->email = $email;
            $newUser->created_on=Carbon::now();
            $newUser->user_discount=20;
            $newUser->payment_status=1;
            $newUser->save();
        }



        $servisas = App::get('paysera');
        $amount_obj = Offer::getWere('course_id =' . $id);
        $amount = 0;
        if($amount_obj->discount_offer > 0) {
            $amount = $amount_obj->discount_offer;
        }
        else {
            $amount = $amount_obj->price;
        }
        $amount = $amount * 100;
        $servisas->pay($email, $amount);
    }


    public function answer($data) {
        var_dump('<br>');
        var_dump('<br>');
        var_dump($data);


        $info = WebToPay::checkResponse($_GET, ['projectid' => 146155, 'sign_password' => 'ce28c97dcd8381b7d5a093ffd1deae38']);
        var_dump(
            $info
        );
        return $this->render('register');
    }



}


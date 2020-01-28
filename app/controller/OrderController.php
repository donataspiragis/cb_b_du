<?php
namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use App\Model\Course;
use App\Model\Invoice;
use App\Model\Offer;
use App\Model\Order;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

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

}


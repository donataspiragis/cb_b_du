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
        $all = Invoice::getAll();
        return $this->render('statistics', ['all' => $all]);
    }

}


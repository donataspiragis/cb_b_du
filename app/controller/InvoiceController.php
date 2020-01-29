<?php

namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use App\Model\Invoice;
use App\Model\Order;
use App\Model\User;
use Symfony\Component\HttpFoundation\Request;

use App\Model\Model;

class InvoiceController extends BaseController  {
    public function index() {
        $user_id = 1;
        $user_orders = Order::getWere("user_id = $user_id");
        
        return $this->render('invoices', ['id' => $user_id]);
    }

    public function show($invoice_id = 1) {
        $invoice = Invoice::getWere("ID = $invoice_id");
        $order = Order::getWere("invoice_id = $invoice->ID");
        $user = User::getWere("ID = $order->user_id");
    }
}


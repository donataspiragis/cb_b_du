<?php

namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use App\Model\Course;
use App\Model\Invoice;
use App\Model\Order;
use App\Model\User;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Model;
use App\Pdf\tFPDF;
use App\Pdf\InvoicePdf;

session_start();

class InvoiceController extends BaseController  {
    public function index() {
        return $this->render('invoiceslayout', ['payments' => $this->getPayments()]);
    }

    public function show($invoice_id) {
        $pdf = new InvoicePdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->myTable($this->getPayments($invoice_id));
        $pdf->Output('cbb2_invoice_' . $invoice_id . '.pdf', 'I');
    }

    public function getPayments($invc_id = null): array {
        $user_id = $_SESSION['userId'];
        $orders = [];

        if (!is_null($invc_id)) {
            $orders[] = Order::getWere("invoice_id = $invc_id");
        } else {
            $orders = Order::getWere("user_id = $user_id");
            !is_array($orders) ? $orders = [$orders] : false;
        }

        $payments = [];

        foreach ($orders as $index => $order) {
            $course_id = $order->course_id;
            $invoice_id = $invc_id ?? $order->invoice_id;

            $name = (Course::getWere("ID = $course_id"))->name;
            $price = (Invoice::getWere("ID = $invoice_id"))->price;
            $date = (Invoice::getWere("ID = $invoice_id"))->created_on;

            $payments[$invoice_id] = [
                'name' => $name,
                'price' => $price,
                'date' => explode(' ', $date)[0]
            ];
        }

        return $payments;
    }
}


<?php

namespace App\Controller;

use App\App;
use App\Controller\BaseController;
use App\Model\Invoice;
use App\Model\Order;
use App\Model\User;
use Symfony\Component\HttpFoundation\Request;
use App\Model\Model;
use App\Pdf\tFPDF;
use App\Pdf\InvoicePdf;

class InvoiceController extends BaseController  {
    public function index($user_id = 1) {
//        $user_orders = Order::getWere("user_id = $user_id");

        $payments = [
            [
                'name' => 'Course 1',
                'price' => '10',
                'date' => '2020-07-03'
            ],
            [
                'name' => 'Course 2',
                'price' => '20',
                'date' => '2020-09-13'
            ],
            [
                'name' => 'Course 3',
                'price' => '30',
                'date' => '2020-11-11'
            ]
        ];

        return $this->render('invoiceslayout', ['payments' => $payments]);
    }

    public function show($invoice_id = 1) {
        $payments = [
            [
                'name' => 'Course 1',
                'price' => '10',
                'date' => '2020-07-03'
            ]
        ];


        // Instanciation of inherited class
        $pdf = new InvoicePdf();

        $pdf->setTableData($payments);

        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->myTable($payments);
//        $pdf->SetFont('Times','',12);
//        for($i=1;$i<=20;$i++)
//            $pdf->Cell(0,10,'Printing line number '.$i,0,1);
        $pdf->Output();

//        $pdf = new FPDF();
//        $header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
//        $data = [['lithuania', 'vilnius', 230, 4000]];
//        $pdf->AddPage();
//        // Logo
//        $pdf->Image(App::INSTALL_FOLDER . 'images/1.png',10,6,30);
//        // Arial bold 15
//        $pdf->SetFont('Arial','B',15);
//        // Move to the right
//        $pdf->Cell(80);
//        // Title
//        $pdf->Cell(30,10,'Title',1,0,'C');
//        // Line break
//        $pdf->Ln(20);
//
//        // Header
//        foreach($header as $col)
//            $pdf->Cell(40,7,$col,1);
//        $pdf->Ln();
//        // Data
//        foreach($data as $row)
//        {
//            foreach($row as $col)
//                $pdf->Cell(40,6,$col,1);
//            $pdf->Ln();
//        }
//        $pdf->Output();

        $page_data = [
            'page_width' => $pdf->GetPageWidth(),
            'page_height' => $pdf->GetPageHeight()
        ];

//        print '<pre>';
//        print_r($page_data);
//        die();

//        print('This is InvoiceController method show() for invoice id - ' . $invoice_id);
        die();
        $invoice = Invoice::getWere("ID = $invoice_id");
        $order = Order::getWere("invoice_id = $invoice->ID");
        $user = User::getWere("ID = $order->user_id");
    }
}


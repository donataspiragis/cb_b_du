<?php

namespace App\Pdf;

use App\App;

class InvoicePdf extends tFPDF {

    function Header() {
        $this->Image(App::INSTALL_FOLDER . 'images/logo.png',12,10,30, 40);
        $this->AddFont('Arial','', 'DejaVuSans.ttf', true);
        $this->SetFont('Arial','',15);
        $this->SetFontSize(20);
        $this->Cell(180,20,'CB B DU',0,0,'R', false);
        $this->Ln(20);
        $this->SetFontSize(12);
        $this->Cell(180,20, 'Sąskaita faktūra',0,0,'R', false);
        $this->Ln(6);
        $this->SetFontSize(10);
        $this->Cell(180,20, 'Serija, numeris: BLA 666777',0,0,'R', false);
        $this->Ln(10);
        $this->Line(20,50,190,50);
        $this->Ln(30);
    }

    function myTable($payments) {
//        print '<pre>';
//        print_r($payments);
//        die();
        foreach ($payments as $payment) {
//            foreach ($index as $payment) {
                $this->Cell(10, 6, '', 0, 0, 'C', false);
                $this->SetFillColor(250, 250, 250);
                $this->SetFontSize(10);
                $this->Cell(120, 8, $payment['name'], 0, 0, 'L', true);
                $this->Cell(1, 8, '', 0, 0, 'L', false);
                $this->Cell(28, 8, $payment['date'], 0, 0, 'R', true);
                $this->Cell(1, 8, '', 0, 0, 'L', false);
                $this->Cell(20, 8, $payment['price'] . ' eur', 0, 0, 'C', true);
//            }
            $this->Ln(10);
        }
    }

    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

<?php

include_once "model/user.php";
include_once "logic/fpdf184/fpdf.php";
include_once "logic/PDF_Invoice.php";

//The invice Generator generates a pdf that is send to the webbrowser
class InvoiceGenerator{
    public function generateInvoice($user, $saleslineList, $sumamount, $orderDate, $invoiceNo){
        
        $pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
        $pdf->AddPage();
        
        $pdf->addSociete( "FILARA GmbH",
                        "Testarellogasse 4\n" .
                        "1130 Vienna\n".
                        "AUSTRIA\n" );
        $pdf->fact_dev( "Invoice ","");
        $pdf->addDate(date('Y-m-d')); //current date
        $pdf->addClient($user->get_username());
        $pdf->addPageNumber("1");
        $pdf->addClientAdresse($user->get_salutation() . " ". $user->get_fname() ." ". $user->get_lname() . "\n". $user->get_streetname() . 
                                $user->get_streetnr() . "\n". $user->get_zip() ." ". $user->get_location() . "\n". $user->get_country());
        $pdf->addReglement("Payment by Invoice (20 Days)");
        $pdf->addEcheance($orderDate);
        $pdf->addNumTVA("R " .$invoiceNo);
        
        //
        $pdf->Cell(0,20,"","",1);
        $pdf->Cell(100,10,'Product name',"RB",0,"C");
        $pdf->Cell(30,10,'Quantity',"RBL",0,"C");
        $pdf->Cell(30,10,'Price per piece',"RBL",0,"C");
        $pdf->Cell(30,10,'Total',"BL",1,"C");


        $pdf->SetFont('Arial', '', 12);
        //renders actual invoice table
        for($i=0; $i<count($saleslineList); $i++){
            $pdf->Cell(100,8,$saleslineList[$i]->get_productName(),1,0);
            $pdf->Cell(30,8,$saleslineList[$i]->get_quantity(),1,0,"R");
            $pdf->Cell(30,8,sprintf("%00.2f",$saleslineList[$i]->get_productprice()/100),1,0,"R");
            $pdf->Cell(30,8,sprintf("%00.2f",$saleslineList[$i]->get_productprice()/100*$saleslineList[$i]->get_quantity()),1,1,"R");
        }
        $pdf->Cell(100,8,"Total Cost",1,0);
        $pdf->Cell(30,8,"",1,0,"R");
        $pdf->Cell(30,8,sprintf("%00.2f",""),1,0,"R");
        $pdf->Cell(30,8,sprintf("%00.2f",$sumamount/100),1,1,"R");
        $pdf->Output();
        die();
    }
}
?>
<?php

error_reporting(E_ALL);
require ('cashbook_header_pdf.php');
// Begin configuration

$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];


$textColour = array(0, 0, 0);
$headerColour = array(100, 100, 100);
$tableHeaderTopTextColour = array(255, 255, 255);
$tableHeaderTopFillColour = array(125, 152, 179);
$tableHeaderTopProductTextColour = array(0, 0, 0);
$tableHeaderTopProductFillColour = array(143, 173, 204);
$tableHeaderLeftTextColour = array(99, 42, 57);
$tableHeaderLeftFillColour = array(184, 207, 229);
$tableBorderColour = array(50, 50, 50);
$tableRowFillColour = array(213, 170, 170);
$date = date('d-M-Y');
$reportName = "Cash Book ";
$reportNameYPos = 160;




$p_height = 60;
$bottom_margin = 10;

// End configuration


/**
  Create the title page
 * */
$pdf = new PDF();
$pdf->AliasNbPages();


/**
  Create the page header, main heading, and intro text
 * */
$pdf->AddPage();

$pdf->SetDrawColor(192, 189, 164);
$pdf->SetLineWidth(1.5);
$pdf->Rect(5, 5, 200, 287, 'D');
$pdf->SetTextColor($headerColour[0], $headerColour[1], $headerColour[2]);
$pdf->SetFont('Arial', '', 15);
$pdf->SetTextColor(192, 189, 164);
$pdf->Cell(0, 15, $reportName, 0, 0, 'C');
$pdf->SetTextColor($textColour[0], $textColour[1], $textColour[2]);
$pdf->SetFont('Arial', '', 11);
$pdf->Ln(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0, 0, " ". $date_from . " - " . $date_to);
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 0, " Generated On: " . $date);

$pdf->Ln(15);

$pdf->Ln();
$pdf->SetLineWidth(0.1);
$pdf->SetFont('Arial', 'B', 11);

$pdf->Cell(20, 5, 'Date', 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
$pdf->Cell(100, 5, 'Particular', 'LRB', 0, 'C', 0);

$pdf->Cell(20, 5, 'Income', 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
$pdf->Cell(20, 5, 'Expenses', 'LRB', 0, 'C', 0);
$pdf->Cell(20, 5, 'Bal.', 'LRB', 0, 'C', 0);
//$pdf->Cell(50,5,'Donor','LRB',0,'L',0);
$pdf->Ln();
$pdf->SetLineWidth(0.2);
$pdf->SetTextColor(192, 189, 164);
$pdf->SetFont('Arial', '', 8);
$pdf->SetAutoPageBreak(FALSE);
//Query to select all class teachers

$queryDup = "select * from cash_flow where  cash_date between  '" . $date_from . "' and '" . $date_to . "' group by cash_date ";
$balance = 0;
if (DB::getInstance()->checkRows($queryDup)) {
    $users_list = DB::getInstance()->query($queryDup);
    $no = 1;
    foreach ($users_list->results() as $users_list) :

        $date = $users_list->cash_date;
        $queryDup = "select * from cash_flow where cash_date =  '" . $date . "' order by cash_flow_id asc limit 1 ";
        if (DB::getInstance()->checkRows($queryDup)) {
            $res_lists = DB::getInstance()->query($queryDup);
            foreach ($res_lists->results() as $res_lists) {
                $opening = $res_lists->opening;
                $clossing = $res_lists->clossing;

                $pdf->Cell(20, 5, $date, 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
                $pdf->Cell(100, 5, "balance brought forward (b/f)", 'LRB', 0, 'C', 0);

                $pdf->Cell(20, 5, "", 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
                $pdf->Cell(20, 5, "", 'LRB', 0, 'C', 0);
                $pdf->Cell(20, 5, number_format($opening), 'LRB', 0, 'C', 0);
                $pdf->Ln();
            }
        }


        

//Income starts here...
        $queryDup = "select * from income  where income_date =  '" . $date . "'  ";
        if (DB::getInstance()->checkRows($queryDup)) {
            $res_lists = DB::getInstance()->query($queryDup);
            foreach ($res_lists->results() as $users_list) :

                $balance += $users_list->income_amount;

                $pdf->Cell(20, 5, "", 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
                $pdf->Cell(100, 5, $users_list->income_description, 'LRB', 0, 'C', 0);

                $pdf->Cell(20, 5, number_format($users_list->income_amount), 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
                $pdf->Cell(20, 5, "", 'LRB', 0, 'C', 0);
                $pdf->Cell(20, 5, number_format($balance), 'LRB', 0, 'C', 0);
                $pdf->Ln();
            endforeach;
        }

        //School fees payments starts here
        $queryDup = "select * from payments P,student_info s  where s.student_id = p.student_id and payment_date =  '" . $date . "'  ";
        if (DB::getInstance()->checkRows($queryDup)) {
            $res_lists = DB::getInstance()->query($queryDup);
            foreach ($res_lists->results() as $users_list) :

                $balance += $users_list->amount_paid;

                $pdf->Cell(20, 5, "", 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
                $pdf->Cell(100, 5, "Fees payment for " . $users_list->fname . " " . $users_list->sname, 'LRB', 0, 'C', 0);

                $pdf->Cell(20, 5, number_format($users_list->amount_paid), 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
                $pdf->Cell(20, 5, "", 'LRB', 0, 'C', 0);
                $pdf->Cell(20, 5, number_format($balance), 'LRB', 0, 'C', 0);


                $pdf->Ln();
            endforeach;
        }

        /// Expenditure starts here...

        $queryDup = "select * from expenditure where exp_date =  '" . $date . "' ";
        if (DB::getInstance()->checkRows($queryDup)) {
            $res_lists = DB::getInstance()->query($queryDup);
            foreach ($res_lists->results() as $users_list) :

                $balance -= $users_list->exp_amount;

                $pdf->Cell(20, 5, "", 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
                $pdf->Cell(100, 5, $users_list->exp_description, 'LRB', 0, 'C', 0);

                $pdf->Cell(20, 5, "", 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
                $pdf->Cell(20, 5, number_format($users_list->exp_amount), 'LRB', 0, 'C', 0);
                $pdf->Cell(20, 5, number_format($balance), 'LRB', 0, 'C', 0);

                $pdf->Ln();
            endforeach;
        }


        $block = floor($no / 6);
        $space_left = $p_height - ($pdf->GetY() + $bottom_margin);
        if ($no / 6 == floor($no / 6)) {
            $pdf->AddPage();
        }


//$pdf->Cell(50,5,'[ o ] def4','LRB',0,'C',0);

        $pdf->Ln();
        $no++;
    endforeach;
}

$pdf->Ln();

$pdf->Ln(20);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0, 0,  " Burser's Office ");
$pdf->Ln(5);

$pdf->MultiCell(0, 0,  " Signature        .............................................. ");
$pdf->Ln(5);

/* * *
  Serve the PDF
 * * */

$pdf->Output();
?>
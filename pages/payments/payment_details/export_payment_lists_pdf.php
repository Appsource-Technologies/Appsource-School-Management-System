<?php

error_reporting(E_ALL);
require ('payment_header_pdf.php');
// Begin configuration

$class = $_GET['class'];
$term = $_GET['term'];
$year = $_GET['year'];
$name1 = "";
$name2 = "";
$name3 = "";
$queryDup = "select class_name from class where  class_id = '" . $class . "' ";
if (DB::getInstance()->checkRows($queryDup)) {
    $res_lists = DB::getInstance()->query($queryDup);
    foreach ($res_lists->results() as $res_lists) :
        $name1 = $res_lists->class_name;
    endforeach;
}
$queryDup = "select term_name from terms where  terms_id = '" . $term . "' ";
if (DB::getInstance()->checkRows($queryDup)) {
    $res_lists = DB::getInstance()->query($queryDup);
    foreach ($res_lists->results() as $res_lists):
        $name2 = $res_lists->term_name;
    endforeach;
}
$queryDup = "select a_yr from academic_yr where  a_yr_id = '" . $year . "' ";
if (DB::getInstance()->checkRows($queryDup)) {
    $res_lists = DB::getInstance()->query($queryDup);
    foreach ($res_lists->results() as $res_lists):
        $name3 = $res_lists->a_yr;
    endforeach;
}

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
$reportName = "Payment Lists ";
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
$pdf->SetFont('Arial', '', 12);
$pdf->Ln(15);
$pdf->SetTextColor(0, 0, 0);
$pdf->MultiCell(0, 0, " Class:" . $name1 . ", Term: " . $name2 . ", Year: " . $name3,0,'C');
$pdf->Ln(10);
$pdf->SetTextColor(192, 189, 164);
$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 0, " Upto " . $date );

$pdf->Ln(15);

$pdf->Ln();
$pdf->SetLineWidth(0.1);
$pdf->SetFont('Arial', 'B', 11);

$pdf->Cell(40, 5, 'First Name', 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
$pdf->Cell(40, 5, 'Last Name', 'LRB', 0, 'C', 0);

$pdf->Cell(12, 5, 'Class', 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
$pdf->Cell(30, 5, 'Term', 'LRB', 0, 'C', 0);
$pdf->Cell(15, 5, 'Year', 'LRB', 0, 'C', 0);
$pdf->Cell(25, 5, 'Reciept', 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
$pdf->Cell(25, 5, 'Amount', 'LRB', 0, 'L', 0);
//$pdf->Cell(50,5,'Donor','LRB',0,'L',0);
$pdf->Ln();
$pdf->SetLineWidth(0.2);
$pdf->SetTextColor(107, 105, 84);
$pdf->SetFont('Arial', '', 8);
$pdf->SetAutoPageBreak(FALSE);
//Query to select all class teachers

$queryDup = "select * from student_info s,class c,academic_yr y,terms t,payments p where(p.student_id=s.student_id and  p.class_id=c.class_id and p.a_yr_id=y.a_yr_id and p.terms_id=t.terms_id and p.terms_id = '" . $term . "' and p.a_yr_id = '" . $year . "' and p.class_id = '" . $class . "' )";
if (DB::getInstance()->checkRows($queryDup)) {
    $users_list = DB::getInstance()->query($queryDup);
    $no = 1;
    foreach ($users_list->results() as $users_list) :

        $block = floor($no / 6);
        $space_left = $p_height - ($pdf->GetY() + $bottom_margin);
        if ($no / 6 == floor($no / 6)) {
            $pdf->AddPage();
        }

        $pdf->Cell(40, 5, $users_list->fname, 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
        $pdf->Cell(40, 5, $users_list->sname, 'LRB', 0, 'C', 0);

        $pdf->Cell(12, 5, $users_list->class_name, 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
        $pdf->Cell(30, 5, $users_list->term_name, 'LRB', 0, 'C', 0);
        $pdf->Cell(15, 5, $users_list->a_yr, 'LRB', 0, 'C', 0);
        $pdf->Cell(25, 5, $users_list->receipt_no, 'LBR', 0, 'C', 0);   // empty cell with left,bottom, and right borders
        $pdf->Cell(25, 5, number_format($users_list->amount_paid), 'LRB', 0, 'L', 0);
//$pdf->Cell(50,5,'[ o ] def4','LRB',0,'C',0);

        $pdf->Ln();
        $no++;
    endforeach;
}

$pdf->Ln();



/* * *
  Serve the PDF
 * * */

$pdf->Output();
?>
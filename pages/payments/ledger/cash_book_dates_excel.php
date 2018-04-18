<?php

error_reporting(E_ALL);
/** Set default timezone (will throw a notice otherwise) */
date_default_timezone_set('Africa/Nairobi');
//$date = date("Y-m-d H:m:s");
//if ($_GET['class']) {
// include PHPExcel
require("excel_class/PHPExcel.php");
// create new PHPExcel object
$objPHPExcel = new PHPExcel;

// set default font
$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');

// set default font size
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
// create the writer
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
ob_end_clean();
/**

 * Define currency and number format.

 */
// currency format, € with < 0 being in red color
$currencyFormat = '#,#0.## \€;[Red]-#,#0.## \€';

// number format, with thousands separator and two decimal points.
$numberFormat = '#,#0.##;[Red]-#,#0.##';



// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();

// rename the sheet
$objSheet->setTitle('Payment List Report');



// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
$objSheet->getStyle('A1:H1')->getFont()->setBold(true)->setSize(12);



// write header

$objSheet->getCell('A1')->setValue('Date');
$objSheet->getCell('B1')->setValue('Particular');
$objSheet->getCell('C1')->setValue('Income');
$objSheet->getCell('D1')->setValue('Expenditure');
$objSheet->getCell('E1')->setValue('Balance');

// we could get this data from database, but here we are writing for simplicity
$date_from = $_GET['date_from'];
$date_to = $_GET['date_to'];

$count = 2;
$rows = 2;
$queryDup = "select * from cash_flow where  cash_date between  '" . $date_from . "' and '" . $date_to . "' group by cash_date ";
$balance = 0;
if (DB::getInstance()->checkRows($queryDup)) {
$users_list = DB::getInstance()->query($queryDup);
$no = 1;
foreach ($users_list->results() as $users_list) :
$count ++;
$rows ++;
$date = $users_list->cash_date;
$queryDup = "select * from cash_flow where cash_date =  '" . $date . "' order by cash_flow_id asc limit 1 ";
if (DB::getInstance()->checkRows($queryDup)) {
$res_lists = DB::getInstance()->query($queryDup);
foreach ($res_lists->results() as $res_lists) {
$opening = $res_lists->opening;
$clossing = $res_lists->clossing;

$objSheet->getCell('A' . $count)->setValue($users_list->$date);
$objSheet->getCell('B' . $count)->setValue("balance brought forward (b/f)");
$objSheet->getCell('C' . $count)->setValue("");
$objSheet->getCell('D' . $count)->setValue(""); /// $objSheet->getCell('D'.$count)->setValue('=B2*C2');
$objSheet->getCell('E' . $count)->setValue(number_format($opening));
}
}




//Income starts here...
$queryDup = "select * from income  where income_date =  '" . $date . "'  ";
if (DB::getInstance()->checkRows($queryDup)) {
$res_lists = DB::getInstance()->query($queryDup);
foreach ($res_lists->results() as $users_list) :
$rows ++;

$balance += $users_list->income_amount;

$objSheet->getCell('A' . $rows)->setValue("");
$objSheet->getCell('B' . $rows)->setValue($users_list->income_description);
$objSheet->getCell('C' . $rows)->setValue(number_format($users_list->income_amount));
$objSheet->getCell('D' . $rows)->setValue("");
$objSheet->getCell('E' . $rows)->setValue(number_format($balance)); /// $objSheet->getCell('D'.$count)->setValue('=B2*C2');


endforeach;
}

//School fees payments starts here
$queryDup = "select * from payments P,student_info s  where s.student_id = p.student_id and payment_date =  '" . $date . "'  ";
if (DB::getInstance()->checkRows($queryDup)) {
$res_lists = DB::getInstance()->query($queryDup);
foreach ($res_lists->results() as $users_list) :
$balance += $users_list->amount_paid;
$rows ++;

$objSheet->getCell('A' . $rows)->setValue("");
$objSheet->getCell('B' . $rows)->setValue("Fees payment for ".$users_list->fname." ".$users_list->sname);
$objSheet->getCell('C' . $rows)->setValue(number_format($users_list->amount_paid));
$objSheet->getCell('D' . $rows)->setValue("");
$objSheet->getCell('E' . $rows)->setValue(number_format($balance)); /// $objSheet->getCell('D'.$count)->setValue('=B2*C2');


endforeach;
}

/// Expenditure starts here...

$queryDup = "select * from expenditure where exp_date =  '" . $date . "' ";
if (DB::getInstance()->checkRows($queryDup)) {
$res_lists = DB::getInstance()->query($queryDup);
foreach ($res_lists->results() as $users_list) :
$balance -= $users_list->exp_amount;
$rows ++;

$objSheet->getCell('A' . $rows)->setValue("");
$objSheet->getCell('B' . $rows)->setValue($users_list->exp_description);
$objSheet->getCell('C' . $rows)->setValue("");
$objSheet->getCell('D' . $rows)->setValue(number_format($users_list->exp_amount));
$objSheet->getCell('E' . $rows)->setValue(number_format($balance)); /// $objSheet->getCell('D'.$count)->setValue('=B2*C2');

endforeach;
}


$no++;
endforeach;
}

// autosize the columns
$objSheet->getColumnDimension('A')->setAutoSize(true);
$objSheet->getColumnDimension('B')->setAutoSize(true);
$objSheet->getColumnDimension('C')->setAutoSize(true);
$objSheet->getColumnDimension('D')->setAutoSize(true);
$objSheet->getColumnDimension('E')->setAutoSize(true);


//Setting the header type
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="cashbook-from-to.xlsx"');
header('Cache-Control: max-age=0');

$objWriter->save('php://output');

/* If you want to save the file on the server instead of downloading, replace the last 4 lines by 
  $objWriter->save('file.xlsx');
 */
?>

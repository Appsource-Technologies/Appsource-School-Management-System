<?php
include ("../assets/connection.php");
include ("../connectivity.php");
session_start();
$query = $pdo->query("select * from hospital_request r,factor f,blood_group b,users u where u.User_Id=r.Confirmed_id and r.factorID=f.factorID and r.Blood_Group_Id=b.Blood_Group_Id  group by Request_Date,Request_Time,r.Blood_Group_Id,r.factorID") or die(mysql_error());


/** Set default timezone (will throw a notice otherwise) */
date_default_timezone_set('Asia/Kolkata');

// include PHPExcel
require('class/PHPExcel.php');

// create new PHPExcel object
$objPHPExcel = new PHPExcel;

// set default font
$objPHPExcel->getDefaultStyle()->getFont()->setName('Times New Roman');

// set default font size
$objPHPExcel->getDefaultStyle()->getFont()->setSize(10);
// create the writer
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");

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
$objSheet->setTitle('UgBBS Blood Requests');



// let's bold and size the header font and write the header
// as you can see, we can specify a range of cells, like here: cells from A1 to A4
$objSheet->getStyle('A1:J1')->getFont()->setBold(true)->setSize(12);



// write header

$objSheet->getCell('A1')->setValue('Request ID');
$objSheet->getCell('B1')->setValue('Date');
$objSheet->getCell('C1')->setValue('Time');
$objSheet->getCell('D1')->setValue('Request By');
$objSheet->getCell('E1')->setValue('Blood Group');
$objSheet->getCell('F1')->setValue('Rhesus Facter');
$objSheet->getCell('G1')->setValue('Quantity');
$objSheet->getCell('H1')->setValue('Status');
$objSheet->getCell('I1')->setValue('Update Date');
$objSheet->getCell('J1')->setValue('Update Time');

// we could get this data from database, but here we are writing for simplicity

$query -> execute();
	
$result = $query->fetchAll();
$count = 1;
foreach($result as $rows) {
       $qnt1 = $rows['Requested_Quantity'];
	   $qnt2 = $rows['Confirm_Quantity'];
							
	   $qnt = $qnt1 - $qnt2;
	  if($qnt2 != 0){	
$count ++;
$objSheet->getCell('A'.$count)->setValue("ReQ-".$rows['Request_Id']);
$objSheet->getCell('B'.$count)->setValue($rows['Request_Date']);
$objSheet->getCell('C'.$count)->setValue($rows['Request_Time']);
$objSheet->getCell('D'.$count)->setValue($rows['Fname']." ".$rows['Lname']);
$objSheet->getCell('E'.$count)->setValue($rows['Blood_Group']);/// $objSheet->getCell('D'.$count)->setValue('=B2*C2');
$objSheet->getCell('F'.$count)->setValue($rows['Factor_Name']);
$objSheet->getCell('G'.$count)->setValue($qnt2);
$objSheet->getCell('H'.$count)->setValue('Confirmed');
$objSheet->getCell('I'.$count)->setValue($rows['Updated_Date']);
$objSheet->getCell('J'.$count)->setValue($rows['Updated_Time']);
	  }
}
$tt = $count + 1;
$g = $count.')';
$objSheet->getCell('G'.$tt)->setValue('=SUM(G2:G'.$g);
$count += $count ;
$t = $count;
foreach($result as $rows) {
       $qnt1 = $rows['Requested_Quantity'];
	   $qnt2 = $rows['Confirm_Quantity'];
							
	   $qnt = $qnt1 - $qnt2;
	  if($qnt != 0){	
$count ++;
$objSheet->getCell('A'.$count)->setValue("ReQ-".$rows['Request_Id']);
$objSheet->getCell('B'.$count)->setValue($rows['Request_Date']);
$objSheet->getCell('C'.$count)->setValue($rows['Request_Time']);
$objSheet->getCell('D'.$count)->setValue($rows['Fname']." ".$rows['Lname']);
$objSheet->getCell('E'.$count)->setValue($rows['Blood_Group']);/// $objSheet->getCell('D'.$count)->setValue('=B2*C2');
$objSheet->getCell('F'.$count)->setValue($rows['Factor_Name']);
$objSheet->getCell('G'.$count)->setValue($qnt);
$objSheet->getCell('H'.$count)->setValue('Pending');
$objSheet->getCell('I'.$count)->setValue($rows['Updated_Date']);
$objSheet->getCell('J'.$count)->setValue($rows['Updated_Time']);
	  }
}

$tt2 = $count + 1;
//$g = "'.$count.')';
//$objSheet->getCell('G'.$tt)->setValue('=SUM(G2:G'.$g);
$c = $count+ 2;
//$objSheet->getCell('A'.$c)->setValue('Total Requests');
//$objSheet->getCell('G'.$c)->setValue('=SUM(G2:G:'".$count."')');


// autosize the columns
$objSheet->getColumnDimension('A')->setAutoSize(true);
$objSheet->getColumnDimension('B')->setAutoSize(true);
$objSheet->getColumnDimension('C')->setAutoSize(true);
$objSheet->getColumnDimension('D')->setAutoSize(true);
$objSheet->getColumnDimension('E')->setAutoSize(true);
$objSheet->getColumnDimension('F')->setAutoSize(true);
$objSheet->getColumnDimension('G')->setAutoSize(true);
$objSheet->getColumnDimension('H')->setAutoSize(true);
$objSheet->getColumnDimension('I')->setAutoSize(true);
$objSheet->getColumnDimension('J')->setAutoSize(true);


//Setting the header type
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="confirmed_requests.xlsx"');
header('Cache-Control: max-age=0');

$objWriter->save('php://output');

/* If you want to save the file on the server instead of downloading, replace the last 4 lines by 
    $objWriter->save('file.xlsx');
*/

?>

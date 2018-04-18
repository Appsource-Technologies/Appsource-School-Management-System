<?php
error_reporting(E_ALL);
/** Set default timezone (will throw a notice otherwise) */
date_default_timezone_set('Africa/Nairobi');
//$date = date("Y-m-d H:m:s");
//if ($_GET['class']) {
// include PHPExcel

//composer require "excel_class/PHPExcel.php";

//require_once(BASE_PATH . '/AddOns/excel_class/PHPExcel.php');
//require("excel_class/PHPExcel.php");
// create new PHPExcel object

require_once(dirname(__FILE__) . '/excel_class/PHPExcel.php');

$objPHPExcel = new PHPExcel();
 $objPHPExcel->getProperties()->setCreator("MokNathal")
                                     ->setLastModifiedBy("MokNathal")
                                     ->setTitle("STAFF REPORT")
                                     ->setSubject("STAFF REPORT")
                                     ->setDescription("STAFF REPORT")
                                     ->setKeywords("STAFF REPORT")
                                     ->setCategory("STAFF REPORT");



        $objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->getCell('A1')->setValue("Name of staff:aaaaaa Lname");
        $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setWrapText(true);       

        $objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->getCell('A2')->setValue("Group:Sunday Holiday Plan");
        $objPHPExcel->getActiveSheet()->getStyle('A2:F2')->getAlignment()->setWrapText(true);       

        $objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->getCell('A3')->setValue("Login Details");
        $objPHPExcel->getActiveSheet()->getStyle('A3:F3')->getAlignment()->setWrapText(true);           

        $objPHPExcel->getActiveSheet()->mergeCells('A4:F4');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->getCell('A4')->setValue("Checkin time:09:05:00am");
        $objPHPExcel->getActiveSheet()->getStyle('A4:F4')->getAlignment()->setWrapText(true);           

        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A5', 'Year')
                     ->setCellValue('B5', 'Month')
                     ->setCellValue('C5', 'Day')
                     ->setCellValue('D5', 'Login Time')
                      ->setCellValue('E5', 'Logout Time')
                       ->setCellValue('F5', 'Login Status');

        $objPHPExcel->getActiveSheet()->getStyle('A5:F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $objPHPExcel->getActiveSheet()->getStyle('A5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E5')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F5')->getFont()->setBold(true);

        $i=6;
        $uri_year=2071;
        $uri_month=4;
        for($j=1;$j<=30;$j++)
        {
        $objPHPExcel->setActiveSheetIndex(0)
                         ->setCellValue('A'.$i, $uri_year)
                         ->setCellValue('B'.$i, $uri_month)
                         ->setCellValue('C'.$i, $j);

                $i++;

        }
        foreach(range('A','F') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $objPHPExcel->getActiveSheet()->setTitle('Trasaction List');


        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=".$uri_year."-".$uri_month."_staff_report.xlsx");
        header("Cache-Control: max-age=0");

        $objWriter->save("php://output");
?>

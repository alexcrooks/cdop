<?php
require('finally.php');
require('include/data.php');
date_default_timezone_set("America/Vancouver");
require_once("phpexcel/Classes/PHPExcel/IOFactory.php");
require_once("phpexcel/Classes/PHPExcel.php");

$excel = new PHPExcel();
$excel->getProperties()->setTitle("CDOP Report for ".$data['instructor_name']." on ".$date);
$excel->setActiveSheetIndex(0);
$excel->getActiveSheet()->getSheetView()->setZoomScale(70);
$excel->getDefaultStyle()->getFont()->setName('Calibri')
                                    ->setSize(11);
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                                        ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4)
                                        ->setRowsToRepeatAtTopByStartAndEnd(1, 2)
                                        ->setVerticalCentered(false)
                                        ->setHorizontalCentered(true);
$excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(5);
$excel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
										
$excel->getActiveSheet()->getPageMargins()->setTop(0.25)
                                          ->setRight(0.25)
                                          ->setBottom(0.25)
                                          ->setLeft(0.25);   
$excel->getActiveSheet()->setShowGridlines(true);

$excel->getActiveSheet()->setCellValue('A1', 'Observed by: '.$data['observer_name'].'; Seated at: '.$data['observer_location']);
$excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$excel->getActiveSheet()->mergeCells('A1:Z1');

$excel->getActiveSheet()->setCellValue('A2', $data['class_name'].' instructed by '.$data['instructor_name'].' ('.$data['instructor_department'].') on '.$date);
$excel->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$excel->getActiveSheet()->mergeCells('A2:Z2');

$excel->getActiveSheet()->setCellValue('A3', $data['class_numstudentspresent'].' students present; Class arrangement: '.$data['room_layout']);
$excel->getActiveSheet()->getStyle("A3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$excel->getActiveSheet()->mergeCells('A3:Z3');

$rowNum = 7;

for ($i = 0; $i < (($data['time'] + 2) / 2); $i++) { 
    if ($i % 10 == 0) {
        $excel->getActiveSheet()->setCellValue('A'.$rowNum, 'min');
        $excel->getActiveSheet()->getStyle('A'.$rowNum)->getFont()->setBold(true);
        $excel->getActiveSheet()->mergeCells('A'.$rowNum.':A'.($rowNum+1));
        
        $excel->getActiveSheet()->setCellValue('B'.$rowNum, '1. Students Doing');
        $excel->getActiveSheet()->getStyle('B'.$rowNum)->getFont()->setBold(true);	
        $excel->getActiveSheet()->mergeCells('B'.$rowNum.':N'.$rowNum);

        $excel->getActiveSheet()->setCellValue('B'.($rowNum+1), 'L');
        $excel->getActiveSheet()->setCellValue('C'.($rowNum+1), 'Ind');
        $excel->getActiveSheet()->setCellValue('D'.($rowNum+1), 'CG');
        $excel->getActiveSheet()->setCellValue('E'.($rowNum+1), 'WG');
        $excel->getActiveSheet()->setCellValue('F'.($rowNum+1), 'OG');
        $excel->getActiveSheet()->setCellValue('G'.($rowNum+1), 'AnQ');
        $excel->getActiveSheet()->setCellValue('H'.($rowNum+1), 'SQ');
        $excel->getActiveSheet()->setCellValue('I'.($rowNum+1), 'WC');
        $excel->getActiveSheet()->setCellValue('J'.($rowNum+1), 'Prd');
        $excel->getActiveSheet()->setCellValue('K'.($rowNum+1), 'SP');
        $excel->getActiveSheet()->setCellValue('L'.($rowNum+1), 'TQ');
        $excel->getActiveSheet()->setCellValue('M'.($rowNum+1), 'W');
        $excel->getActiveSheet()->setCellValue('N'.($rowNum+1), 'O');

        $excel->getActiveSheet()->setCellValue('O'.$rowNum, '2. Instructor Doing');
        $excel->getActiveSheet()->getStyle('O'.$rowNum)->getFont()->setBold(true);	
        $excel->getActiveSheet()->mergeCells('O'.$rowNum.':Z'.$rowNum);

        $excel->getActiveSheet()->setCellValue('O'.($rowNum+1), 'Lec');
        $excel->getActiveSheet()->setCellValue('P'.($rowNum+1), 'RtW');
        $excel->getActiveSheet()->setCellValue('Q'.($rowNum+1), 'FUp');
        $excel->getActiveSheet()->setCellValue('R'.($rowNum+1), 'PQ');
        $excel->getActiveSheet()->setCellValue('S'.($rowNum+1), 'CQ');
        $excel->getActiveSheet()->setCellValue('T'.($rowNum+1), 'AnQ');
        $excel->getActiveSheet()->setCellValue('U'.($rowNum+1), 'MG');
        $excel->getActiveSheet()->setCellValue('V'.($rowNum+1), '1o1');
        $excel->getActiveSheet()->setCellValue('W'.($rowNum+1), 'D/V');
        $excel->getActiveSheet()->setCellValue('X'.($rowNum+1), 'Adm');
        $excel->getActiveSheet()->setCellValue('Y'.($rowNum+1), 'W');
        $excel->getActiveSheet()->setCellValue('Z'.($rowNum+1), 'O');

        $excel->getActiveSheet()->setCellValue('AA'.$rowNum, '3. Eng');
        $excel->getActiveSheet()->getStyle('AA'.$rowNum)->getFont()->setBold(true);	
        $excel->getActiveSheet()->mergeCells('AA'.$rowNum.':AC'.($rowNum+1));

        $excel->getActiveSheet()->setCellValue('AD'.$rowNum, '4. Comments');
        $excel->getActiveSheet()->getStyle('AD'.$rowNum)->getFont()->setBold(true);	
        $excel->getActiveSheet()->mergeCells('AD'.$rowNum.':AD'.($rowNum+1));
        
        $rowNum += 2;
    }
    $excel->getActiveSheet()->setCellValue('A'.$rowNum, ($i*2).'-'.(($i*2)+2).' min');

    $columnNum = 'B';

    foreach ($tableElements as $elementName) {
        if (isset($data['table_' . $elementName][$i])) {
            $excel->getActiveSheet()->getStyle($columnNum . $rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $excel->getActiveSheet()->getStyle($columnNum . $rowNum)->getFill()->getStartColor()->setRGB('000000');
            $excel->getActiveSheet()->setCellValue($columnNum . $rowNum, 1);
        }
        $columnNum++;
    }
    
    if (isset($data['table_Eng'][$i])) {
        $excel->getActiveSheet()->setCellValue('AA'.$rowNum, $data['table_Eng'][$i]);
        $excel->getActiveSheet()->mergeCells('AA'.$rowNum.':AC'.$rowNum);
    }
    
    if (isset($data['table_Comments'][$i])) {
        $excel->getActiveSheet()->setCellValue('AD'.$rowNum, $data['table_Comments'][$i]);
    }
    $rowNum++;
}
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(9);
$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(25);

$fileName = "CDOP-".strtotime($date)."-".$data['observer_name'].".xlsx";
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$fileName."'");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
$objWriter->save('php://output');
?>
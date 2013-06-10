<?php
require("finally.php");
require("include/data.php");
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

$excel->getActiveSheet()
      ->setCellValue('A1', 'Observed by: '.$data['observer_name'].';
      Seated at: '.$data['observer_location']);
$excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$excel->getActiveSheet()->mergeCells('A1:Z1');

$excel->getActiveSheet()
      ->setCellValue('A2', $data['class_name'].' instructed by '.$data['instructor_name'].' ('.$data['instructor_department'].') on '.$date);
$excel->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$excel->getActiveSheet()->mergeCells('A2:Z2');

$excel->getActiveSheet()
      ->setCellValue('A3', $data['class_numstudentspresent'].' students present;        
      Class arrangement: '.$data['room_layout']);
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
    
    if (isset($data['table_L'][$i])) {
        $excel->getActiveSheet()->getStyle('B'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('B'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('B'.$rowNum, 1);
    }
    if (isset($data['table_Ind'][$i])) {
        $excel->getActiveSheet()->getStyle('C'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('C'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('C'.$rowNum, 1);
    }
    if (isset($data['table_CG'][$i])) {
        $excel->getActiveSheet()->getStyle('D'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('D'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('D'.$rowNum, 1);
    }
    if (isset($data['table_WG'][$i])) {
        $excel->getActiveSheet()->getStyle('E'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('E'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('E'.$rowNum, 1);
    }
    if (isset($data['table_OG'][$i])) {
        $excel->getActiveSheet()->getStyle('F'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('F'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('F'.$rowNum, 1);
    }
    if (isset($data['table_AnQS'][$i])) {
        $excel->getActiveSheet()->getStyle('G'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('G'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('G'.$rowNum, 1);
    }
    if (isset($data['table_SQ'][$i])) {
        $excel->getActiveSheet()->getStyle('H'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('H'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('H'.$rowNum, 1);
    }
    if (isset($data['table_WC'][$i])) {
        $excel->getActiveSheet()->getStyle('I'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('I'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('I'.$rowNum, 1);
    }
    if (isset($data['table_Prd'][$i])) {
        $excel->getActiveSheet()->getStyle('J'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('J'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('J'.$rowNum, 1);
    }
    if (isset($data['table_SP'][$i])) {
        $excel->getActiveSheet()->getStyle('K'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('K'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('K'.$rowNum, 1);
    }
    if (isset($data['table_TQ'][$i])) {
        $excel->getActiveSheet()->getStyle('L'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('L'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('L'.$rowNum, 1);
    }
    if (isset($data['table_W'][$i])) {
        $excel->getActiveSheet()->getStyle('M'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('M'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('M'.$rowNum, 1);
    }
    if (isset($data['table_SO'][$i])) {
        $excel->getActiveSheet()->getStyle('N'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('N'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('N'.$rowNum, 1);
    }
    
        if (isset($data['table_Lec'][$i])) {
        $excel->getActiveSheet()->getStyle('O'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('O'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('O'.$rowNum, 1);
    }
    if (isset($data['table_RtW'][$i])) {
        $excel->getActiveSheet()->getStyle('P'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('P'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('P'.$rowNum, 1);
    }
    if (isset($data['table_FUp'][$i])) {
        $excel->getActiveSheet()->getStyle('Q'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('Q'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('Q'.$rowNum, 1);
    }
    if (isset($data['table_PQ'][$i])) {
        $excel->getActiveSheet()->getStyle('R'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('R'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('R'.$rowNum, 1);
    }
    if (isset($data['table_CQ'][$i])) {
        $excel->getActiveSheet()->getStyle('S'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('S'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('S'.$rowNum, 1);
    }
    if (isset($data['table_AnQI'][$i])) {
        $excel->getActiveSheet()->getStyle('T'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('T'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('T'.$rowNum, 1);
    }
    if (isset($data['table_MG'][$i])) {
        $excel->getActiveSheet()->getStyle('U'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('U'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('U'.$rowNum, 1);
    }
    if (isset($data['table_1o1'][$i])) {
        $excel->getActiveSheet()->getStyle('V'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('V'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('V'.$rowNum, 1);
    }
    if (isset($data['table_DV'][$i])) {
        $excel->getActiveSheet()->getStyle('W'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('W'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('W'.$rowNum, 1);
    }
    if (isset($data['table_AD'][$i])) {
        $excel->getActiveSheet()->getStyle('X'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('X'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('X'.$rowNum, 1);
    }
    if (isset($data['table_N'][$i])) {
        $excel->getActiveSheet()->getStyle('Y'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('Y'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('Y'.$rowNum, 1);
    }
    if (isset($data['table_IO'][$i])) {
        $excel->getActiveSheet()->getStyle('Z'.$rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $excel->getActiveSheet()->getStyle('Z'.$rowNum)->getFill()->getStartColor()->setRGB('000000');
        $excel->getActiveSheet()->setCellValue('Z'.$rowNum, 1);
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
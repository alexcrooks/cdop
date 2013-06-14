<?php
require('finally.php');
date_default_timezone_set('America/Vancouver');
require_once('phpexcel/Classes/PHPExcel/IOFactory.php');
require_once('phpexcel/Classes/PHPExcel.php');

$excel = new PHPExcel();
$excel->getProperties()->setTitle('CDOP Report for ' . $data['instructor_name'] . ' on ' . $date);
$excel->setActiveSheetIndex(0);

$activeSheet = $excel->getActiveSheet();
$activeSheet->getSheetView()->setZoomScale(70);
$excel->getDefaultStyle()->getFont()->setName('Calibri')
                                    ->setSize(11);
$activeSheet->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE)
                            ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4)
                            ->setRowsToRepeatAtTopByStartAndEnd(1, 2)
                            ->setVerticalCentered(false)
                            ->setHorizontalCentered(true);
$activeSheet->getDefaultColumnDimension()->setWidth(5);
$excel->getDefaultStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
										
$activeSheet->getPageMargins()->setTop(0.25)
                              ->setRight(0.25)
                              ->setBottom(0.25)
                              ->setLeft(0.25);
$activeSheet->setShowGridlines(true);

$activeSheet->setCellValue('A1', 'Observed by: ' . $data['observer_name'] . '; Seated at: ' . $data['observer_location']);
$activeSheet->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$activeSheet->mergeCells('A1:Z1');

$activeSheet->setCellValue('A2', $data['class_name'] . ' instructed by ' . $data['instructor_name'] . ' (' . $data['instructor_department'] . ') on ' . $date);
$activeSheet->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$activeSheet->mergeCells('A2:Z2');

$activeSheet->setCellValue('A3', $data['class_numstudentspresent'] . ' students present; Class arrangement: ' . $data['room_layout']);
$activeSheet->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$activeSheet->mergeCells('A3:Z3');

$rowNum = 7;

for ($i = 0; $i < (($data['time'] + 2) / 2); $i++) { 
    if ($i % 10 == 0) {
        $activeSheet->setCellValue('A' . $rowNum, 'min');
        $activeSheet->getStyle('A' . $rowNum)->getFont()->setBold(true);
        $activeSheet->mergeCells('A' . $rowNum . ':A'.($rowNum + 1));
        
        $activeSheet->setCellValue('B' . $rowNum, '1. Students Doing');
        $activeSheet->getStyle('B' . $rowNum)->getFont()->setBold(true);
        $activeSheet->mergeCells('B' . $rowNum.':N' . $rowNum);

        $activeSheet->setCellValue('O' . $rowNum, '2. Instructor Doing');
        $activeSheet->getStyle('O' . $rowNum)->getFont()->setBold(true);
        $activeSheet->mergeCells('O' . $rowNum . ':Z' . $rowNum);

        $activeSheet->setCellValue('AA' . $rowNum, '3. Eng');
        $activeSheet->getStyle('AA' . $rowNum)->getFont()->setBold(true);
        $activeSheet->mergeCells('AA' . $rowNum . ':AC' . ($rowNum + 1));

        $activeSheet->setCellValue('AD' . $rowNum, '4. Comments');
        $activeSheet->getStyle('AD' . $rowNum)->getFont()->setBold(true);
        $activeSheet->mergeCells('AD' . $rowNum . ':AD' . ($rowNum + 1));

        $columnNum = 'B';

        foreach ($tableElements as $elementName => $elementDesc) {
            $activeSheet->setCellValue($columnNum . ($rowNum + 1), str_replace(array('student_', 'instructor_'), '', $elementName));
            $columnNum++;
        }
        $rowNum += 2;
    }
    $activeSheet->setCellValue('A' . $rowNum, ($i * 2) . '-' . (($i * 2) + 2) . ' min');

    $columnNum = 'B';

    foreach ($tableElements as $elementName => $elementDesc) {
        if (isset($data['table_' . $elementName][$i])) {
            $activeSheet->getStyle($columnNum . $rowNum)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
            $activeSheet->getStyle($columnNum . $rowNum)->getFill()->getStartColor()->setRGB('000000');
            $activeSheet->setCellValue($columnNum . $rowNum, 1);
        }
        $columnNum++;
    }

    if (isset($data['table_Eng'][$i])) {
        $activeSheet->setCellValue('AA' . $rowNum, $data['table_Eng'][$i]);
        $activeSheet->mergeCells('AA' . $rowNum . ':AC' . $rowNum);
    }
    
    if (isset($data['table_Comments'][$i])) {
        $activeSheet->setCellValue('AD' . $rowNum, $data['table_Comments'][$i]);
    }
    $rowNum++;
}
$activeSheet->getColumnDimension('A')->setWidth(9);
$activeSheet->getColumnDimension('AD')->setWidth(25);

$fileName = 'CDOP-' . strtotime($date) . '-' . $data['observer_name'] . '.xlsx';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$objWriter->save('php://output');
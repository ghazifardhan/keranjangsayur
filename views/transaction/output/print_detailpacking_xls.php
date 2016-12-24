<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

require_once '../../../models/Include.php';
require_once '../../../../phpexcel/Classes/PHPExcel.php';

// query category
// $invoiceCode = isset($_GET['invoice_code']) ? $_GET['invoice_code'] : die('ERROR: Item ID Not Found');

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("KERANJANG SAYUR")
							 ->setLastModifiedBy("KERANJANG SAYUR")
							 ->setTitle("DETAIL PACKING")
							 ->setSubject("DETAIL PACKING")
							 ->setDescription("DETAIL PACKING OF KERANJANG SAYUR")
							 ->setKeywords("DETAIL PACKING")
							 ->setCategory("DETAIL PACKING");

$font = array(
    'font' => array(
        'name' => 'Calibri')
);

$styleArray = array(
    'font' => array(
        'bold' => true,
        'italic' => true,
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
);

$border = array(
        'borders' => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '000000')
            )
        )
    );

$borderTop = array(
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            )
        )
    );

$borderOutline = array(
        'borders' => array(
            'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            ),
            'vertical' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '00b050')
            )
        )
    );

$bold = array(
    'font' => array(
        'bold' => true)
);
    
$color = array( 
    'font' => array(
        'bold' => true,
        'color' => array('rgb' => 'FF0000')
    )
);

$forDesc = array( 
    'font' => array(
        'italic' => true,
        'color' => array('rgb' => 'FF0000')
    )
);

$fillOrder = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFDD00')
                )
);
$fillShip = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FFAA00')
                )
);

$invoice->invoiceDate = $_GET['fromDate'];
$transaction->transactionDate = $invoice->invoiceDate;
$stmt2 = $invoice->getShipping();
$row2 = $stmt2->fetch(PDO::FETCH_OBJ);
$stmt = $transaction->detailPackingSplit();
$num = $stmt->rowCount();
$invDate = $invoice->invoiceDate;
$invDateFormat = date('l, d F Y', strtotime($invDate));
$shipDate = $row2->shipping;
$shipDateFormat = date('l, d F Y', strtotime($shipDate));
 

$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.6);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.6);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.6);
$objPHPExcel->getActiveSheet()->getPageMargins()->setHeader(0.8);
$objPHPExcel->getActiveSheet()->getPageMargins()->setFooter(0.8);

$objPHPExcel->getActiveSheet()->getPageSetup()
    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()
    ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

$objPHPExcel->getActiveSheet()->getStyle('A1:E100')->applyFromArray($font);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(23);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12);
// Header
    
$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($fillOrder);
$objPHPExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($fillShip);
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('A4:F5')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($border);

// Add some data

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ORDER')
            ->setCellValue('B1', $invDateFormat)
            ->setCellValue('A2', 'SHIPPING  ')
            ->setCellValue('B2', $shipDateFormat);


// table
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'ORDER')
            ->setCellValue('A5', 'NYA')
            ->mergeCells('B4:B5')
            ->setCellValue('B4', 'INVOICE')
            ->mergeCells('C4:C5')
            ->setCellValue('C4', 'NAMA')
            ->mergeCells('D4:E5')
            ->setCellValue('D4', 'BANYAKNYA')
            ->mergeCells('F4:F5')
            ->setCellValue('F4', 'KETERANGAN');

$row = 6;
$prevGroup = "";
while ($rowTrans = $stmt->fetch(PDO::FETCH_OBJ)){
			$transaction->invoiceDate = $transaction->transactionDate;
			$transaction->itemId = $rowTrans->item_id;
			$stmtCount = $transaction->countItem();
			$rowCount = $stmtCount->fetch(PDO::FETCH_OBJ);
            $rows = $rowCount->countItem;
            $nums = $row + $rows - 1;
            $group = $rowTrans->item_name;
    
        
            $objPHPExcel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($border);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':E'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    
            $fill = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => array('rgb' => preg_replace('/^#/', '', $rowTrans->highlight_color))
                    )
                );
    
            if($rowTrans->highlight_color != NULL){
                $objPHPExcel->getActiveSheet()->getStyle('A'.$row)->applyFromArray($fill);
                $objPHPExcel->getActiveSheet()->getStyle('D'.$row)->applyFromArray($fill);
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row)->applyFromArray($fill);
            }
            
            if($group !==$prevGroup){
            $objPHPExcel->setActiveSheetIndex(0)
                        ->mergeCells('A'.$row.':A'.$nums)
                        ->setCellValue('A'.$row, strtoupper($rowTrans->item_name));
                        $prevGroup = $group;
            }
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B'.$row, $rowTrans->invoice_code)
                        ->setCellValue('C'.$row, $rowTrans->customer_name)
                        ->setCellValue('D'.$row, $rowTrans->item_qty)
                        ->setCellValue('E'.$row, $rowTrans->unit_name)
                        ->setCellValue('F'.$row, $rowTrans->description);
    $row++;
}

// Rename wo'2016-11-22't
$objPHPExcel->setActiveSheetIndex(0)->setTitle('Sheet1');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=detail_packing-$invoice->invoiceDate.xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
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
                             ->setTitle("DAILY OMZET")
                             ->setSubject("DAILY OMZET")
                             ->setDescription("DAILY OMZET OF KERANJANG SAYUR")
                             ->setKeywords("DAILY OMZET")
                             ->setCategory("DAILY OMZET");

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
                'color' => array('rgb' => '00b050')
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
$stmt2 = $invoice->getShipping();
$row2 = $stmt2->fetch(PDO::FETCH_OBJ);
$stmt3 = $invoice->getTotalInvoice();
$num3 = $stmt3->rowCount();
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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
// Header
    
$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($fillOrder);
$objPHPExcel->getActiveSheet()->getStyle('A2:B2')->applyFromArray($fillShip);
$objPHPExcel->getActiveSheet()->getStyle('A4:G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A4:G5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A4:G5')->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('A4:G5')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A1:B2')->applyFromArray($border);

// Add some data

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ORDER')
            ->setCellValue('B1', $invDateFormat)
            ->setCellValue('A2', 'SHIPPING  ')
            ->setCellValue('B2', $shipDateFormat);


// table
$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A4:A5')
            ->setCellValue('A4', 'INVOICE')
            ->mergeCells('B4:B5')
            ->setCellValue('B4', 'NAME')
            ->mergeCells('C4:C5')
            ->setCellValue('C4', 'ALAMAT')
            ->setCellValue('D4', 'ORDER')
            ->setCellValue('D5', 'NYA')
            ->mergeCells('E4:F5')
            ->setCellValue('E4', 'BANYAKNYA')
            ->setCellValue('G4', 'HARGA SUDAH')
            ->setCellValue('G5', 'DIKALI');
$row = 6;
$stmtInvoice = $invoice->detailPacking();
while ($rowInvoice = $stmtInvoice->fetch(PDO::FETCH_OBJ)){
$transaction->transactionCode = $rowInvoice->invoice_code;
$stmtTrans = $transaction->index();
$totalRowEachInv = $stmtTrans->rowCount();

$phone = $row+1;
$address2 = $row+2;
$address3 = $row+3;
$desc = $row+4;
$pmn = $row+5;
$desc2 = $row+6;
$strVoucher = $row+7;
$voucher = $row+8;

if($rowInvoice->voucher != 0){
    $num = 8;
    $temp = 1;
} else {
    $num = 7;
    $temp = 0;
}

if($totalRowEachInv < 9){
        $rows = $row + $num + $temp;
    } else { $rows = $row + $totalRowEachInv + $temp; }

$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':C'.$rows)->applyFromArray($borderOutline);    
$objPHPExcel->getActiveSheet()->getStyle('C'.$desc.':C'.$desc2)->applyFromArray($color);
$objPHPExcel->getActiveSheet()->getStyle('C'.$address3)->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('C'.$desc.':C'.$desc2)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C'.$desc.':C'.$desc2)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$row, $rowInvoice->invoice_code)
                ->setCellValue('B'.$row, strtoupper($rowInvoice->customer_name))
                ->setCellValue('B'.$phone, $rowInvoice->customer_phone)
                ->setCellValue('C'.$row, $rowInvoice->customer_address)
                ->setCellValue('C'.$address2, $rowInvoice->customer_address_2)
                ->setCellValue('C'.$address3, strtoupper($rowInvoice->customer_address_3))
                ->setCellValue('C'.$desc, strtoupper($rowInvoice->description))
                ->setCellValue('C'.$desc2, strtoupper($rowInvoice->description_2))
                ->setCellValue('C'.$pmn, strtoupper($rowInvoice->payment_method_name));

        if($rowInvoice->voucher != 0){
            $objPHPExcel->getActiveSheet()->getStyle('C'.$voucher.':C'.$voucher)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$voucher)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
            $objPHPExcel->getActiveSheet()->getStyle('C'.$voucher)->applyFromArray($bold);
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('C'.$strVoucher, 'POT/VOUCHER')
                        ->setCellValue('C'.$voucher, $rowInvoice->voucher);
        }

    if($totalRowEachInv < 9){
            $rows = $row + $num;
        } else { $rows = $row + $totalRowEachInv; }

    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':D'.$rows)->applyFromArray($borderOutline);
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row.':G'.$rows)->applyFromArray($borderOutline);
    $objPHPExcel->getActiveSheet()->getStyle('E'.$row.':F'.$rows)->applyFromArray($border);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$rows)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
    while($rowTrans = $stmtTrans->fetch(PDO::FETCH_OBJ)){
        $fill = array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => preg_replace('/^#/', '', $rowTrans->highlight_color))
                    )
                );
        if($rowTrans->highlight_color != NULL){
            $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($fill);
        }
        
        $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
        
        $objPHPExcel->getActiveSheet()->getStyle('H'.$row)->applyFromArray($forDesc);
        
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('D'.$row, strtoupper($rowTrans->item_name))
                ->setCellValue('E'.$row, $rowTrans->item_qty)
                ->setCellValue('F'.$row, $rowTrans->unit_name)
                ->setCellValue('G'.$row, $rowTrans->item_price)
                ->setCellValue('H'.$row, $rowTrans->description);
        $row++;
    }
        
    if($totalRowEachInv < 9){
        //$num = 9 - $totalRowEachInv;
        $row = $row + $num - $totalRowEachInv;
    } else { $row = $row; }
    
    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($border);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($bold);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    
    $totalBeforeDeduction = $rowInvoice->total + $rowInvoice->voucher; 
    $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('D'.$row.':F'.$row)
                ->setCellValue('D'.$row, 'TOTAL')
                ->setCellValue('G'.$row, $totalBeforeDeduction);

    if($rowInvoice->voucher != 0){


    $row = $row + 1;


    $objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($border);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->applyFromArray($bold);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle('D'.$row.':G'.$row)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

    $objPHPExcel->setActiveSheetIndex(0)
                ->mergeCells('D'.$row.':F'.$row)
                ->setCellValue('D'.$row, 'TOTAL SETELAH POT.')
                ->setCellValue('G'.$row, $rowInvoice->total); 
    }

    $row++;
}

$stmt3 = $invoice->getTransfer();
$row3 = $stmt3->fetch(PDO::FETCH_OBJ);
$stmt4 = $invoice->getCash();
$row4 = $stmt4->fetch(PDO::FETCH_OBJ);

$totalCash = $row + 2;
$totalTransfer = $row + 3;
$grandTotal = $row + 4;

$objPHPExcel->getActiveSheet()->getStyle('A'.$totalCash.':B'.$grandTotal)->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('A'.$totalCash.':B'.$grandTotal)->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A'.$totalCash.':B'.$grandTotal)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B'.$totalCash.':B'.$grandTotal)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');

$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$totalCash, 'TOTAL CASH')
                ->setCellValue('B'.$totalCash, $row4->total);

// Rename wo'2016-11-22't
$objPHPExcel->setActiveSheetIndex(0)->setTitle('Sheet1');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=shipping_invoice-$invDate.xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
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
$invoiceCode = $_GET['invoice_code'];

$transaction->transactionCode = $invoiceCode;
$invoice->invoiceCode = $invoiceCode;

$stmt = $transaction->index();

$stmt2 = $invoice->readOne();
$fetch = $stmt2->fetch(PDO::FETCH_OBJ);


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Keranjang Sayur")
							 ->setLastModifiedBy("Keranjang Sayur")
							 ->setTitle("Invoice")
							 ->setSubject("Invoice")
							 ->setDescription("Keranjang Sayur Invoice")
							 ->setKeywords("Keranjang Sayur Invoice")
							 ->setCategory("Invoice");

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
                'color' => array('rgb' => '84C126')
            )
        )
    );

$borderTop = array(
        'borders' => array(
            'top' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array('rgb' => '84C126')
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



$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setHeader(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setFooter(0);

$objPHPExcel->getActiveSheet()->getPageSetup()
    ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
$objPHPExcel->getActiveSheet()->getPageSetup()
    ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A5);

$objPHPExcel->getActiveSheet()->getStyle('A1:E100')->applyFromArray($font);
$objPHPExcel->getActiveSheet()->getStyle('A15')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A16')->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('A6:A9')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A17:E18')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('C11')->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A12')->applyFromArray($color);
$objPHPExcel->getActiveSheet()->getStyle('A13')->applyFromArray($color);
$objPHPExcel->getActiveSheet()->getStyle('A14')->applyFromArray($color);
$objPHPExcel->getActiveSheet()->getStyle('A12:D12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A13:D13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A14:D14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B17:C17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A17:E18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('B6:B16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C16:D16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A17:E18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A17:D18')->applyFromArray($border);

// Add some data
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(19.30);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5.38);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(5.38);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25.38);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(13);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A6', 'No. Invoice')
            ->setCellValue('B6', ':')
            ->setCellValue('C6', $fetch->invoice_code)
            ->setCellValue('A7', 'Nama')
            ->setCellValue('B7', ':')
            ->setCellValue('C7', $fetch->customer_name)
            ->setCellValue('C8', $fetch->customer_phone)
            ->setCellValue('A9', 'Alamat')
            ->setCellValue('B9', ':')
            ->setCellValue('C9', $fetch->customer_address)
            ->setCellValue('C10', $fetch->customer_address_2)
            ->setCellValue('C11', $fetch->customer_address_3)
            ->mergeCells('A12:D12')
            ->setCellValue('A12', strtoupper($fetch->description))
            ->mergeCells('A13:D13')
            ->setCellValue('A13', strtoupper($fetch->payment_method_name))
            ->mergeCells('A14:D14')
            ->setCellValue('A14', strtoupper($fetch->description_2))
            ->setCellValue('A16', 'TGL KIRIM')
            ->setCellValue('B16', ':')
            ->mergeCells('C16:D16')
            ->setCellValue('C16', date('d F Y', strtotime($fetch->shipping_date)));

if($fetch->voucher != 0){
    $objPHPExcel->getActiveSheet()->getStyle('C15')->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A15', 'POT/VOUCHER')
            ->setCellValue('B15', ':')
            ->mergeCells('C15:D15')
            ->setCellValue('C15', $fetch->voucher);
}
// table
$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A17:A18')
            ->setCellValue('A17', 'PESANAN')
            ->mergeCells('B17:C18')
            ->setCellValue('B17', 'QTY')
            ->setCellValue('D17', 'HARGA SUDAH')
            ->setCellValue('D18', 'DIKALI')
            ->mergeCells('E17:E18');

$rowCount = 19;
while($row = $stmt->fetch(PDO::FETCH_OBJ)){
    $fill = array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => preg_replace('/^#/', '', $row->highlight_color))
                )
            );
    
    $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':D'.$rowCount)->applyFromArray($border);
    if($row->highlight_color != NULL){
        $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':D'.$rowCount)->applyFromArray($fill);
    }
    $objPHPExcel->getActiveSheet()->getStyle('D'.$rowCount)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$rowCount, $row->item_name)
            ->setCellValue('B'.$rowCount, $row->item_qty)
            ->setCellValue('C'.$rowCount, $row->unit_name)
            ->setCellValue('D'.$rowCount, $row->item_price)
            ->setCellValue('E'.$rowCount, $row->description);
    $rowCount++;
}
$sum = $rowCount - 1;
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':D'.$rowCount)->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':D'.$rowCount)->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':C'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('D'.$rowCount)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A'.$rowCount.':C'.$rowCount)
            ->setCellValue('A'.$rowCount, 'TOTAL')
            ->setCellValue('D'.$rowCount, '=SUM(D17:D'. $sum .')');

if($fetch->voucher != 0)
{
$temp = $rowCount + 1;
$objPHPExcel->getActiveSheet()->getStyle('A'.$temp.':D'.$temp)->applyFromArray($border);
$objPHPExcel->getActiveSheet()->getStyle('A'.$temp.':D'.$temp)->applyFromArray($bold);
$objPHPExcel->getActiveSheet()->getStyle('A'.$temp.':C'.$temp)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('D'.$temp)->getNumberFormat()->setFormatCode('_("IDR"* #,##0.00_);_("IDR"* \(#,##0.00\);_("IDR"* "-"??_);_(@_)');
$objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('A'.$temp.':C'.$temp)
            ->setCellValue('A'.$temp, 'TOTAL SETELAH POT.')
            ->setCellValue('D'.$temp, '=SUM(D17:D'. $sum .')-C15');
}

$footer = $rowCount + 4;
$objPHPExcel->getActiveSheet()->getStyle('D'.$footer)->applyFromArray($borderTop);
$objPHPExcel->getActiveSheet()->getStyle('D'.$footer)->applyFromArray($styleArray);
$objPHPExcel->getActiveSheet()->getStyle('D'.$footer.':E'.$footer)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D'.$footer, 'QUALITY CONTROL');

// Header
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Header');
$objDrawing->setDescription('Header');
$header = '../../../images/excell2333.png'; // Provide path to your logo file
$objDrawing->setPath($header);
$objDrawing->setWidthAndHeight(496,95);
$objDrawing->setResizeProportional(true);
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Footer
$objDrawing = new PHPExcel_Worksheet_Drawing();
$footerImg = $footer + 1;
$objDrawing->setName('Footer');
$objDrawing->setDescription('Footer');
$logo = '../../../images/excell233.png'; // Provide path to your logo file
$objDrawing->setPath($logo);
$objDrawing->setCoordinates('A'. $footerImg);
$objDrawing->setWidthAndHeight(424,110);
$objDrawing->setResizeProportional(true);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('invoice');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment;filename=invoice-$fetch->invoice_code.xlsx");
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
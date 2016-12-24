<?php

//include '../../../models/Include.php';
require_once '../../../libs/phpexcel/Classes/PHPExcel.php';

// query category
// $invoiceCode = isset($_GET['invoice_code']) ? $_GET['invoice_code'] : die('ERROR: Item ID Not Found');
//$invoiceCode = 'RU/5/22';

//$transaction->transactionCode = $invoiceCode;
//$invoice->invoiceCode = $invoiceCode;

//$stmt = $transaction->index();

//$stmt2 = $invoice->readOne();
//$fetch = $stmt2->fetch(PDO::FETCH_OBJ);

$object = new PHPExcel();

// Set Properties
$object->getProperties()->setCreator("KS")
    ->setLastModifiedBy("KS")
    ->setCategory("Invoice");

// Add Some Data
$object->getActiveSheet()->mergeCells('A13:C13');
$object->getActiveSheet()->mergeCells('A14:C14');
$object->setActiveSheetIndex(0)
    ->setCellValue('A7', 'No. Invoice')
    ->setCellValue('A8', 'Nama')
    ->setCellValue('A10', 'Alamat')
    ->setCellValue('B7', ':')
    ->setCellValue('B8', ':')
    ->setCellValue('B10', ':')
    ->setCellValue('C7', $fetch->invoice_code)
    ->setCellValue('C8', $fetch->customer_name)
    ->setCellValue('C9', $fetch->customer_phone)
    ->setCellValue('C10', $fetch->customer_address)
    ->setCellValue('C11', $fetch->customer_address_2)
    ->setCellValue('C12', $fetch->customer_address_3)
    ->setCellValue('B10', ':')
    ->setCellValue('A16', 'TGL KIRIM')
    ->setCellValue('B16', ':')
    ->setCellValue('C16', $fetch->shipping_date)
    ->setCellValue('C16', $fetch->description)
    ->setCellValue('C16', $fetch->payment_method_name);

// Rename sheet
$object->getActiveSheet()->setTitle('Test');
 
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$object->setActiveSheetIndex(0);
 
 
// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Invoice.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
$objWriter->save('php://output');
exit;
?>



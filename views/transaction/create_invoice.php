<?php

include_once '../../models/Include.php';

$stmt = $setInvoice->getInvoiceCode();
$row = $stmt->fetch(PDO::FETCH_OBJ);

if($row->date != date("Y-m-d")){
	$setInvoice->invoiceCodeOne = $row->invoice_code_1 + 1;
} else {
	$setInvoice->invoiceCodeOne = $row->invoice_code_1;
}

$setInvoice->invoiceCodeTwo = $row->invoice_code_2 + 1;
$setInvoice->date = date("Y-m-d");

$invoice->invoiceCode = $row->sku . "/" . $setInvoice->invoiceCodeOne . "/" . $setInvoice->invoiceCodeTwo;
$invoice->invoiceDate = $_POST['invoiceDate'];
$invoice->customerName = $_POST['customerName'];
$invoice->customerPhone = $_POST['customerPhone'];
$invoice->customerAddress = $_POST['customerAddress'];
$invoice->customerAddress2 = $_POST['customerAddress2'];
$invoice->customerAddress3 = $_POST['customerAddress3'];
$invoice->paymentMethod = $_POST['paymentMethod'];
$invoice->shippingDate = $_POST['shippingDate'];
$invoice->description = $_POST['description'];
$invoice->isPaid = '0';


$invoice->create();
$setInvoice->updateInvoiceCode();


?>
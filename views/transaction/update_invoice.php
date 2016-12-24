<?php
    // include database and object files
    include_once '../../models/Include.php';

    // instantiate database class
    // $database = new Database();
    // $db = $database->getConnection();

    // initialize object
    // $invoice = new invoice($db);

    // set values
	$invoice->invoiceDate = $_POST['invoiceDate'];
	$invoice->customerName = $_POST['customerName'];
	$invoice->customerPhone = $_POST['customerPhone'];
	$invoice->customerAddress = $_POST['customerAddress'];
	$invoice->customerAddress2 = $_POST['customerAddress2'];
	$invoice->customerAddress3 = $_POST['customerAddress3'];
	$invoice->paymentMethod = $_POST['paymentMethod'];
    $invoice->shippingDate = $_POST['shippingDate'];
	$invoice->voucher = $_POST['voucher'];
    $invoice->description = $_POST['description'];
	$invoice->description2 = $_POST['description2'];
    // $invoice->total = $invoice->total - $invoice->voucher;
    $invoice->invoiceCode = $_POST['invoiceCode'];

    // update invoice
    $invoice->update();
?>
<?php

include_once '../../models/Include.php';

/*
$invoiceCode = $_POST['invoiceCode'];


$transaction->transactionCode = $_POST['invoiceCode'];
$invoice->invoiceCode = $transaction->transactionCode;
$transaction->itemId = $_POST['itemId'];

$item->itemId = $transaction->itemId;
$stmt = $item->getItemPrice();
$row = $stmt->fetch(PDO::FETCH_OBJ);

$transaction->itemQty = $_POST['itemQty'];
$transaction->discount = $_POST['discount'];
$transaction->itemPrice = $row->real_price*$transaction->itemQty*((100-$transaction->discount)/100);
$transaction->description = $_POST['description'];

$transaction->create();

$stmt2 = $transaction->getTotal();
$row2 = $stmt2->fetch(PDO::FETCH_OBJ);

$invoice->total = $row2->total;

$invoice->setTotal();
*/


$itemId = $_POST['itemId'];
$itemQty = $_POST['itemQty'];
$discount = $_POST['discount'];
$deduction = $_POST['deduction'];
$description = $_POST['description'];

foreach($itemId as $key => $v){
    $transaction->transactionCode = $_POST['invoiceCode'];
    $invoice->invoiceCode = $transaction->transactionCode;
    $transaction->itemId = $v;
    $item->itemId = $v;
    $stmt = $item->getItemPrice();
    $row = $stmt->fetch(PDO::FETCH_OBJ);
    $transaction->itemQty = $itemQty[$key];
    $transaction->discount = $discount[$key];
    $transaction->deduction = $deduction[$key];
    $transaction->itemPrice = ($row->real_price*$itemQty[$key]*((100-$discount[$key])/100))-$deduction[$key];
    $transaction->description = $description[$key];
    $transaction->create();

    $stmt2 = $transaction->getTotal();
    $row2 = $stmt2->fetch(PDO::FETCH_OBJ);

    $invoice->total = $row2->total;

    $invoice->setTotal();
}

?>


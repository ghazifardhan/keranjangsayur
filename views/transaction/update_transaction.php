<?php

include_once '../../models/Include.php';

$invoiceCode = $_POST['invoiceCode'];
$transactionCode = $_POST['transactionCode'];

$transaction->transactionCode = $transactionCode;
$invoice->invoiceCode = $transaction->transactionCode;

$transaction->transactionId = $_POST['transactionId'];
$transaction->itemId = $_POST['itemId'];

$item->itemId = $transaction->itemId;
$stmt = $item->getItemPrice();
$row = $stmt->fetch(PDO::FETCH_OBJ);

$transaction->itemQty = $_POST['itemQty'];
$transaction->discount = $_POST['discount'];
$transaction->deduction = $_POST['deduction'];
$transaction->itemPrice = ($row->real_price*$transaction->itemQty*((100-$transaction->discount)/100))-$transaction->deduction;
$transaction->description = $_POST['description'];

$transaction->update();

$stmt2 = $transaction->getTotal();
$row2 = $stmt2->fetch(PDO::FETCH_OBJ);

$invoice->total = $row2->total;

$invoice->setTotal();

?>


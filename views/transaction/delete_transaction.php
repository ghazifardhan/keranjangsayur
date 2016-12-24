<?php

include_once '../../models/Include.php';

$transaction->transactionId = $_POST['transaction_id'];
$transaction->transactionCode = $_POST['transaction_code'];

$transaction->delete();

$stmt2 = $transaction->getTotal();
$row2 = $stmt2->fetch(PDO::FETCH_OBJ);

$invoice->total = $row2->total;
$invoice->invoiceCode = $transaction->transactionCode;

$invoice->setTotal();

?>
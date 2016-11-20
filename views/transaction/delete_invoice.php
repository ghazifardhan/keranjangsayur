<?php

include_once '../../models/Include.php';

$invoice->invoiceId = $_POST['invoice_id'];
$transaction->transactionCode = $_POST['invoice_code'];

$invoice->delete();
$transaction->destroy();

?>

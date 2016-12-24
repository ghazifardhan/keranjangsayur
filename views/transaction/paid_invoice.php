<?php

include_once '../../models/Include.php';

$invoice->invoiceCode = $_POST['invoice_code'];

$invoice->paid();

?>
<?php

include_once '../../models/Incude.php';

$invoice->invoiceDate = $_POST['fromDate'];

$invoice->detailPackingSplit();

?>
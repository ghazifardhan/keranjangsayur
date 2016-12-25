<?php

include_once '../../models/Include.php';

$customer->customerId = $_POST['customer_id'];
$customer->delete();
$voucher->destroy();

?>
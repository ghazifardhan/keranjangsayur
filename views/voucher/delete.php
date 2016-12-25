<?php

include_once '../../models/Include.php';

$voucher->voucherId = $_POST['voucher_id'];
$voucher->delete();

?>
<?php
    // include database and object files
    include_once '../../models/Include.php';

    // instantiate database class
    // $database = new Database();
    // $db = $database->getConnection();

    // initialize object
    // $voucher = new voucher($db);

    // set values
    $voucher->customerId = $_POST['customerId'];
    $voucher->voucherValue = $_POST['voucherValue'];
    $voucher->status = '0';

    // create voucher
    $voucher->create();
?>
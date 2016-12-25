<?php
    // include database and object files
    include_once '../../models/Include.php';

    // instantiate database class
    // $database = new Database();
    // $db = $database->getConnection();

    // initialize object
    // $voucher = new voucher($db);

    // set values
    $voucher->voucherId = $_POST['voucherId'];
    $voucher->voucherValue = $_POST['voucherValue'];

    // create voucher
    $voucher->update();
?>
<?php
    // include database and object files
    include_once '../../models/Include.php';

    // instantiate database class
    // $database = new Database();
    // $db = $database->getConnection();

    // initialize object
    // $customer = new customer($db);

    // set values
    $customer->customerName = $_POST['customerName'];
    $customer->customerType = $_POST['customerType'];
    $customer->description = $_POST['description'];

    // create customer
    $customer->create();
?>
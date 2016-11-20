<?php
    // include database and object files
    include_once '../../models/Include.php';

    // instantiate database class
    // $database = new Database();
    // $db = $database->getConnection();

    // initialize object
    // $unit = new unit($db);

    // set values
    $unit->unitName = $_POST['unitName'];
    $unit->description = $_POST['description'];
    $unit->unitId = $_POST['unitId'];

    // update unit
    $unit->update();
?>
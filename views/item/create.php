<?php
    // include database and object files
    include_once '../../models/Include.php';

    // instantiate database class
    // $database = new Database();
    // $db = $database->getConnection();

    // initialize object
    // $item = new item($db);

    // set values
    $item->itemName = $_POST['itemName'];
    $item->categoryId = $_POST['categoryId'];
    $item->unitId = $_POST['unitId'];
    $item->price = $_POST['price'];
    $item->onQty = $_POST['onqty'];
    $item->description = $_POST['description'];
    if($item->unitId == '1'){
        $item->realPrice = $item->price / $item->onQty;
    } else {
        $item->realPrice = $item->price;
    }
	$item->highlightId = $_POST['highlightId'];
    // create item
    $item->create();
?>
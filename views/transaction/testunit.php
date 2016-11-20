<?php

include_once '../../models/Include.php';

$q = $_GET['item_id'];

$item->itemId = $q;

$stmt = $item->getUnit;

$row = $stmt->fetch(PDO::FETCH_OBJ);

echo $row->unit_name;

?>
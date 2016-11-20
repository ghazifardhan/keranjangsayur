<?php
header('Content-type: application/json');
include_once '../models/Include.php';

$item->itemId = $_GET['item_id'];

$stmt = $item->readOne();
$rows = array();
while ($r = $stmt->fetch(PDO::FETCH_OBJ)){
    $rows[] = $r;
}

print json_encode($rows);

?>
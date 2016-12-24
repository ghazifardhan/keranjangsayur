<?php
header('Content-type: application/json');
include_once '../models/Include.php';


$stmt = $item->indexAll();
$rows = array();
while ($r = $stmt->fetch(PDO::FETCH_OBJ)){
    $rows[] = $r;
}

print json_encode($rows);

?>
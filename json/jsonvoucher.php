<?php
header('Content-type: application/json');
include_once '../models/Include.php';

$voucher->customerId = $_GET['customer_id'];

$stmt = $voucher->index();
$rows = array();
while ($r = $stmt->fetch(PDO::FETCH_OBJ)){
	$rows[] = $r;	
}

print json_encode($rows);
?>
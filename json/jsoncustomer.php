<?php
header('Content-type: application/json');
include_once '../models/Include.php';


$stmt = $customer->indexAll();
$rows = array();
while ($r = $stmt->fetch(PDO::FETCH_OBJ)){
	//$rows[] = $r;


	$rows[] = array(
		'label' => $r->customer_name,
    	'value' => $r->customer_name,
    	'name' => $r->customer_name,
    	'id' => $r->customer_id
	);
	
}

print json_encode($rows);

?>
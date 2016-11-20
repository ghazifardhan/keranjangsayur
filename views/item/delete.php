<?php

include_once '../../models/Include.php';

$item->itemId = $_POST['item_id'];
$item->delete();

?>
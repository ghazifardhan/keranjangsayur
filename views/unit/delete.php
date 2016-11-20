<?php

include_once '../../models/Include.php';

$unit->unitId = $_POST['unit_id'];
$unit->delete();

?>
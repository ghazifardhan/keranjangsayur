<?php

include_once '../../models/Include.php';

$user->userId = $_POST['user_id'];
$user->delete();

?>
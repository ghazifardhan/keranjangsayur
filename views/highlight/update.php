<?php

include_once '../../models/Include.php';

$highlight->highlightName = $_POST['highlightName'];
$highlight->highlightColor = $_POST['highlightColor'];
$highlight->description = $_POST['description'];
$highlight->highlightId = $_POST['highlightId'];

$highlight->update();

?>
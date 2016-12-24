<?php

include_once '../../models/Include.php';

$category->categoryId = $_POST['category_id'];
$category->delete();

?>
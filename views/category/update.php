<?php
    // include database and object files
    include_once '../../models/Include.php';

    // instantiate database class
    // $database = new Database();
    // $db = $database->getConnection();

    // initialize object
    // $category = new Category($db);

    // set values
    $category->categoryName = $_POST['categoryName'];
    $category->description = $_POST['description'];
    $category->categoryId = $_POST['categoryId'];

    // update category
    $category->update();
?>
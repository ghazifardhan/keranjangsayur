<?php
session_start();

spl_autoload_register(function ($class)
					  {
						  include $class . '.php';
					  });

$database = new Database();
$db = $database->connectDB();

$category = new Category($db);
$item = new Item($db);
$unit = new Unit($db);
$transaction = new Transaction($db);
$invoice = new Invoice($db);
$user = new User($db);
$payment = new Payment($db);
$setInvoice = new SetInvoice($db);
$paging = new Paging($db);
$highlight = new Highlight($db);

?>
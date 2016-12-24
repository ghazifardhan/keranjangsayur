<?php
include 'database.class.php';
include 'excel_reader2.php';

$method = $_POST['method'];

if($method == 'category')
{
	$dbh = $db->connect();

	$data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
	$hasildata = $data->rowcount($sheet_index=0);

for ($i=2;$i<=$hasildata;$i++)
{
	$category_name = $data->val($i,1);
	$description = $data->val($i,2);
	
	$query = mysqli_query($dbh, 
	"INSERT INTO t_category (category_name, description) VALUES ('$category_name', '$description')"); 
	
}
}

if($method == 'unit')
{
	$dbh = $db->connect();

	$data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
	$hasildata = $data->rowcount($sheet_index=0);

for ($i=2;$i<=$hasildata;$i++)
{
	$unit_name = $data->val($i,1);
	$description = $data->val($i,2);
	
	$query = mysqli_query($dbh, 
	"INSERT INTO t_unit (unit_name, description) VALUES ('$unit_name', '$description')"); 
	
}
}

if($method == 'item')
{
	$dbh = $db->connect();

	$data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
	$hasildata = $data->rowcount($sheet_index=0);

for ($i=2;$i<=$hasildata;$i++)
{
	$item_name = $data->val($i,1);
	$category_id = $data->val($i,2);
	$unit_id = $data->val($i,3);
	$price = $data->val($i,4);
	$onqty = $data->val($i,5);
	$description = $data->val($i,6);
	$realPrice = $data->val($i,7);
	
	$query = mysqli_query($dbh, 
	"INSERT INTO t_item (item_name, category_id, unit_id, price, onqty, description, real_price) VALUES 
	(
	'$item_name', 
	'$category_id', 
	'$unit_id',
	'$price',
	'$onqty',
	'$description',
	'$realPrice'
	)"); 
	
}
}

if($method == 'update_item')
{
	$dbh = $db->connect();

	$data = new Spreadsheet_Excel_Reader($_FILES['fileexcel']['tmp_name']);
	$hasildata = $data->rowcount($sheet_index=0);

for ($i=2;$i<=$hasildata;$i++)
{
	$item_id = $data->val($i,1);
	$highlight_id = $data->val($i,2);
	
	$query = mysqli_query($dbh, 
	"UPDATE t_item SET 
	 highlight_id = '$highlight_id'
	 WHERE item_id = '$item_id'
	");
}
}

?>
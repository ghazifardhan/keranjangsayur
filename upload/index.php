<!DOCTYPE html>
<html>
<head>
<title>Import Rekening</title>
</head>
<body>
<form name='import' enctype="multipart/form-data" action='cek_proses.php' method='post'>
<table>
	<tr><td><label>Keranjang Sayur</label></td><td>
		<input type="radio" name="method" value="category">Category
		<input type="radio" name="method" value="item">Item	
		<input type="radio" name="method" value="unit">Unit
		<input type="radio" name="method" value="update_item">Update Item
		</td></tr>
	<tr><td><input name='fileexcel' type='file'></td>
		<td><input type='submit' name='submit' value='import'></td></tr>
	</table>
</form>
</body>
</html>

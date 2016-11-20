<?php

require_once '../../models/Include.php';

?>

<div class="left">
	<h3>Input Transaction</h3>
	<form id="create_transacntion" action="#" method="POST" border='0'>
        <table class='table table-hover table-responsive table-bordered'>
			<tr>
				<td>Customer Name</td>
				<td><input type="text" name="customerName" class="form-control" /></td>
			</tr>
			<tr>
				<td>Customer Phone</td>
				<td><input type="text" name="customerName" class="form-control" /></td>
			</tr>
			<tr>
				<td>Customer Address</td>
				<td><input type="text" name="customerName" class="form-control" /></td>
			</tr>
			<tr>
				<td>Item Name</td>
				<td><select data-placeholder="Choose Category" name="categoryId" class="form-control chosen-select">
                    <option value=""></option>
                    <?php 
                    
                    $stmt = $item->index();
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)){                    
                    ?>
                    <option value="<?php echo $row->item_id; ?>"><?php echo $row->item_name; ?></option>
                    <?php
                    }
                    ?>
                    </select></td>
			</tr>
			<tr>
				<td>Qty</td>
				<td><input type="text" name="customerName" class="form-control" /></td>
			</tr>
			<tr>
				<td>Qty</td>
				<td><input type="text" name="customerName" class="form-control" /></td>
			</tr>
</div>
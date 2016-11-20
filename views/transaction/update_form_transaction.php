<?php

require_once '../../models/Include.php';

$transactionId = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : die('Error: Transaction ID not found!');
$transactionCode = $_GET['transaction_code'];

$transaction->transactionId = $transactionId;

$stmt = $transaction->showOne();
$fetch = $stmt->fetch(PDO::FETCH_OBJ);
?>

<div class="left">
	<h1>Edit Transaction:</h1>
	<form id="update_transaction" action="javascript://" method="POST" border='0'>
		<input type="hidden" name="transactionId" value="<?php echo $transactionId; ?>" /> 
		<input type="hidden" name="transactionCode" value="<?php echo $transactionCode; ?>" /> 
        <table class='table table-hover table-responsive table-bordered'>
			<tr>
				<td>Item Name</td>
				<td><select id="item1" data-placeholder="Choose Item" name="itemId" class="form-control chosen-select" required>
                    <option value=""></option>
                    <?php 
                    
                    $stmt2 = $item->indexAll();
                    while ($row = $stmt2->fetch(PDO::FETCH_OBJ)){                    
                    ?>
                    <option value="<?php echo $row->item_id; ?>" <?php if($row->item_id == $fetch->item_id){ echo 'selected';}?>><?php echo $row->item_name; ?></option>
                    <?php
                    }
                    ?>
                    </select></td>
			</tr>
			<tr>
				<td>Qty</td>
				<td><div id="result1"><div class="input-group"><input type="text" name="itemQty" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control"  value="<?php echo $fetch->item_qty; ?>" required/><span class="input-group-addon" id="basic-addon2"><?php echo $fetch->unit_name; ?></span></div></div></td>
			</tr>
			<tr>
				<td>Discount</td>
				<td><div class="input-group"><input type="number" name="discount" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" aria-describedby="basic-addon2" value="<?php echo $fetch->discount; ?>"/>
					<span class="input-group-addon" id="basic-addon2">%</span></div>
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input type="text" name="description" class="form-control"  value="<?php echo $fetch->description; ?>"/></td>
			</tr>
			<tr>
                <td><div class="transactionCode display-none"><?php echo $transactionCode; ?></div></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>
</div>
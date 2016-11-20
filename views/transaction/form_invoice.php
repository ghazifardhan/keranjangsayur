<?php

require_once '../../models/Include.php';

?>	
	<h1>Create New Invoice</h1>
	<form id="form_create_invoice" action="javascript://" method="POST" border='0'>
        <table class='table table-hover table-responsive table-bordered'>
			</tr>
				<td>Invoice Date</td>
				<td><input type="date" name="invoiceDate" class="form-control" /></td>
			</tr>
			<tr>
				<td>Customer Name</td>
				<td><input type="text" name="customerName" class="form-control" /></td>
			</tr>
			<tr>
				<td>Customer Phone</td>
				<td><input type="text" name="customerPhone" class="form-control" /></td>
			</tr>
			<tr>
				<td>Address 1</td>
				<td><input type="text" name="customerAddress" class="form-control" maxlength="50"/></td>
			<tr>
			<tr>
				<td>Address 2</td>
				<td><input type="text" name="customerAddress2" class="form-control" maxlength="50"/></td>
			<tr>
			<tr>
				<td>Address 3</td>
				<td><input type="text" name="customerAddress3" class="form-control" maxlength="50"/></td>
			<tr>
            <tr>
				<td>Payment Method</td>
				<td>
                <select name="paymentMethod" class="form-control">
                    <?php 
                    
                    $stmt = $payment->index();
                    while($row = $stmt->fetch(PDO::FETCH_OBJ)){
                    
                    ?>
                    <option value="<?php echo $row->payment_method_id;?>"><?php echo $row->payment_method_name;?></option>
                    <?php
                    }
                    ?>
                </select>
                </td>
            </tr>
            </tr>
				<td>Shipping Date</td>
				<td><input type="date" name="shippingDate" class="form-control" /></td>
			</tr>
			<tr>
			<tr>
				<td>Description</td>
				<td><input type="text" name="description" class="form-control" /></td>
			<tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>
        </form>
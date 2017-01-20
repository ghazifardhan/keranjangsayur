<?php

require_once '../../models/Include.php';

$stmt = $setInvoice->getInvoiceCode();
$row = $stmt->fetch(PDO::FETCH_OBJ);
if($row->date != date("Y-m-d")){
	$setInvoice->invoiceCodeOne = $row->invoice_code_1 + 1;
} else {
	$setInvoice->invoiceCodeOne = $row->invoice_code_1;
}

$setInvoice->invoiceCodeTwo = $row->invoice_code_2 + 1;
$setInvoice->date = date("Y-m-d");

$invoiceCode = $row->sku . "/" . $setInvoice->invoiceCodeOne . "/" . $setInvoice->invoiceCodeTwo;

?>	
	<h1>Create New Invoice</h1>
	<form id="form_create_invoice" action="javascript://" method="POST" border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
				<td>Invoice Code</td>
				<td><input type="text" id="invoiceCode" name="invoiceCode" class="form-control" value="<?php echo $invoiceCode;?>" readonly/></td>
			</tr>
			<tr>
				<td>Invoice Date</td>
				<td><input type="date" name="invoiceDate" class="form-control" required/></td>
			</tr>
			<tr>
				<td>Customer Name</td>
				<td><input type="text" name="customerName" class="form-control customerName" required/></td>
			</tr>
			<tr>
				<td>Customer Phone</td>
				<td><input type="text" name="customerPhone" class="form-control" required/></td>
			</tr>
			<tr>
				<td>Address 1</td>
				<td><input type="text" name="customerAddress" class="form-control" maxlength="40" placeholder="Jalan, RT/RW, No Rumah" required/></td>
			</tr>
			<tr>
				<td>Address 2</td>
				<td><input type="text" name="customerAddress2" class="form-control" maxlength="40" placeholder="Kecamatan, Kelurahan" required/></td>
			</tr>
			<tr>
				<td>Address 3</td>
				<td><input type="text" name="customerAddress3" class="form-control" maxlength="40" placeholder="Kota" required/></td>
			</tr>
            <tr>
				<td>Payment Method</td>
				<td>
                <select name="paymentMethod" class="form-control" required>
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
            <tr>
				<td>Shipping Date</td>
				<td><input type="date" name="shippingDate" class="form-control" required/></td>
			</tr>
            <tr>
				<td>Potongan/Voucher</td>
				<td><select id="voucherChooser" data-placeholder="Voucher" name="voucherChooser" class="form-control" multiple="multiple" style="width: 300px">
                    </select>

                    <input type="number" id="voucherResult" name="voucher" class="form-control number" readonly="readonly"  style="width: 300px"/>
                    </td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input type="text" name="description" class="form-control" /></td>
			</tr>
			<tr>
				<td>Description 2</td>
				<td><input type="text" name="description2" class="form-control" /></td>
			</tr>
			<tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>
        </form>
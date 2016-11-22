<?php

require_once '../../models/Include.php';

// query category
// $invoiceCode = isset($_GET['invoice_code']) ? $_GET['invoice_code'] : die('ERROR: Item ID Not Found');
$invoiceCode = $_GET['invoice_code'];	


$transaction->transactionCode = $invoiceCode;
$invoice->invoiceCode = $invoiceCode;

$stmt = $transaction->index();

$stmt2 = $invoice->readOne();
$fetch = $stmt2->fetch(PDO::FETCH_OBJ);
// check if more than 0 record found in category table

?>
<table>
<tr>
<td>
<div class="invoiceCode display-none"><?php echo $invoiceCode; ?></div>
<?php if($fetch->is_paid == '1')
{
    ?>
    <button class="btn btn-success create-btn-transaction margin-right-1em" disabled><span class='glyphicon glyphicon-ok'></span> Paid</button>
<?php
} else {?>
    <button class="btn btn-info create-btn-transaction margin-right-1em" <?php if($fetch->is_paid == '1'){ echo 'disabled';}?>><span class='glyphicon glyphicon-plus'></span> New Transaction</button>
<?php    
    }
?>
</td>
<!--
<form action='/nsproject/views/transaction/print_invoice.php' method="post" target="_blank"> -->
<td>
    <div class="invoiceCode display-none"><?php echo $fetch->invoice_code;?></div>
    <input type="hidden" name="invoiceCode" value="<?php echo $fetch->invoice_code;?>" />
    <button type="submit" class="btn btn-danger print-btn-transaction-pdf margin-right-1em"><span class='glyphicon glyphicon-print'></span> Print PDF</button>
</td>
<td>
    <div class="invoiceCode display-none"><?php echo $fetch->invoice_code;?></div>
    <input type="hidden" name="invoiceCode" value="<?php echo $fetch->invoice_code;?>" />
    <button type="submit" class="btn btn-success print-btn-transaction-xls margin-right-1em"><span class='glyphicon glyphicon-print'></span> Print XLS</button>
</td>
<!-- </form> -->
</tr>
</table>
<br/>
<table class="table table-striped table-condensed">
    <tr>
        <td>Invoice Code</td>
        <td>: <?php echo $fetch->invoice_code;?></td>
    </tr>
    <tr>
        <td>Customer Name</td>
        <td>: <?php echo $fetch->customer_name;?></td>
    </tr>
    <tr>
        <td>Customer Phone</td>
        <td>: <?php echo $fetch->customer_phone;?></td>
    </tr>
    <tr>
        <td>Address 1</td>
        <td>: <?php echo $fetch->customer_address;?></td>
    </tr>
    <tr>
        <td>Address 2</td>
        <td>: <?php echo $fetch->customer_address_2;?></td>
    </tr>
    <tr>
        <td>Address 3</td>
        <td>: <?php echo $fetch->customer_address_3;?></td>
    </tr>
	<tr>
        <td>Payment Method</td>
        <td>: <?php echo $fetch->payment_method_name;?></td>
    </tr>
	<tr>
        <td>Invoice Date</td>
        <td>: <?php echo $fetch->invoice_date;?></td>
    </tr>
	<tr>
        <td>Shipping Date</td>
        <td>: <?php echo $fetch->shipping_date;?></td>
    </tr>
    <tr>
        <td>Description</td>
        <td>: <?php echo $fetch->description;?></td>
    </tr>
</table>
<br/>
<table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th class='col-md-2'>#</th>
            <th class='col-md-2'>Item Name</th>
            <th class='col-md-2'>Qty</th>
            <th class='col-md-2'>Unit</th>
            <th class='col-md-2'>Discount</th>
            <th class='col-md-2'>Price</th>
            <th class='col-md-2'>Description</th>
            <th class='col-md-2'>Menu</th>
            <!--<th>Option</th>-->
        </tr>
		<?php
        $totalPrice = 0;
	    $no = 1;
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
			
        ?>
        <tr>
            <td class='col-md-2'><?php echo $no; ?></td>
            <td class='col-md-2'><?php echo $row->item_name; ?></td>
            <td class='col-md-2'><?php echo $row->item_qty; ?></td>
            <td class='col-md-2'><?php echo $row->unit_name; ?></td>
            <td class='col-md-2'><?php echo $row->discount . "%"; ?></td>
            <td class='col-md-2'><?php 
			$price = $row->item_price;
			echo number_format($price,0,',','.'); ?></td>
			<td class='col-md-2'><?php echo $row->description; ?></td>
			<td>
				<div class="transactionId display-none"><?php echo $row->transaction_id; ?></div>
                <div class="transactionCode display-none"><?php echo $row->transaction_code; ?></div>
				<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle margin-right-1em" type="button" data-toggle="dropdown">Menu
				<span class="caret"></span></button>
					<ul class="dropdown-menu dropdown-menu-right">
						<li class="<?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){ echo 'disabled';}?>"><a href="javascript://" class="edit-btn-transaction <?php if($fetch->is_paid == '1' || $_SESSION['level'] == '1'){ echo 'not-active';}?>">Edit Item</a></li>
						<li class="<?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){ echo 'disabled';}?>"><a href="javascript://" class="delete-btn-transaction <?php if($fetch->is_paid == '1' || $_SESSION['level'] == '1'){ echo 'not-active';}?>">Delete Item</a></li>
					</ul>
				</div>
			</td>
        </tr>
		<?php
            $no++;
			$totalPrice += $price; 
		}
		?>
		<tr>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
            <td class='col-md-2'></td>
        </tr>
		<tr>
            <td class='col-md-2' colspan="4"><strong>Grand Total</strong></td>
            <td class='col-md-2'><strong><?php echo number_format($totalPrice,0,',','.');?></td>
			<td class='col-md-2'></td>
        </tr>
    </table>
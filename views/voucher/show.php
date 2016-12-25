<?php
error_reporting(0);
require_once '../../models/Include.php';

// query voucher
$customerId = $_GET['customer_id'];
$voucher->customerId = $customerId;
$stmt = $voucher->index();
// check if more than 0 record found in voucher table
?>

<button id="add_voucher" class="btn btn-primary">Add Voucher</button>
<input type="text" id="customerId" value="<?php echo $customerId;?>">
    <h1>Voucher</h1>
    <br/>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th>Voucher</th>
            <th>Status</th>
            <th>Invoice</th>
            <th>Option</th>
        </tr>
        
        <?php
        
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
        ?>
        <tr>
            <td><?php echo $row->voucher_value; ?></a></td>
            <td><?php echo $row->status; ?></td>
            <td><?php echo $row->invoice_id; ?></td>
            <td>
            <div class="voucherId display-none"><?php echo $row->voucher_id; ?></div>
            <div class="customerId display-none"><?php echo $row->customer_id; ?></div>
            
            <!-- update button -->
            <button class="btn btn-info edit-btn-voucher margin-right-1em" <?php if($_SESSION['level'] == '1'){ echo 'disabled';}?>>
                <span class='glyphicon glyphicon-edit'></span> Edit   
            </button>
                
            <!-- delete button -->
            <button class='btn btn-danger delete-btn-voucher margin-right-1em' <?php if($_SESSION['level'] == '1'){ echo 'disabled';}?>>
            	<span class='glyphicon glyphicon-remove'></span> Delete   
            </button>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <!--
	<nav aria-label="Page Navigation">
        <center><ul class="pagination">
		<?php for($x=1;$x<=$totalData;$x++){ 
				if((($x >= $page - 5) && ($x <= $page + 5))){
			?>
			<li class="<?php if($page == $x) { echo 'active';}?>"><a class='btn-paging-voucher paging-voucher' href="javascript://"><?php echo $x;?></a></li>
		<?php } } ?>
        </ul></center>
    </nav>
    -->
<?php
 

?>
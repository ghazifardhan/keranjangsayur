<?php

require_once '../../models/Include.php';

// query category
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : "";
$offset = 25;
if($page == 0){
	$page = 1;
}
$pages = $page - 1;
$position = $pages*$offset;
$stmt = $invoice->index($position,$offset);
$stmt2 = $paging->setCount('t_invoice');
$num = $stmt2->rowCount();
$totalData = ceil($num/$offset);
?>
<!--
<button id="btn-create-invoice" type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> New
Invoice</button>
-->
<?php
if($num>0){
	?>
    <h1>Invoice</h1>
    <div class="input-group">
      <input type="text" id="search-box-invoice" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
			<button class="btn btn-default btn-search-invoice">Search</button>
	  </span>
    </div><!-- /input-group -->
    <br/>
	<table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th>Invoice Code</th>
            <th>Customer Name</th>
            <th>Customer Phone</th>
            <th>Customer Address</th>
            <th>Total</th>
            <th>Description</th>
            <th>Created At</th>
            <th>Option</th>
        </tr>
        
        <?php
        
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
        ?>
        <tr>
            <td><?php echo $row->invoice_code; ?></td>
            <td><?php echo $row->customer_name; ?></td>
            <td><?php echo $row->customer_phone; ?></td>
            <td><?php echo $row->customer_address; ?></td>
            <td><?php echo number_format($row->total,2,',','.'); ?></td>
            <td><?php echo $row->description; ?></td>
            <td><?php echo $row->created_at; ?></td>
            <td>
				<div class="invoiceId display-none"><?php echo $row->invoice_id; ?></div>
                <div class="invoiceCode display-none"><?php echo $row->invoice_code; ?></div>
				<div class="dropdown">
				<button class="btn btn-primary dropdown-toggle margin-right-1em" type="button" data-toggle="dropdown">Menu
				<span class="caret"></span></button>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="javascript://" class="show-btn-invoice">Show Invoice</a></li>
						<li class="<?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){ echo 'disabled';}?>"><a href="javascript://" class="edit-btn-invoice <?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){ echo 'not-active';}?>">Edit Invoice</a></li>
						<li class="<?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){ echo 'disabled';}?>"><a href="javascript://" class="delete-btn-invoice <?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){ echo 'not-active';}?>">Delete</a></li>
					</ul>
				<?php
                    if($row->is_paid == '1'){
                ?>
                <button class='btn btn-success unpaid-btn-invoice margin-right-1em' <?php if($_SESSION['level'] == '1' || $_SESSION['level'] == '2'){ echo 'disabled';} ?>>
                    <span class='glyphicon glyphicon-ok'></span> Paid   
                </button>
                <?php
                    } else {
                ?>
                <button class='btn btn-warning paid-btn-invoice margin-right-1em'>
                    <span></span> Unpaid   
                </button>
                <?php
                    }
                ?>
				</div>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
	<nav aria-label="Page Navigation">
        <center><ul class="pagination">
		<?php for($x=1;$x<=$totalData;$x++){ 
			if((($x >= $page - 5) && ($x <= $page + 5))){?>
			<li class="<?php if($page == $x) { echo 'active';}?>"><a class='btn-paging-invoice paging-invoice' href="javascript://"><?php echo $x;?></a></li>
		<?php } }?>
        </ul></center>
    </nav>

<?php
} else {
	echo "<div class='alert alert-info'>No Transaction found.</div>";
}
?>
<?php
//error_reporting(0);
require_once '../../models/Include.php';

// query customer
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : "";
$offset = 25;
if($page == 0){
	$page = 1;
}
$pages = $page - 1;
$position = $pages*$offset;
$stmt = $customer->index($position,$offset);
$stmt2 = $paging->setCount('customer');
$num = $stmt2->rowCount();
$totalData = ceil($num/$offset);
// check if more than 0 record found in customer table
if($num>0){
    
?>
    <h1>customer</h1>
	<div class="input-group">
      <input type="text" id="search-box-customer" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
			<button class="btn btn-default btn-search-customer">Search</button>
	  </span>
    </div><!-- /input-group -->
    <br/>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th>Customer Name</th>
            <th>Customer Type</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
        
        <?php
        
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
        ?>
        <tr>
            <input type="hidden" id="cId" value="<?php echo $row->customer_id;?>">
            <td><a href="javascript://" id="show_voucher"><?php echo $row->customer_name; ?></a></td>
            <td><?php if($row->customer_type == '0'){echo 'Regular';} else { echo 'Restaurant';}?></td>
            <td><?php echo $row->description; ?></td>
            <td>
            <div class="customerId display-none"><?php echo $row->customer_id; ?></div>
            
            <!-- update button -->
            <button class="btn btn-info edit-btn-customer margin-right-1em" <?php if($_SESSION['level'] == '1'){ echo 'disabled';}?>>
                <span class='glyphicon glyphicon-edit'></span> Edit   
            </button>
                
            <!-- delete button -->
            <button class='btn btn-danger delete-btn-customer margin-right-1em' <?php if($_SESSION['level'] == '1'){ echo 'disabled';}?>>
            	<span class='glyphicon glyphicon-remove'></span> Delete   
            </button>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
	<nav aria-label="Page Navigation">
        <center><ul class="pagination">
		<?php for($x=1;$x<=$totalData;$x++){ 
				if((($x >= $page - 5) && ($x <= $page + 5))){
			?>
			<li class="<?php if($page == $x) { echo 'active';}?>"><a class='btn-paging-customer paging-customer' href="javascript://"><?php echo $x;?></a></li>
		<?php } } ?>
        </ul></center>
    </nav>
<?php
    
    } else {
    echo "<div class='alert alert-info'>No records found.</div>";
}

?>
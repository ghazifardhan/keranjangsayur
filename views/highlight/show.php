<?php

require_once '../../models/Include.php';

// query highlight
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : "";
$offset = 25;
if($page == 0){
	$page = 1;
}
$pages = $page - 1;
$position = $pages*$offset;
$stmt = $highlight->index($position,$offset);
$stmt2 = $paging->setCount('t_highlight');
$num = $stmt2->rowCount();
$totalData = ceil($num/$offset);
// check if more than 0 record found in highlight table
if($num>0){
    
?>
    <h1>Highlight</h1>
	<div class="input-group">
      <input type="text" id="search-box-highlight" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
			<button class="btn btn-default btn-search-highlight">Search</button>
	  </span>
    </div><!-- /input-group -->
    <br/>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th>Highlight Name</th>
            <th>Highlight Color</th>
            <th>Description</th>
            <th>Option</th>
        </tr>
        
        <?php
        
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
        ?>
        <tr>
            <td><?php echo $row->highlight_name; ?></td>
            <td><?php echo $row->highlight_color; ?></td>
            <td><?php echo $row->description; ?></td>
            <td>
            <div class="highlightId display-none"><?php echo $row->highlight_id; ?></div>
            
            <!-- update button -->
            <button class="btn btn-info edit-btn-highlight margin-right-1em" <?php if($_SESSION['level'] == '1'){ echo 'disabled';}?>>
                <span class='glyphicon glyphicon-edit'></span> Edit   
            </button>
                
            <!-- delete button -->
            <button class='btn btn-danger delete-btn-highlight margin-right-1em' <?php if($_SESSION['level'] == '1'){ echo 'disabled';}?>>
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
			<li class="<?php if($page == $x) { echo 'active';}?>"><a class='btn-paging-highlight paging-highlight' href="javascript://"><?php echo $x;?></a></li>
		<?php } } ?>
        </ul></center>
    </nav>
<?php
    
    } else {
    echo "<div class='alert alert-info'>No records found.</div>";
}

?>
<?php

require_once '../../models/Include.php';

// query user
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : "";
$offset = 25;
if($page == 0){
	$page = 1;
}
$pages = $page - 1;
$position = $pages*$offset;
$stmt = $user->index($position,$offset);
$stmt2 = $paging->setCount('user');
$num = $stmt2->rowCount();
$totalData = ceil($num/$offset);

// check if more than 0 record found in category table
if($num>0){
    
?>
    <h1>User</h1>
	<div class="input-group">
      <input type="text" id="search-box-user" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
			<button class="btn btn-default btn-search-user">Search</button>
	  </span>
    </div><!-- /input-group -->
    <br/>
	<button class="btn btn-primary btn-create-user">Create User</button>
	<br/>
	<br/>
    <table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th>UserId</th>
            <th>Username</th>
            <th>Level</th>
            <th>Option</th>
        </tr>
        
        <?php
        
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
        ?>
        <tr>
            <td><?php echo $row->user_id; ?></td>
            <td><?php echo $row->user; ?></td>
            <td><?php echo $row->level; ?></td>
            <td>
                <div class="userId display-none"><?php echo $row->user_id; ?></div>

                <!-- update button -->
                <button class='btn btn-info edit-btn-user margin-right-1em'>
                    <span class='glyphicon glyphicon-edit'></span> Edit   
                </button>

                <!-- delete button -->
                <button class='btn btn-danger delete-btn-user margin-right-1em'>
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
			<li class="<?php if($page == $x) { echo 'active';}?>"><a class='btn-paging-user paging-user' href="javascript://"><?php echo $x;?></a></li>
		<?php } } ?>
        </ul></center>
    </nav>
<?php
    
    } else {
    echo "<div class='alert alert-info'>No records found.</div>";
}

?>
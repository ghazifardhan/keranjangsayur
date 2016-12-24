<?php

include '../../models/Include.php';

$itemId = isset($_GET['item_id']) ? $_GET['item_id'] : die('ERROR: Item ID Not Found');

$item->itemId = $itemId;

$item->showOne();

?>
<h1>Update Item: <?php echo $item->itemName; ?></h1>
<form id="update_item" action="javascript://" method="POST" border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td class='col-md-2'>Item Name</td>
                <td class='col-md-6'><input type="text" name="itemName" class='form-control' value="<?php echo $item->itemName;?>"></td>
            </tr>
            <tr>
                <td class='col-md-2'>Category</td>
            <td class='col-md-6'><select data-placeholder="Choose Category" name="categoryId" class="form-control chosen-select">
                    <option value=""></option>
                    <?php 
                    
                    $stmt = $category->indexAll();
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)){                    
                    ?>
                    <option value="<?php echo $row->category_id; ?>" <?php if($row->category_id == $item->categoryId) { echo 'selected'; } ?>><?php echo $row->category_name; ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    </td>
            </tr>
            <tr>
                <td class='col-md-2'>Unit</td>
                <td class='col-md-6'>
                    <select data-placeholder="Choose Unit" id="unitId" name="unitId" class='form-control chosen-select'>
                    <option value=""></option>
                    <?php 
                    
                    $stmt = $unit->indexAll();
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)){                    
                    ?>
                    <option value="<?php echo $row->unit_id; ?>" <?php if($row->unit_id == $item->unitId) { echo 'selected'; } ?>><?php echo $row->unit_name; ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    
                    </td>
            </tr>
            <tr>
                <td class="col-md-2"></td>
                <td class="col-md-6">
                    <input type="number" id="onqty" name="onqty" class='form-control'  value="<?php echo $item->onqty;?>"/>
                </td>
            </tr>
            <tr>
                <td class='col-md-2'>Price</td>
                <td class='col-md-6'><input type="number" name="price" class='form-control' value="<?php echo $item->price;?>"></td>
            </tr>
			<tr>
                <td class='col-md-2'>Highlight</td>
                <td class='col-md-6'><select data-placeholder="Choose Highlight" id="highlightId" name="highlightId" class='form-control chosen-select'>
                    <option value=""></option>
                    <option value="">Non-Highlight</option>
                    <?php 
                    
                    $stmt = $highlight->indexAll();
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)){                    
                    ?>
                    <option value="<?php echo $row->highlight_id; ?>" <?php if($row->highlight_id == $item->highlightId) { echo 'selected'; } ?>><?php echo $row->highlight_name; ?></option>
                    <?php
                    }
                    ?>
                    </select></td>
            </tr>
            <tr>
                <td class='col-md-2'>Description</td>
                <td class='col-md-6'><input type="text" name="description" class='form-control' value="<?php echo $item->description;?>"></td>
            </tr>
            <tr>
                <td class='col-md-2'><input type="hidden" name="itemId" value="<?php echo $itemId;?>" /></td>
                <td class='col-md-6'><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span> Save Changes</button></td>
            </tr>       
        </table>    
    </form>
	
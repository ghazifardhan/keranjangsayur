<?php

include '../../models/Include.php';

?>
<h1>Create New Item</h1>
<form id="create_item" action="javascript://" method="POST" border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td class='col-md-2'>Item Name</td>
                <td class='col-md-6'><input type="text" name="itemName" class='form-control'></td>
            </tr>
            <tr>
            <td class='col-md-2'>Category</td>
            <td class='col-md-6'><select data-placeholder="Choose Category" name="categoryId" class="form-control chosen-select">
                    <option value=""></option>
                    <?php 
                    
                    $stmt = $category->indexAll();
                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)){                    
                    ?>
                    <option value="<?php echo $row->category_id; ?>"><?php echo $row->category_name; ?></option>
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
                    <option value="<?php echo $row->unit_id; ?>"><?php echo $row->unit_name; ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    
                    </td>
            </tr>
            <tr>
                <td class="col-md-2"></td>
                <td class="col-md-6">
                    <input type="number" id="onqty" name="onqty" class='form-control' />
                </td>
            </tr>
            <tr>
                <td class='col-md-2'>Price</td>
                <td class='col-md-6'><input type="number" name="price" class='form-control'></td>
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
                    <option value="<?php echo $row->highlight_id; ?>"><?php echo $row->highlight_name; ?></option>
                    <?php
                    }
                    ?>
                    </select></td>
            </tr>
            <tr>
                <td class='col-md-2'>Description</td>
                <td class='col-md-6'><input type="text" name="description" class='form-control'></td>
            </tr>
            <tr>
                <td class='col-md-2'></td>
                <td class='col-md-6'><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    </form>

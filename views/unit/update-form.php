<?php
include_once '../../models/Include.php';
error_reporting(0);
// get unit id
$unitId = isset($_GET['unit_id']) ? $_GET['unit_id'] : die('ERROR: unit ID not found');

$unit->unitId = $unitId;

$unit->showOne();

?>
<h1>Update Unit: <?php echo $unit->unitName;?></h1>
<form id='update_unit' action='#' method='POST' border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Unit Name</td>
                <td><input type="text" name="unitName" class='form-control' value="<?php echo $unit->unitName; ?>"></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control' value="<?php echo $unit->description; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="unitId" value="<?php echo $unitId;?>" /></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span> Save Changes</button></td>
            </tr>       
        </table>    
    </form>
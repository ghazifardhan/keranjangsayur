<?php

include_once '../../models/Include.php';

$highlight->highlightId = $_GET['highlight_id'];

$stmt = $highlight->showOne();
$row = $stmt->fetch(PDO::FETCH_OBJ);

?>
<h1>Update Highlight: <?php echo $row->highlight_name;?></h1>
<form id='update_highlight' action='javascript://' method='POST' border='0'>
        <input type="hidden" name="highlightId" value="<?php echo $row->highlight_id; ?>">
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Highlight Name</td>
                <td><input type="text" name="highlightName" class='form-control' value="<?php echo $row->highlight_name; ?>"></td>
            </tr>
            <tr>
                <td>Highlight Color</td>
                <td><input type="text" name="highlightColor" class='form-control' value="<?php echo $row->highlight_color; ?>"></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control' value="<?php echo $row->description; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    </form>
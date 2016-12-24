<?php
error_reporting(0);

include '../../models/Include.php';

$user->userId = $_GET['user_id'];

$stmt = $user->showOne();
$row = $stmt->fetch(PDO::FETCH_OBJ);

?>
<h1>Create New User</h1>
<form id="create_user" action="javascript://" method="POST" border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td class='col-md-2'>Username</td>
                <td class='col-md-6'><input type="text" name="user" class='form-control' value="<?php if($row->user != NULL){ echo $row->user;} ?>"></td>
            </tr>
			<tr>
                <td class='col-md-2'>Password</td>
                <td class='col-md-6'><input type="password" name="pass" class='form-control'></td>
            </tr>
            <tr>
            <td class='col-md-2'>Level</td>
            <td class='col-md-6'><select data-placeholder="Choose Level" name="level" class="form-control">
                    <option value="1" <?php if($row->level == '1'){ echo 'selected';} ?>>Level 1</option>
                    <option value="2" <?php if($row->level == '2'){ echo 'selected';} ?>>Level 2</option>
                    <option value="3" <?php if($row->level == '3'){ echo 'selected';} ?>>Level 3</option>
                    </select>
                    </td>
            </tr>
            <tr>
                <td class='col-md-2'></td>
                <td class='col-md-6'><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    </form>

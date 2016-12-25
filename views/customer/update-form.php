<?php
include_once '../../models/Include.php';
error_reporting(0);
// get customer id
$customerId = isset($_GET['customer_id']) ? $_GET['customer_id'] : die('ERROR: customer ID not found');

$customer->customerId = $customerId;

$customer->showOne();

?>
<h1>Update customer: <?php echo $customer->customerName; ?></h1>
<form id='update_customer' action='javascript://' method='POST' border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>customer Name</td>
                <td><input type="text" name="customerName" class='form-control' value="<?php echo $customer->customerName; ?>"></td>
            </tr>
            <tr>
                <td>customer Name</td>
                <td><select name="customerType" class="form-control">
                    <option value="0" <?php if($customer->customerType == '0') {echo 'selected';}?>>Regular</option>
                    <option value="1" <?php if($customer->customerType == '1') {echo 'selected';}?>>Restaurant</option>
                </select></td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control' value="<?php echo $customer->description; ?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="customerId" value="<?php echo $customerId;?>" /></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span> Save Changes</button></td>
            </tr>       
        </table>    
    </form>
<h1>Update Voucher</h1>
<?php
error_reporting(0);

include '../../models/Include.php';

$customerId = $_GET['customer_id'];

$voucher->voucherId = $_GET['voucher_id'];

$voucher->showOne();

?>
<form id='update_voucher' action='javascript://' method='POST' border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Voucher</td>
                <td><input type="number" name="voucherValue" class='form-control' value="<?php echo $voucher->voucherValue; ?>"></td>
            </tr>
            <input type="hidden" value="<?php echo $voucher->voucherId;?>" name="voucherId" id="voucherId">
            <input type="hidden" value="<?php echo $customerId;?>" name="customerId" id="customerId">
            <tr>
                <td></td>
                <td><div class="customerId display-none"><?php echo $customerId; ?></div><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    </form>
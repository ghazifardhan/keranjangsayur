<h1>Update Voucher</h1>
<?php 
$customerId = $_GET['customer_id'];

$voucherId = isset($_GET['customer_id']) ? $_GET['customer_id'] : die('ERROR: customer ID not found');

$voucher->voucherId = $voucherId;

$voucher->showOne();

?>
<form id='update_voucher' action='javascript://' method='POST' border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Voucher</td>
                <td><input type="number" name="voucherValue" class='form-control' value="<?php echo $voucher->voucherValue; ?>"></td>
            </tr>
            <input type="text" value="<?php echo $voucherId;?>" name="voucherId" id="voucherId">
            <tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    </form>
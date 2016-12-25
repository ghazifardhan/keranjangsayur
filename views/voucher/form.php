<h1>Create New Voucher</h1>
<?php $customerId = $_GET['customer_id'];?>
<form id='create_voucher' action='javascript://' method='POST' border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Voucher</td>
                <td><input type="number" name="voucherValue" class='form-control'></td>
            </tr>
            <input type="text" name="customerId" value="<?php echo $customerId;?>">
            <tr>
                <td></td>
                <td><div class="customerId display-none"><?php echo $customerId; ?></div><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    </form>
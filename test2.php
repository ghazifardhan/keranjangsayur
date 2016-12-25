<?php
error_reporting(0);
include 'models/Include.php';
$invoice->invoiceDate = '2016-12-25';

$stmt = $invoice->detailPacking();
$stmt2 = $invoice->getShipping();
$row2 = $stmt2->fetch(PDO::FETCH_OBJ);
$nums = $stmt->rowCount();

if($nums>0){
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
    table {
        font-family: calibri;
        border-collapse: collapse;
        width: 100%;
        border: 2px solid #00b050;

    }

    .test {
        border: 2px solid #00b050;
        text-align: left;
        padding: 8px;
    }
    
    .test2 {
        border: 2px solid #000000;
        text-align: left;
        padding: 8px;
        background-color: #ffdd00;
    }
    
    .test3 {
        border: 2px solid #000000;
        text-align: left;
        padding: 8px;
        background-color: #ffaa00;
    }
    .test4 {
        border: 2px solid #000000;
        text-align: left;
        padding: 8px;
    }
    .test5 {
        border: 2px solid #000000;
        text-align: right;
        padding: 8px;
    }
    .tdwidth {
        width: 100px;
    }
    .topleft {
      vertical-align: top;
      text-align: left;
    }
    .align {
        text-align: right;
    }
    #footer {
        position: absolute;
        bottom: 0;
        text-align: center;
    }
    #margin {
        margin-left: 25px;
        font-family: calibri;
    }
    #margin2 {
        margin-left: 25px;
    }
    font {
        color: red;
        /*font-size: 18px;*/
        text-align: center;
    }
    .bordertop {
        border-top: 0px;
    }
    th, td {
        border: 2px solid #00b050;
    }
    .v-align {
        vertical-align: middle;
    }
    .t-center {
        text-align: center;
    }
</style>
</head>
<body>
    <div id="margin">
    <table>
        <tr>
            <td class="test2 t-center" style="background-color: #ffdd00;">ORDER</td>
            <td class="test2 t-center" style="background-color: #ffdd00;"><?php echo $invoice->invoiceDate; ?></td>
        </tr>
        <tr>
            <td class="test3 t-center" style="background-color: #ffaa00;">SHIPPING</td>
            <td class="test3 t-center" style="background-color: #ffaa00;"><?php echo $row2->shipping; ?></td>
        </tr>
    </table>
    <br/>
    <table border="1" style="border-collapse: collapse;">
    <tr>
        <th class="t-center v-align" rowspan="2">INVOICE</th>
        <th class="t-center v-align" rowspan="2">NAMA</th>
        <th class="t-center v-align" rowspan="2">ALAMAT</th>
        <th class="t-center v-align">ORDER</th>
        <th class="t-center v-align" colspan="2" rowspan="2">BANYAKNYA</th>
        <th class="t-center v-align">HARGA SUDAH</th>
    </tr>
    <tr>
        <th class="t-center v-align" style="border-left: 0px;">NYA</th>
        <th class="t-center v-align">DIKALI</th>
    </tr>
    <?php
    $invoice->invoiceDate = "2016-12-26";
    $stmtInvoice = $invoice->detailPacking();
    while ($rowInvoice = $stmtInvoice->fetch(PDO::FETCH_OBJ)){
    $transaction->transactionCode = $rowInvoice->invoice_code;
    $stmtTrans = $transaction->index();
    $num = $stmtTrans->rowCount();
    if($rowInvoice->voucher == 0){
        $temp1 = 4;
        $temp2 = 5;
        $temp3 = 2;
    } else {
        $temp1 = 5;
        $temp2 = 6;
        $temp3 = 3;
    }
    ?>
    <tr>
        <td rowspan="<?php if($num < $temp1){ echo $temp2; } else {echo $num+$temp3;} ?>" style="text-align: left; vertical-align: top;"><?php echo $rowInvoice->invoice_code;?></td>
        <td rowspan="<?php if($num < $temp1){ echo $temp2; } else {echo $num+$temp3;} ?>" style="text-align: left; vertical-align: top; width: 200px;">
            <?php 
                echo $rowInvoice->customer_name . "<br/>";
                echo $rowInvoice->customer_phone . "<br/>";
            ?>
        </td>
        <td rowspan="<?php if($num < $temp1){ echo $temp2; } else {echo $num+$temp3;} ?>" style="text-align: left; vertical-align: top;">
            <?php 
                echo $rowInvoice->customer_address . "<br/>";
                echo $rowInvoice->customer_address_2 . "<br/>";
                echo $rowInvoice->customer_address_3 . "<br/>";
                echo "<font>" . $rowInvoice->description . "</font><br/>";
                echo "<font>" . $rowInvoice->payment_method_name . "</font><br/>";
                echo "<font>" . $rowInvoice->description_2 . "</font><br/>";
                if($rowInvoice->voucher > 0){
                echo 'POT/VOUCHER' . '<br/>';
                echo $rowInvoice->voucher . '<br/>';
                }
            ?>
        </td>
        <td style="height: 0px"></td>
        <td style="height: 0px"></td>
        <td style="height: 0px"></td>
        <td style="height: 0px"></td>
    </tr>
        <?php
        while($rowTrans = $stmtTrans->fetch(PDO::FETCH_OBJ)){
        ?>
    <tr>
        <td style="height: 22px; background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;" class="t-center"><?php echo $rowTrans->item_name;?></td>
        <td style="height: 22px; background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;" class="t-center"><?php echo $rowTrans->item_qty;?></td>
        <td style="height: 22px; background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;" class="t-center"><?php echo $rowTrans->unit_name;?></td>
        <td style="height: 22px; background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;" class="t-center"><?php echo "IDR " . number_format($rowTrans->item_price,0,',','.');?></td>
    </tr>
    <?php
        } 
        if($num <= 3){
            $y = 3 - $num;
            for($x=1;$x<=$y;$x++){
                echo '<tr><td style="height: 22px;"></td><td style="height: 22px;"></td><td style="height: 22px;"></td><td style="height: 22px;"></td></tr>';
            }
        }
    ?>
    <tr>
        <td style="height: 22px; font-weight: bold;" colspan="3" class="t-center">TOTAL</td>
        <td style="height: 22px; font-weight: bold;" class="t-center"><?php echo "IDR " . number_format($rowInvoice->total,0,',','.'); ?></td>
    </tr>
    <?php
        if($rowInvoice->voucher > 0){
    ?>
    <tr>
        <td style="height: 22px; font-weight: bold;" colspan="3" class="t-center">TOTAL SETELAH POT.</td>
        <td style="height: 22px; font-weight: bold;" class="t-center"><?php echo "IDR " . number_format($rowInvoice->total,0,',','.'); ?></td>
    </tr>
    <?php
}
    }
    ?>
</table>
    </div>
    <?php
        
        $stmt3 = $invoice->getTransfer();
        $row3 = $stmt3->fetch(PDO::FETCH_OBJ);
        $stmt4 = $invoice->getCash();
        $row4 = $stmt4->fetch(PDO::FETCH_OBJ);
        
    ?>
        <br/><br/>
        <div id="margin">
        <table>
            <tr>
                <td style="width: 300px; height: 22px; font-weight: bold;">Total Invoice</td>
                <td class="t-center" style="font-weight: bold;"><?php echo $nums; ?></td>
            </tr>
            <tr>
                <td style="width: 300px; height: 22px; font-weight: bold;">Total Transfer</td>
                <td class="t-center" style="font-weight: bold;"><?php echo "IDR " . number_format($row3->total,0,',','.'); ?></td>
            </tr>
            <tr>
                <td style="width: 300px; height: 22px; font-weight: bold;">Total Cash</td>
                <td class="t-center" style="font-weight: bold;"><?php echo "IDR " . number_format($row4->total,0,',','.'); ?></td>
            </tr>
            <tr>
                <td style="width: 300px; height: 22px; font-weight: bold;">Grand Total</td>
                <td class="t-center" style="font-weight: bold;"><?php echo "IDR " . number_format($row4->total+$row3->total,0,',','.'); ?></td>
            </tr>
        </table>
       </div>
    </body>
</html>
<?php } else { echo 'No Transaction from date ' . $invoice->invoiceDate; } ?>
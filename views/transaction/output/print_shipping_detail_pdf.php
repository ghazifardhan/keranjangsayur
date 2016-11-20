<?php
error_reporting(0);
include '../../../models/Include.php';
ob_start();
$invoice->invoiceDate = $_GET['fromDate'];

$stmt = $invoice->detailPacking();
$stmt2 = $invoice->getShipping();
$row2 = $stmt2->fetch(PDO::FETCH_OBJ);
$num = $stmt->rowCount();
if($num>0){
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
    table {
        border-collapse: collapse;
        font-size: 10px;
        width: 100%;
    }

    .test {
        border: 1px solid #00b050;
        text-align: left;
        padding: 8px;
    }
	.test2 {
        border: 1px solid #000000;
        text-align: left;
        padding: 8px;
		background-color: #ffdd00;
    }
	.test3 {
        border: 1px solid #000000;
        text-align: left;
        padding: 8px;
		background-color: #ffaa00;
    }
	.test4 {
        border: 1px solid #000000;
        text-align: left;
        padding: 8px;
    }
	.test5 {
        border: 1px solid #000000;
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
        border: 2px #00b050;
    }
    .t-center {
        text-align: center;
    }
    .v-align {
        vertical-align: middle;
    }
    font .t-left {
        text-align: left;
    }
    font .t-left {
        text-align: right;
    }
</style>
</head>
<body>
	<div id="margin">
    <h1 style="text-align: center;">Shipping Invoice</h1>
	<table>
		<tr>
			<td class="test2 t-center">ORDER</td>
			<td class="test2 t-center"><?php echo $invoice->invoiceDate; ?></td>
		</tr>
		<tr>
			<td class="test3 t-center">SHIPPING</td>
			<td class="test3 t-center"><?php echo $row2->shipping; ?></td>
		</tr>
	</table>
	<br/>
    <table border="1" style="border-collapse: collapse;">
    <tr>
        <th class="t-center v-align" style="height: 13px;" rowspan="2">INVOICE</th>
        <th class="t-center v-align" rowspan="2">NAMA</th>
        <th class="t-center v-align" style="width: 200px;" rowspan="2">ALAMAT</th>
        <th class="t-center v-align" style="width: 150px;">ORDER</th>
        <th class="t-center v-align" colspan="2" rowspan="2">BANYAKNYA</th>
		<th class="t-center v-align" style="width: 80px;">HARGA SUDAH</th>
    </tr>
    <tr>
        <th class="t-center v-align" style="border-left: 0px;">NYA</th>
        <th class="t-center v-align">DIKALI</th>
    </tr>
    <?php
    
    $stmtInvoice = $invoice->detailPacking();
    while ($rowInvoice = $stmtInvoice->fetch(PDO::FETCH_OBJ)){
    $transaction->transactionCode = $rowInvoice->invoice_code;
    $stmtTrans = $transaction->index();
    $num = $stmtTrans->rowCount();
    ?>
    <tr>
        <td rowspan="<?php if($num < 4){ echo 5; } else {echo $num+2;} ?>" style="text-align: left; vertical-align: top;"><?php echo $rowInvoice->invoice_code;?></td>
        <td rowspan="<?php if($num < 4){ echo 5; } else {echo $num+2;} ?>" style="text-align: left; vertical-align: top;">
            <?php 
        echo $rowInvoice->customer_name . "<br/>";
        echo $rowInvoice->customer_phone . "<br/>";
            ?></td>
        <td rowspan="<?php if($num < 4){ echo 5; } else {echo $num+2;} ?>" style="vertical-align: top;">
            <?php 
                echo $rowInvoice->customer_address . "<br/>";
                if($rowInvoice->customer_address_2 == ""){ } else { echo $rowInvoice->customer_address_2 . "<br/>"; }
                if($rowInvoice->customer_address_3 == ""){ } else { echo $rowInvoice->customer_address_3 . "<br/>"; }
                echo "<font style='margin-left: 50px;'>" . $rowInvoice->description . "</font><br/>";
                echo "<font style='margin-left: 75px;'>" . $rowInvoice->payment_method_name . "</font><br/>";
            ?>
        </td>
    </tr>
        <?php
        while($rowTrans = $stmtTrans->fetch(PDO::FETCH_OBJ)){
        ?>
    <tr>
        <td style="height: 10px; border-left: 0px; background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;" class="v-align t-center"><?php echo $rowTrans->item_name;?></td>
        <td style="height: 10px; border-left: 0px; border-left: 0px; background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;" class="v-align t-center"><?php echo $rowTrans->item_qty;?></td>
        <td style="height: 10px; border-left: 0px; background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;" class="v-align t-center"><?php echo $rowTrans->unit_name;?></td>
        <td style="height: 10px; border-left: 0px; background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;" class="v-align t-center"><?php echo "IDR " . number_format($rowTrans->item_price,0,',','.');?></td>
    </tr>
    <?php
         
        } 
        
        if($num <= 3){
            $y = 3 - $num;
            for($x=1;$x<=$y;$x++){
                echo '<tr><td style="height: 10px; border-left: 0px;"></td><td style="height: 10px; border-left: 0px;"></td><td style="height: 10px; border-left: 0px;"></td><td style="height: 10px; border-left: 0px;"></td></tr>';
            }
        }
    ?>
    
    <tr>
        <td style="height: 10px; border-left: 0px; font-weight: bold;" colspan="3" class="v-align t-center">TOTAL</td>
        <td style="height: 10px; font-weight: bold;" class="v-align t-center"><?php echo "IDR " . number_format($rowInvoice->total,0,',','.'); ?></td>
    </tr>
    <?php
    }
    ?>
</table>
		<?php
		
		$stmt3 = $invoice->getTransfer();
		$row3 = $stmt3->fetch(PDO::FETCH_OBJ);
		$stmt4 = $invoice->getCash();
		$row4 = $stmt4->fetch(PDO::FETCH_OBJ);
		
		?>
		
		</div>
	<br/><br/><br/>
		<div id="margin">
		<table>
			<tr>
				<td style="width: 300px;" class="test4">Total Transfer</td>
				<td class="test5"><?php echo number_format($row3->total,0,',','.'); ?></td>
			</tr>
			<tr>
				<td style="width: 300px;" class="test4">Total Cash</td>
				<td class="test5"><?php echo number_format($row4->total,0,',','.'); ?></td>
			</tr>
			<tr>
				<td style="width: 300px;" class="test4">Grand Total</td>
				<td class="test5"><?php echo number_format($row4->total+$row3->total,0,',','.'); ?></td>
			</tr>
		</table>
	   </div>
    </body>
</html>
<?php } else { echo 'No Transaction from date ' . $invoice->invoiceDate; } ?>
<?php
$filename = "shiping_detail_".$invoice->invoiceDate . " - " . $row2->shipping . ".pdf";
$content = ob_get_clean();
require_once('../../../libs/html2pdf/html2pdf.class.php'); // arahkan ke folder html2pdf
try
{
$html2pdf = new HTML2PDF('P','A4','en'); //setting ukuran kertas dan margin pada dokumen anda
// $html2pdf->setModeDebug();
$html2pdf->setDefaultFont('Helvetica');
//$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
$html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>
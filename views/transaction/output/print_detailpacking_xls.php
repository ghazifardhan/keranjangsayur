<?php

include '../../../models/Include.php';
ob_start();

$invoice->invoiceDate = $_GET['fromDate'];

$transaction->transactionDate = $invoice->invoiceDate;

$stmt2 = $invoice->getShipping();
$row2 = $stmt2->fetch(PDO::FETCH_OBJ);

$stmt = $transaction->detailPackingSplit();
$num = $stmt->rowCount();
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=detail_packing_$invoice->invoiceDate.xls");
//if($num>0){
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
    table, th, td{
        font-family: calibri;
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #00b050;
    }

    .test {
        border: 2px solid #00b050;
        text-align: left;
        padding: 8px;
    }
	.test2 {
        border: 2px solid #00b050;
        text-align: left;
        padding: 8px;
		background-color: #ffdd00;
    }
	.test3 {
        border: 2px solid #00b050;
        text-align: left;
        padding: 8px;
		background-color: #ffaa00;
    }
	.test4 {
        /*border: 2px solid #00b050;*/
        text-align: left;
        padding: 8px;
		vertical-align: middle;
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
    }
    #margin2 {
        margin-left: 25px;
    }
	font {
		color: red;
		font-size: 18px;
	}
	.bordertop {
		border-top: 0px;
	}
	.t-align {
		text-align: center;
	}
</style>
</head>
<body>
	<div id="margin">
	<h1>DETAIL PACKING PISAH</h1>
	<table>
		<tr>
			<td class="test2 t-align">ORDER</td>
			<td class="test2 t-align"><?php echo $invoice->invoiceDate; ?></td>
		</tr>
		<tr>
			<td class="test3 t-align">SHIPPING</td>
			<td class="test3 t-align"><?php echo $row2->shipping; ?></td>
		</tr>
	</table>
	<br/>
    <table>
		<tr>
			<th class="test4 t-align" style="width: 125px;">ORDER</th>
			<th class="test4 t-align" rowspan="2">INVOICE</th>
			<th class="test4 t-align" rowspan="2" style="width: 200px;">NAMA</th>
			<th class="test4 t-align" colspan="2" rowspan="2">BANYAKNYA</th>
			<th class="test4 t-align" rowspan="2">KETERANGAN</th>
		</tr>
		<tr>
			<th class="test4 t-align">NYA</th>
		</tr>
        <?php
		   	$prev_group = "";
           	while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
			$transaction->invoiceDate = $transaction->transactionDate;
			$transaction->itemId = $row->item_id;
			$stmtCount = $transaction->countItem();
			$rowCount = $stmtCount->fetch(PDO::FETCH_OBJ);
			$group = $row->item_name;
        ?>    
        <tr>
			<?php if($group !== $prev_group){ ?>
            <td class="test4 t-align" style="background-color: <?php if($row->highlight_color != NULL){ echo $row->highlight_color;} else { echo 'white';} ?>;" rowspan="<?php echo $rowCount->countItem;?>"><?php echo $row->item_name; ?></td>
			<?php $prev_group = $group;}?>
            <td class="test4 t-align" style="border-left: 0px;"><?php echo $row->invoice_code; ?></td>
            <td class="test4"><?php echo $row->customer_name; ?></td>
            <td class="test4 t-align" style="background-color: <?php if($row->highlight_color != NULL){ echo $row->highlight_color;} else { echo 'white';} ?>;"><?php echo $row->item_qty; ?></td>
            <td class="test4 t-align" style="background-color: <?php if($row->highlight_color != NULL){ echo $row->highlight_color;} else { echo 'white';} ?>;"><?php echo $row->unit_name; ?></td>
            <td class="test4 t-align"><?php echo $row->description; ?></td>
        </tr>
        <?php
			   }
		?>
		</table>
	</div>
    </body>
</html>
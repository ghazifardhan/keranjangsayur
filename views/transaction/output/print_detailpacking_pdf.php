<?php

include '../../../models/Include.php';
ob_start();

$invoice->invoiceDate = $_GET['fromDate'];

$transaction->transactionDate = $invoice->invoiceDate;

$stmt2 = $invoice->getShipping();
$row2 = $stmt2->fetch(PDO::FETCH_OBJ);

$stmt = $transaction->detailPackingSplit();
$num = $stmt->rowCount();

$invDate = $invoice->invoiceDate;
$invDateFormat = date('l, d F Y', strtotime($invDate));
$shipDate = $row2->shipping;
$shipDateFormat = date('l, d F Y', strtotime($shipDate));
//if($num>0){
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        font-size: 10px;
    }

    .test {
        border: 2px solid #000000;
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
	<table>
		<tr>
			<td class="test2 t-align">ORDER</td>
			<td class="test2 t-align"><?php echo $invDateFormat; ?></td>
		</tr>
		<tr>
			<td class="test3 t-align">SHIPPING</td>
			<td class="test3 t-align"><?php echo $shipDateFormat; ?></td>
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
            <td class="test4 t-align" style="background-color: <?php if($row->highlight_color != NULL){ echo $row->highlight_color;} else { echo 'white';} ?>;" rowspan="<?php echo $rowCount->countItem;?>"><?php echo strtoupper($row->item_name); ?></td>
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
<?php
$filename = "detail_packing-". $_GET['fromDate'] . ".pdf";
$content = ob_get_clean();
require_once('../../../libs/html2pdf/html2pdf.class.php'); // arahkan ke folder html2pdf
try
{
$html2pdf = new HTML2PDF('P','A4','en'); //setting ukuran kertas dan margin pada dokumen anda
// $html2pdf->setModeDebug();
$html2pdf->setDefaultFont('Helvetica');
//$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content);
$html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>
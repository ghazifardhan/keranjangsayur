<?php
session_start();
//error_reporting(0);
ob_start();
include 'models/Include.php';
// Fungsi header dengan mengirimkan raw data excel
//header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
//header("Content-Disposition: attachment; filename=detailpacking_$invoice->invoiceDate.xls");

?>
<!DOCTYPE html>
<html>
    <head>
        
        <title>Keranjang Sayur</title>
        <!-- custom CSS -->
        <link href="libs/css/keranjangsayur.css" rel="stylesheet" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link href="libs/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" media="screen" />
        <link href="libs/js/bootstrap/dist/css/bootstrap-chosen.css" rel="stylesheet" />
      
    </head>
<style type="text/css">
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
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
        margin-left: 100px;
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
</style>

<body>
	<table border="1">
			<tr>
				<th class="test4">Item Name</th>	
				<th class="test4">Invoice</th>	
				<th class="test4">Nama</th>	
				<th class="test4">Qty</th>	
				<th class="test4" class="test4">Unit</th>	
				<th class="test4">Description</th>	
			</tr>
			<?php

			$transaction->transactionDate = '2016-11-11';

			$stmt = $transaction->detailPackingSplit();

			$prev_group = "";

			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
				$transaction->invoiceDate = $transaction->transactionDate;
				$transaction->itemId = $data->item_id;
				$stmtCount = $transaction->countItem();
				$rowCount = $stmtCount->fetch(PDO::FETCH_OBJ);
				$group = $data->item_name;
			?>
		    <tr>
			   <?php if($group !== $prev_group){ ?>
			   <td rowspan="<?php echo $rowCount->countItem;?>"><?php echo $data->item_name; ?></td>
			   <?php $prev_group = $group;}?>
			   <td><?php echo $data->invoice_code;?></td>
			   <td><?php echo $data->customer_name;?></td>
			   <td><?php echo $data->item_qty;?></td>
			   <td><?php echo $data->unit_name;?></td>
			   <td><?php echo $data->description;?></td>
		    </tr>
		<?php } ?>
	</table>
</body>
</html>
<?php
$filename = "invoice-".$fetch->invoice_code . ".pdf";
$content = ob_get_clean();
require_once('libs/html2pdf/html2pdf.class.php'); // arahkan ke folder html2pdf
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
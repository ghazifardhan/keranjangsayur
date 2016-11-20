<?php
//session_start();
//error_reporting(0);
ob_start();
include 'models/Include.php';
// Fungsi header dengan mengirimkan raw data excel
//header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
//header("Content-Disposition: attachment; filename=detailpacking_$invoice->invoiceDate.xls");

?>
<!DOCTYPE html>
<html lang="en-US">
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
    <div class="container">
      
    <?php
    
    $invoice->date1 = '2016-11-11';
    $invoice->date2 = '2016-11-14';
    $stmt = $invoice->invoiceByDate();
    while($row = $stmt->fetch(PDO::FETCH_OBJ)){
    ?>
        <table border="1">
        <tr>
            <td>Invoice:</td>
            <td><?php echo $row->invoice_code;?></td>
        </tr>
        <tr>
            <td>Date:</td>
            <td><?php echo $row->invoice_date;?></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><?php echo $row->customer_name;?></td>
        </tr>
	    </table>
        <table border="1">
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Unit</th>
        </tr>
    <?php
    $transaction->transactionCode = $row->invoice_code;
    $stmtTrans = $transaction->index();
    while ($rowTrans = $stmtTrans->fetch(PDO::FETCH_OBJ)){
    ?>
        <tr>
            <td><?php echo $rowTrans->item_name;?></td>
            <td><?php echo $rowTrans->item_qty;?></td>
            <td><?php echo $rowTrans->unit_name;?></td>
        </tr>
    <?php }
        echo "</table>";
        echo "<br/>";
    } ?>
    </div>
</body>
</html>
<?php
require_once '../../../models/Include.php';

// query category
// $invoiceCode = isset($_GET['invoice_code']) ? $_GET['invoice_code'] : die('ERROR: Item ID Not Found');

// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
$dateOne = $_GET['dateOne'];
$dateTwo = $_GET['dateTwo'];
header("Content-Disposition: attachment; filename=invoice_$dateOne-_-$dateTwo.xls");
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
    table {
        /*font-family: arial, sans-serif;*/
        border-collapse: collapse;
        width: 100%;
    }
    .border-color {
        border: 1px solid #00b050;
    }
    .test {
        border: 1px solid #00b050;
        text-align: left;
        padding: 4px;
    }
    .test2 {
        border-top: 2px solid #00b050;
        border-right: 2px solid #00b050;
        border-bottom: 2px solid #00b050;
    }
    .tdwidth {
        width: 100px;
    }
    .tdwidth2 {
        width: 10px;
    }
    .tdwidth3 {
        width: 150px;
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
        margin-left: 8px;
    }
    #margin2 {
        margin-left: 8px;
    }
    .bold {
        font-weight: bold;
    }
</style>
</head>
<body>
<div id="margin">
<?php
    $invoice->date1 = $_GET['dateOne'];
    $invoice->date2 = $_GET['dateTwo'];
    $stmt = $invoice->invoiceByDate();
    while($row = $stmt->fetch(PDO::FETCH_OBJ)){
    $date = new DateTime($row->shipping_date);

    $yearResult = $date->format('Y');
    $monthResult = $date->format('m');
    $dayResult = $date->format('d');
    $monthDisplay = NULL;

    $month = array(
                    '01' => 'Januari',
                    '02' => 'Februari',
                    '03' => 'Maret',
                    '04' => 'April',
                    '05' => 'Mei',
                    '06' => 'Juni',
                    '07' => 'Juli',
                    '08' => 'Agustus',
                    '09' => 'September',
                    '10' => 'Oktober',
                    '11' => 'November',
                    '12' => 'Desember',
                  );
    foreach ($month as $key => $value){
        if($monthResult == $key){
            $monthDisplay = $value;    
        }
    }
    ?>
<img src="http://localhost/keranjangsayur/images/ksinvoice.jpg" width="525" height="100"/>
<br/>
<br/>
<table>
    <tr>
        <td class="bold">No. Invoice</td>
        <td class="bold tdwidth2">:</td>
        <td><?php echo $row->invoice_code;?></td>
    </tr>
    <tr>
        <td class="bold">Nama</td>
        <td class="bold tdwidth2">:</td>
        <td><?php echo $row->customer_name;?></td>
    </tr>
    <tr>
        <td class="bold"></td>
        <td class="bold tdwidth2"></td>
        <td><?php echo "'".$row->customer_phone;?></td>
    </tr>
    <tr>
        <td style="text-align:left;vertical-align:top;width: 100px;" class="bold">Alamat</td>
        <td style="text-align:left;vertical-align:top;" class="bold tdwidth2">:</td>
        <td style="width: 300px;"><?php echo $row->customer_address;?></td>
    </tr>
    <tr>
        <td style="text-align:left;vertical-align:top;width: 100px;" class="bold"></td>
        <td style="text-align:left;vertical-align:top;" class="bold tdwidth2"></td>
        <td style="width: 300px;"><?php echo $row->customer_address_2;?></td>
    </tr> 
    <tr>
        <td style="text-align:left;vertical-align:top;width: 100px;" class="bold"></td>
        <td style="text-align:left;vertical-align:top;" class="bold tdwidth2"></td>
        <td style="width: 300px; font-weigth: bold;"><?php echo $row->customer_address_3;?></td>
    </tr>
	<tr>
        <td colspan="3" style="text-align: center; font-weight: bold; color: red; font-size: 16;"><?php echo $row->description;?></td>
    </tr>
	<tr>
        <td colspan="3" style="text-align: center; font-weight: bold; color: red; font-size: 16;"><?php echo $row->payment_method_name;?></td>
    </tr>
    <tr>
        <td colspan="3" style="height:10px;"></td>
    </tr>
    <tr>
        <td style="text-align: center; font-style: italic; font-weight: bold;">TGL KIRIM</td>
        <td class="bold tdwidth2">:</td>
        <td style="font-style: italic;"><?php echo $dayResult." ".$monthDisplay." ".$yearResult;?></td>
    </tr>
</table>
</div>
<div id="margin2">
<table>
        <tr>
            <th class="test" rowspan="2" style="text-align: center; width: 200px">PESANAN</th>
            <th class="test" colspan="2" rowspan="2" style="text-align: center; width: 50px">QTY</th>
            <th class="test" style="text-align: center; width: 125px;">HARGA SUDAH</th>
            <th rowspan="2"></th>
            <th></th>
            <!--<th>Option</th>-->
        </tr>
        <tr>
            <th class="test" style="text-align: center">DIKALI</th>
            <!--<th>Option</th>-->
        </tr>
		<?php
        $totalPrice = 0;
	    $no = 1;
        $transaction->transactionCode = $row->invoice_code;
        $stmtTrans = $transaction->index();
        while ($rowTrans = $stmtTrans->fetch(PDO::FETCH_OBJ)){
			
        ?>
        <tr>
            <td class="test" style="background-color: <?php if($rowTrans->highlight_color != NULL){ echo $row->highlight_color;} else { echo 'white';} ?>;"><?php echo $rowTrans->item_name; ?></td>
            <td class="test" style="background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;"><?php echo $rowTrans->item_qty; ?></td>
            <td class="test" style="background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;"><?php echo $rowTrans->unit_name; ?></td>
            <td class="test" style="background-color: <?php if($rowTrans->highlight_color != NULL){ echo $rowTrans->highlight_color;} else { echo 'white';} ?>;">IDR <?php 
			$price = $rowTrans->item_price;
			echo number_format($price,0,',','.'); ?></td>
			<td style="font-style: italic; color: red;"><?php echo $rowTrans->description; ?></td>
        </tr>
		<?php
			$totalPrice += $price;
        } ?>
        <tr>
            <td colspan="3" class="test">Grand Total</td>
            <td class="test">IDR <?php echo number_format($totalPrice,0,',','.');?></td>
			<td></td>
        </tr>
        </table>
        <br/>
        </div>
    <div>
        <img src="http://localhost/keranjangsayur/images/footernewks.jpg" width="525" height="110"/>
    </div>
        <br/>
        <br/>
        <br/>
        <?php
        }
        ?>
</body>
</html>
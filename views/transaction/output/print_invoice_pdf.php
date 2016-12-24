<?php
session_start();
ob_start();

require_once '../../../models/Include.php';

// query category
// $invoiceCode = isset($_GET['invoice_code']) ? $_GET['invoice_code'] : die('ERROR: Item ID Not Found');
$invoiceCode = $_GET['invoice_code'];	


$transaction->transactionCode = $invoiceCode;
$invoice->invoiceCode = $invoiceCode;

$stmt = $transaction->index();

$stmt2 = $invoice->readOne();
$fetch = $stmt2->fetch(PDO::FETCH_OBJ);
// check if more than 0 record found in category table

$date = new DateTime($fetch->shipping_date);

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
<html>
<head>
<style type="text/css">
    table {
        /*font-family: arial, sans-serif;*/
        border-collapse: collapse;
        width: 100%;
    }

    .test {
        border: 2px solid #84C126;
        text-align: left;
        padding: 4px;
        font-size: 11px;
    }
    .test2 {
        border-top: 2px solid #84C126;
        border-right: 2px solid #84C126;
        border-bottom: 2px solid #84C126;
        font-size: 11px;
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
    .tdwidth4 {
        width: 30px;
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
        font-size: 11px;
    }
    .bold {
        font-weight: bold;
    }
    .fontSize {
        font-size: 11px;
    }
</style>
</head>
<page backtop="2mm" backbottom="7mm" backleft="10mm" backright="10mm">
<body>
<img src="https://s17.postimg.org/nnp4f9dan/excell2333.jpg" width="500" height="100"/>
<br/>
<br/>
<div id="margin">
<table>
    <tr>
        <td class="bold fontSize" style="width: 170px;">No. Invoice</td>
        <td class="bold tdwidth2 fontSize">:</td>
        <td class="fontSize"><?php echo $fetch->invoice_code; ?></td>
    </tr>
    <tr>
        <td class="bold fontSize" style="width: 170px;">Nama</td>
        <td class="bold tdwidth2 fontSize">:</td>
        <td class="fontSize"><?php echo $fetch->customer_name; ?></td>
    </tr>
    <tr>
        <td class="bold fontSize" style="width: 170px;"></td>
        <td class="bold tdwidth2 fontSize"></td>
        <td class="fontSize"><?php echo $fetch->customer_phone;?></td>
    </tr>
    <tr>
        <td style="text-align:left;vertical-align:top;width: 170px;" class="bold">Alamat</td>
        <td style="text-align:left;vertical-align:top;" class="bold tdwidth2">:</td>
        <td style="width: 300px;" class="fontSize"><?php echo $fetch->customer_address;?></td>
    </tr>
    <tr>
        <td style="text-align:left;vertical-align:top;width: 170px;" class="bold"></td>
        <td style="text-align:left;vertical-align:top;" class="bold tdwidth2"></td>
        <td style="width: 300px;" class="fontSize"><?php echo $fetch->customer_address_2;?></td>
    </tr> 
    <tr>
        <td style="text-align:left;vertical-align:top;width: 170px;" class="bold"></td>
        <td style="text-align:left;vertical-align:top;" class="bold tdwidth2"></td>
        <td style="width: 300px; font-weight: bold;" class="fontSize"><?php echo $fetch->customer_address_3;?></td>
    </tr> 
	<tr>
        <td colspan="3" style="text-align: center; font-weight: bold; color: red; font-size: 16;"><?php echo $fetch->description;?></td>
    </tr>
	<tr>
        <td colspan="3" style="text-align: center; font-weight: bold; color: red; font-size: 16;"><?php echo $fetch->payment_method_name;?></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center; font-weight: bold; color: red; font-size: 16;"><?php echo $fetch->description_2;?></td>
    </tr>
    <tr>
        <td colspan="3" style="height:10px;"></td>
    </tr>
    <?php if($fetch->voucher != 0){ ?>
    <tr>
        <td style="text-align: center; font-style: italic; font-weight: bold;" class="fontSize">POT/VOUCHER</td>
        <td class="bold tdwidth2 fontSize">:</td>
        <td style="font-style: italic;" class="fontSize"><?php  echo 'IDR ' . number_format($fetch->voucher,0,',','.');?></td>
    </tr>
    <?php } ?>
    <tr>
        <td style="text-align: center; font-style: italic; font-weight: bold;" class="fontSize">TGL KIRIM</td>
        <td class="bold tdwidth2 fontSize">:</td>
        <td style="font-style: italic;" class="fontSize"><?php  echo $dayResult." ".$monthDisplay." ".$yearResult;?></td>
    </tr>
</table>
</div>
<table class="margin2">
        <tr>
            <th class="test" rowspan="2" style="text-align: center; width: 150px">PESANAN</th>
            <th class="test" colspan="2" rowspan="2" style="text-align: center; width: 50px">QTY</th>
            <th class="test" style="text-align: center; width: 125px;">HARGA SUDAH</th>
            <th rowspan="2" style="width: 55px;"></th>
            <th></th>
            <!--<th>Option</th>-->
        </tr>
        <tr>
            <th class="test2" style="text-align: center;">DIKALI</th>
            <!--<th>Option</th>-->
        </tr>
		<?php
        $totalPrice = 0;
	    $no = 1;
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)){
			
        ?>
        <tr>
            <td class="test" style="background-color: <?php if($row->highlight_color != NULL){ echo $row->highlight_color;} else { echo 'white';} ?>;"><?php echo strtoupper($row->item_name); ?></td>
            <td class="test" style="background-color: <?php if($row->highlight_color != NULL){ echo $row->highlight_color;} else { echo 'white';} ?>;"><?php echo $row->item_qty; ?></td>
            <td class="test" style="background-color: <?php if($row->highlight_color != NULL){ echo $row->highlight_color;} else { echo 'white';} ?>;"><?php echo $row->unit_name; ?></td>
            <td class="test align" style="background-color: <?php if($row->highlight_color != NULL){ echo $row->highlight_color;} else { echo 'white';} ?>;">IDR <?php 
			$price = $row->item_price;
			echo number_format($price,0,',','.'); ?></td>
			<td style="font-style: italic; color: red;"><?php echo $row->description; ?></td>
        </tr>
		<?php
			$totalPrice += $price; 
		}
		?>
		<tr>
            <td colspan="3" class="test">TOTAL</td>
            <td class="test align">IDR <?php echo number_format($totalPrice,0,',','.');?></td>
	    <td></td>
        </tr>
        <?php if($fetch->voucher != 0){ 
            $totalAfterDeduction = $totalPrice - $fetch->voucher; ?>
        <tr>
            <td colspan="3" class="test">TOTAL SETELAH POT.</td>
            <td class="test align">IDR <?php echo number_format($totalAfterDeduction,0,',','.');?></td>
        <td></td>
        </tr>
        <?php } ?>
</table>
    <br/>
    <br/>
    <br/>
    <img src="https://s11.postimg.org/l8ajv99b7/footerfixks.jpg" width="400" height="110" style="padding-left: 15px;"/>
</body>
</page>
</html>
<?php
$filename = "invoice-".$fetch->invoice_code . ".pdf";
$content = ob_get_clean();
require_once('../../../libs/html2pdf/html2pdf.class.php'); // arahkan ke folder html2pdf
try
{
$html2pdf = new HTML2PDF('P','A5','en'); //setting ukuran kertas dan margin pada dokumen anda
// $html2pdf->setModeDebug();
$html2pdf->setDefaultFont('Helvetica');
//$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
$html2pdf->Output($filename);
}
catch(HTML2PDF_exception $e) { echo $e; }
?>		
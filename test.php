<!DOCTYPE html>
<html>
<head>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="libs/js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="/keranjangsayur/libs/js/bootstrap/dist/css/bootstrap-chosen.css" rel="stylesheet" />
<script src="/keranjangsayur/libs/js/chosen/chosen.jquery.js"></script>
<script src="/keranjangsayur/libs/js/chosen/chosen.jquery.min.js"></script>


</head>

<body>
<form action="test.php" method="post">
<select id="slc" name="test[]" multiple="multiple" style="width: 300px;">
</select>
<select id="voucherChooser" data-placeholder="Voucher" name="voucherChooser" class="form-control chosen-select">
                    </select>
<input type="text" class="name" />
<input type="text" class="idname" id="myId" />
<input type="submit" name="submit" value="submit" id="button">
</form>


<script type="text/javascript">
$(document).ready(function(){
    
    /*
    $('#slc').select2();

    $('#slc').change(function(){
        var sum = 0;
        $("#slc option:selected").each(function(){
            sum += Number($(this).text());
        });
        $('#sum').val(sum);
    }).trigger("change");
	

	$('#slc').select2();
    $('#slc').change(function() {
        var x = $('.idname').val();
        $.ajax({ 
                type: 'GET', 
                url: '/keranjangsayur/json/jsonvoucher.php',
                data: {item_id: x},
                dataType: 'json',
                success: function (data) {
                    $.each(data, function(index, element) {
                        $('div[id="result'+i+'"]').html('<div class="input-group"><input type="number" name="itemQty[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" required /><span class="input-group-addon" id="basic-addon2">'+element.unit_name+'</span></div>');
                    });
                }
            });
	});
	*/

    $(".name").autocomplete({
	      source: '/keranjangsayur/json/jsoncustomer.php',
	      results: function(event, ui){
	      	this.value = ui.item.name;
	      	$(this).next().val(ui.item.id);
	      }
	  	});
	});

	$('.idname').change(function(){
		var x = $(this).val();
		$.ajax({ 
                type: 'GET', 
                url: '/keranjangsayur/json/jsonvoucher.php',
                data: {customer_id: x},
                dataType: 'json',
                success: function (data) { 
                    $('#voucherChooser').empty();
                    $('#voucherChooser').html($('<option>').text(""));
                    $.each(data, function(index, element) {
                        $('#voucherChooser').html($('<option>').text(element.voucher_value).attr('value', element.vaucher_id));
                    });
                $('.chosen-select').chosen({width : "300px"});
                }
            });
	});
</script>

</body>
</html>
<?php

foreach($_POST['test'] as $key => $v){
    echo $v;
}

?>
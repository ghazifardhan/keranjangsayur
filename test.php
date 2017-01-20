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
<input type="text" class="name" />
<select id="voucherChooser" data-placeholder="Voucher" multiple name="voucherChooser[]" class="form-control" style="width: 300px;"></select>
<input type="number" class="total" />
<input type="submit" name="submit" value="submit" id="button">
</form>


<script type="text/javascript">
$(document).ready(function(){
    
    $(".name").autocomplete({
          source: '/keranjangsayur/json/jsoncustomer.php',
          select: function(event, ui){
            if(ui.item)
            {
                $.ajax({
                    type: "GET",
                    url: "/keranjangsayur/json/jsonvoucher.php",
                    data: {customer_id:ui.item.id},
                    success: function(d){
                        $('#voucherChooser').empty();
                        $('#voucherChooser').append($('<option>').text(""));
                        $.each(d, function(i, a){
                            $('#voucherChooser').append($('<option>').text(a.voucher_value).attr('value', a.voucher_id));
                        });
                    }
                });
            }
        }
    });

    $('#voucherChooser').select2();

    $('#voucherChooser').change(function(){
        var sum = 0;
        $("#voucherChooser option:selected").each(function(){
            sum += Number($(this).text());
        });
        $('.total').val(sum);
    }).trigger("change");

});
</script>

</body>
</html>
<!DOCTYPE html>
<html>
<head>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<script src="libs/js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

</head>

<body>
<form action="test.php" method="post">
<select id="slc" name="test[]" multiple="multiple" style="width: 300px;">
<option value="a">1</option>
<option value="b">2</option>
<option value="c">3</option>
</select>
<input type="text" id="sum" name="sum">
<input type="submit" name="submit" value="submit">
</form>


<script type="text/javascript">
$(document).ready(function(){
    
    $('#slc').select2();

    $('#slc').change(function(){
        var sum = 0;
        $("#slc option:selected").each(function(){
            sum += Number($(this).text());
        });
        $('#sum').val(sum);
    }).trigger("change");



});
</script>

</body>
</html>
<?php

foreach($_POST['test'] as $key => $v){
    echo $v;
}

?>
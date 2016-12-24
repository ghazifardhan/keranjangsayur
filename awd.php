<?php
/* Ghazi Fadil Ramadhan */
session_start();
error_reporting(0);
include 'models/Include.php';

?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        
        <title>Keranjang Sayur</title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        
        <link href="libs/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" media="screen" />
        <link href="libs/js/bootstrap/dist/css/bootstrap-chosen.css" rel="stylesheet" />
        <!-- custom CSS -->
        <style>
        .display-none{
            display:none;
        }

        .padding-bottom-2em{
            padding-bottom:2em;
        }

        .width-30-pct{
            width:30%;
        }

        .width-40-pct{
            width:40%;
        }

        .overflow-hidden{
            overflow:hidden;
        }

        .margin-right-1em{
            margin-right:1em;
        }

        .right-margin{
            margin:0 .5em 0 0;
        }

        .margin-bottom-1em {
            margin-bottom:1em;
        }

        .margin-zero{
            margin:0;
        }

        .text-align-center{
            text-align:center;
        }
        
        .navbar-custom {
            color: #00FF00;
            background-color: #00FF00;
        }
        .table-nonfluid {
            width: auto !important;
        }
        </style> 
    
    </head>

<body>
<div class="container">

<!--
<table border="1">
	<thead>
	<tr>
		<th>itemid</th>
		<th>itemname</th>
		<th>categoryname</th>
		<th>unitname</th>
		<th>highlightname</th>
	</tr>
	</thead>
	<tbody id="mytable"></tbody>
</table>
	
<select id="item" data-placeholder="Choose Item" name="itemId[]" class="form-control chosen-select" required></select>

	<div id="result">
		<div class="input-group">
			<input type="number" name="itemQty[]" class="form-control" required />
			<span class="input-group-addon" id="basic-addon2"></span>
		</div>
	</div>
-->
<button type="button" class="add-btn">Add</button>
<form id="myform" method="post" action="awd.php">
<input type="submit" name="submit" value="submit" required />
<select id="item1" name="itemId[]" required></select>
</form>
<div id="result"><div class="input-group"><input type="number" name="itemQty[]" class="form-control" required /><span class="input-group-addon" id="basic-addon2"></span></div></div>
</div>
<?php

if(isset($_POST['submit']))
{
	$name = $_POST['itemId'];
	
	foreach($name as $value){
		echo $value . "<br/>";
	}
}
	
?>
<!-- jQuery library -->
<script src="libs/js/jquery.js"></script>
<script src="libs/js/chosen/chosen.jquery.js"></script>
<script src="libs/js/chosen/chosen.jquery.min.js"></script>
 
<!-- bootstrap JavaScript -->
<script src="libs/js/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
    
    $(document).ready(function(){
    
	function getData(x){
		$.ajax({ 
				type: 'GET', 
				url: 'json/jsonitem.php',
				data: {get_param: 'value'},
				dataType: 'json',
				success: function (data) {
					$('select[id="item'+x+'"]').empty();
					$('select[id="item'+x+'"]').append($('<option>').text(""));
					$.each(data, function(index, element) {
						$('select[id="item'+x+'"]').append($('<option>').text(element.item_name).attr('value', element.item_id));
					});
				//$('.chosen-select').chosen({width : "inherit"});
			}
		});
	}
	
    function getUnit(x){
    $("select[id='item"+x+"']").change(function() {
        var x = $(this).val();
        
        $.ajax({ 
            type: 'GET', 
            url: 'json/jsonunit.php',
            data: {item_id: x},
            dataType: 'json',
            success: function (data) {
                $.each(data, function(index, element) {
                    $('div[id="result"]').html('<div class="input-group"><input type="number" name="itemQty[]" class="form-control" required /><span class="input-group-addon" id="basic-addon2">'+element.unit_name+'</span></div>');
                    //$('#unit').html(element.unit_name);
                });
            }
        });
    });
    }
    function addMoreField(){
            var max_fields  = 100;
            var wrapper     = $("#myform");
            var add_button  = $(".add-btn");

            var x = 1;
            $(add_button).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append('<select id="item'+x+'" name="itemId[]" required></select>');
					getData(x);
                    getUnit(x);
                }
            });

            $(wrapper).on("click", ".remove-field", function(e){
                e.preventDefault(); $(this).parent().remove(); x--;
            });
        }
		
    //$('.chosen-select').chosen({width : "inherit"});
    //getItem();
    //getUnit();
    addMoreField();
	var x = 1;
	getData(x);
	getUnit(x);
	
    });
    
</script>
    

</body>
</html>
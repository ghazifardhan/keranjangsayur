$(document).ready(function(){
    
        $('#loader-image').hide();
        changePageTitle('Keranjang Sayur');
        welcomePage();
    
        // category modul
    
        $('#create_category').click(function(){
            $('#loader-image').show();
            changePageTitle('Create Category');
            // first view
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/category/form.php', function(){
                $('#loader-image').hide();    
                $('#page-content').fadeIn('fast');
            });
            });          
        });
    
        $(document).on('submit', '#create_category', function() {

            $('#loader-image').show();
                
            $.post("/keranjangsayur/views/category/create.php", $(this).serialize()).done(function(data){
				var page = 1;
				var search = "";
                showCategory(page, search);
            });
            
            return false;
            
        });
    
        $(document).on('click', '.edit-btn', function(){
            var category_id = $(this).closest('td').find('.categoryId').text();
            changePageTitle('Keranjang Sayur');
            // show a loader image
            $('#loader-image').show();
            
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/category/update-form.php?category_id=' + category_id, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        });
    
        $(document).on('click', '.delete-btn', function(){
            if(confirm('Delete Category?')){
            
            var category_id = $(this).closest('td').find('.categoryId').text();
            
            // trigger the delete file
            $.post("/keranjangsayur/views/category/delete.php", { category_id: category_id }).done(function(data){
                console.log(data);
                
                // show loader image
                $('#loader-image').show();
                
                // reload category list
                var page = 1;
				var search = "";
                showCategory(page, search);
            });
            }
        });
    
        
        
        $(document).on('submit', '#update_category', function(){
            // show a loader img
            $('#loader-image').show();
            
            $.post("/keranjangsayur/views/category/update.php", $(this).serialize()).done(function(data){
                var page = 1;
				var search = "";
                showCategory(page, search);
            });
            
            return false;
        });
        
        // end of category modul
        
        // item modul
        
        $('#create_item').click(function(){
            $('#loader-image').show();
            // first view
            changePageTitle('Create Item');
            $('#page-content').fadeOut('fast', function(){
            $('#page-content').load('/keranjangsayur/views/item/form.php', function(){
                $('.chosen-select').chosen({width : "300px"});
                $('#loader-image').hide();
				/*
                $('#tr-onqty').hide();
                $('#unitId').on('change', function(){
                    if($(this).val() == '1'){
                        $('#tr-onqty').fadeIn('fast', function(){
                            $('#tr-onqty').show();    
                        });
                    } else {
                        $('#tr-onqty').hide();
                    }
                });
				*/
                $('#page-content').fadeIn('fast');
            });
            });
        });
    
        $(document).on('submit', '#create_item', function() {

            $('#loader-image').show();

            $.post("/keranjangsayur/views/item/create.php", $(this).serialize()).done(function(data){
                var page = 1;
				var search = "";
                showItem(page, search);
            });
            
            return false;
        });
        
        $(document).on('click', '.edit-btn-item', function(){
            
            var item_id = $(this).closest('td').find('.itemId').text();
            changePageTitle('Edit Item');
            // show a loader image
            $('#loader-image').show();
            
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/item/update-form.php?item_id=' + item_id, function(){
                    $('.chosen-select').chosen({width : "300px"});
                    // hide loader image
                    $('#loader-image').hide(); 
                    $('#tr-onqty').hide();
                    $('#unitId').on('change', function(){
                        if($(this).val() == '1'){
                            $('#tr-onqty').fadeIn('fast', function(){
                                $('#tr-onqty').show();    
                            });
                        } else {
                            $('#tr-onqty').hide();
                        }
                    });
                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        });
    
        $(document).on('click', '.delete-btn-item', function(){
            if(confirm('Delete Item?')){
            
            var item_id = $(this).closest('td').find('.itemId').text();
            
            // trigger the delete file
            $.post("/keranjangsayur/views/item/delete.php", { item_id: item_id }).done(function(data){
                console.log(data);
                
                // show loader image
                $('#loader-image').show();
                
                // reload item list
                var page = 1;
				var search = "";
                showItem(page, search);
            });
            }
        });
    
        
        
        $(document).on('submit', '#update_item', function(){
            // show a loader img
            $('#loader-image').show();
            
            $.post("/keranjangsayur/views/item/update.php", $(this).serialize()).done(function(data){
                var page = 1;
				var search = "";
                showItem(page, search);
            });
            
            return false;
        });
    
        // .endofmodulitem
    
        // unit modul
    
        $('#create_unit').click(function(){
            $('#loader-image').show();
            changePageTitle('Create Unit');
            // first view
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/unit/form.php', function(){
                $('#loader-image').hide();    
                $('#page-content').fadeIn('fast');
            });
            });
            
            $('#loader-image').hide();
        });
        
        $(document).on('submit', '#create_unit', function() {

            $('#loader-image').show();

            $.post("/keranjangsayur/views/unit/create.php", $(this).serialize()).done(function(data){
				var page = 1;
				var search = "";
                showUnit(page, search);
            });
            
            return false;
        });
    
        $(document).on('click', '.edit-btn-unit', function(){
            var unit_id = $(this).closest('td').find('.unitId').text();
            changePageTitle('Edit Unit');
            // show a loader image
            $('#loader-image').show();
            
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/unit/update-form.php?unit_id=' + unit_id, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        });
    
        $(document).on('click', '.delete-btn-unit', function(){
            if(confirm('Delete Unit?')){
            
            var unit_id = $(this).closest('td').find('.unitId').text();
            
            // trigger the delete file
            $.post("/keranjangsayur/views/unit/delete.php", { unit_id: unit_id }).done(function(data){
                console.log(data);
                
                // show loader image
                $('#loader-image').show();
                
                // reload unit list
                var page = 1;
				var search = "";
                showUnit(page, search);
            });
            }
        });
    
        
        
        $(document).on('submit', '#update_unit', function(){
            // show a loader img
            $('#loader-image').show();
            
            $.post("/keranjangsayur/views/unit/update.php", $(this).serialize()).done(function(data){
                var page = 1;
				var search = "";
                showUnit(page, search);
            });
            
            return false;
        });
        
        // invoice
        
        $('#create_invoice').click(function(){
            $('#loader-image').show();
            changePageTitle('Create Invoice');
            // first view
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/form_invoice.php', function(){
                getDataVoucher();
                $('#loader-image').hide();    
                $('#page-content').fadeIn('fast');
            });
            });
            
            $('#loader-image').hide();
        });
        
        $(document).on('submit', '#form_create_invoice', function() {

            $('#loader-image').show();

            $.post("/keranjangsayur/views/transaction/create_invoice.php", $(this).serialize()).done(function(data){
				var page = 1;
				var search = "";
                var invoiceCode = $('#invoiceCode').val();
                showTransaction(invoiceCode);
            });
            
            return false;
        });
		
		$(document).on('click', '.show-btn-invoice', function(){
			var invoice_code = $(this).closest('td').find('.invoiceCode').text();
			
			$('#loader-image').show();
			$('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/show_transaction.php?invoice_code=' + invoice_code, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
		});
    
        $(document).on('click', '.paid-btn-invoice', function(){
            var invoice_code = $(this).closest('td').find('.invoiceCode').text();
            // trigger the delete file
            $.post("/keranjangsayur/views/transaction/paid_invoice.php", { invoice_code: invoice_code }).done(function(data){
                // show loader image
                $('#loader-image').show();
                
                // reload unit list
                var page = 1;
				var search = "";
                showInvoice(page, search);
            });
        });
	
		$(document).on('click', '.unpaid-btn-invoice', function(){
            var invoice_code = $(this).closest('td').find('.invoiceCode').text();
            // trigger the delete file
            $.post("/keranjangsayur/views/transaction/unpaid_invoice.php", { invoice_code: invoice_code }).done(function(data){
                // show loader image
                $('#loader-image').show();
                
                // reload unit list
                var page = 1;
				var search = "";
                showInvoice(page, search);
            });
        });
	
		$(document).on('click', '.edit-btn-invoice', function(){
			var invoice_code = $(this).closest('td').find('.invoiceCode').text();
			
			$('#loader-image').show();
			$('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/update_form_invoice.php?invoice_code=' + invoice_code, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
		});
	
		$(document).on('submit', '#form_update_invoice', function() {

            $('#loader-image').show();

            $.post("/keranjangsayur/views/transaction/update_invoice.php", $(this).serialize()).done(function(data){
                var page = 1;
				var search = "";
                var invoiceCode = $('#invoiceCode').val();
                showTransaction(invoiceCode);
            });
            
            return false;
        });
		// end of invoice
		
		// transaction
	    /*
        function getData(){
        $.getJSON("/keranjangsayur/json/jsonitem.php", function(json){
                $('select[id="item"]').empty();
                $('select[id="item"]').append($('<option>').text(""));
                $.each(json, function(i, obj){
                        $('select[id="item"]').append($('<option>').text(obj.item_name).attr('value', obj.item_id));
                });
                $('.chosen-select').chosen({width : "300px"});
        });
        }
        */

        function getDataVoucher(){
            $(".customerName").autocomplete({
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
                                    console.log(a.voucher_id);
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
                $('#voucherResult').val(sum);
            }).trigger("change");
        }

        function getData(x){
            $.ajax({ 
            type: 'GET', 
            url: '/keranjangsayur/json/jsonitem.php',
            data: {get_param: 'value'},
            dataType: 'json',
            success: function (data) { 
                $('select[id="item'+x+'"]').empty();
                $('select[id="item'+x+'"]').append($('<option>').text(""));
                $.each(data, function(index, element) {
                    $('select[id="item'+x+'"]').append($('<option>').text(element.item_name).attr('value', element.item_id));
                });
            $('.chosen-select').chosen({width : "300px"});
            }
        });
        }
	
        function getUnit(i){
        $('select[id="item'+i+'"]').change(function() {
            var x = $(this).val();

            $.ajax({ 
                    type: 'GET', 
                    url: '/keranjangsayur/json/jsonunit.php',
                    data: {item_id: x},
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function(index, element) {
                            $('div[id="result'+i+'"]').html('<div class="input-group"><input type="number" name="itemQty[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" required /><span class="input-group-addon" id="basic-addon2">'+element.unit_name+'</span></div>');
                        });
                    }
                });
		});
        }
        
        function getUnit2(i){
        $('select[id="item'+i+'"]').change(function() {
            var x = $(this).val();

            $.ajax({ 
                    type: 'GET', 
                    url: '/keranjangsayur/json/jsonunit.php',
                    data: {item_id: x},
                    dataType: 'json',
                    success: function (data) {
                        $.each(data, function(index, element) {
                            $('div[id="result'+i+'"]').html('<div class="input-group"><input type="number" name="itemQty" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" required /><span class="input-group-addon" id="basic-addon2">'+element.unit_name+'</span></div>');
                        });
                    }
                });
		});
        }
    
		$(document).on('click', '.create-btn-transaction', function(){
			var invoice_code = $(this).closest('td').find('.invoiceCode').text();
			changePageTitle('Create Transaction');
			$('#page-content').fadeOut('fast', function(){
				$('#page-content').load('/keranjangsayur/views/transaction/form_transaction.php?invoice_code=' + invoice_code, function(){
					// hide loader image
					var x = 1;
                    getData(x);
                    addMoreField();
                    getUnit(x);
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
				});
			});
		});
        
        function addMoreField(){
            var max_fields  = 100;
            var wrapper     = $("#myTable");
            var add_button  = $(".add-btn-transaction");

            var x = 1;
            $(add_button).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append('<div class="panel panel-default"><div class="panel-heading">Item '+ x +' <button type="button" class="btn btn-danger remove-field" style="margin-top: -7px; padding: -2px; float: right;">X</button></div><div class="panel-body"><table class="table table-hover table-responsive table-bordered""><tr><td>Item Name</td><td><select id="item'+x+'" data-placeholder="Choose Item" name="itemId[]" class="form-control chosen-select" required></select></td></tr><tr><td>Qty</td><td><div id="result'+x+'"><div class="input-group"><input type="number" name="itemQty[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" required /><span class="input-group-addon" id="basic-addon2"></span></div></div></td></tr><tr><td>Discount</td><td><div class="input-group"><input type="number" name="discount[]" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" class="form-control" aria-describedby="basic-addon2"/><span class="input-group-addon" id="basic-addon2">%</span></div></td></tr><tr><td>Potongan</td><td><input type="number" name="deduction[]" class="form-control" pattern="[0-9]+([\.,][0-9]+)?" step="0.01"/></div></td></tr><td>Description</td><td><input type="text" name="description[]" class="form-control"/></td></tr></table></div></div>');
                    getData(x);
                    getUnit(x);
                }
            });
            //<div class="input-group"><input type="number" name="itemQty[]" class="form-control" required /><span class="input-group-addon" id="basic-addon2"></span></div>
            $(wrapper).on("click", ".remove-field", function(e){
                e.preventDefault(); $(this).parent().parent().remove(); x--;
            });
        }
    
		$(document).on('submit', '#create_new_transaction', function() {
			var invoice_code = $(this).closest('form').find('.invoiceCode').text();
            $('#loader-image').show();

            $.post("/keranjangsayur/views/transaction/create_transaction.php", $(this).serialize()).done(function(data){
				showTransaction(invoice_code);
            });
            
            return false;
        });
		
		$(document).on('click', '.edit-btn-transaction', function(){
			var transaction_id = $(this).closest('td').find('.transactionId').text();
			var transaction_code = $(this).closest('td').find('.transactionCode').text();
			
			$('#loader-image').show();
			$('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/update_form_transaction.php?transaction_id=' + transaction_id + '&transaction_code=' + transaction_code, function(){
                    // hide loader image
					$('.chosen-select').chosen({width : "300px"});
                    var x = 1;
                    getUnit2(x);
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
		});
	
		$(document).on('submit', '#update_transaction', function() {
			var transaction_code = $(this).closest('form').find('.transactionCode').text();
            $('#loader-image').show();

            $.post("/keranjangsayur/views/transaction/update_transaction.php", $(this).serialize()).done(function(data){
				showTransaction(transaction_code);
            });
            
            return false;
        });
        
        $(document).on('click', '.delete-btn-invoice', function(){
            if(confirm('Delete Invoice?')){
            var invoice_id = $(this).closest('td').find('.invoiceId').text();
            var invoice_code = $(this).closest('td').find('.invoiceCode').text();
            
            // trigger the delete file
            $.post("/keranjangsayur/views/transaction/delete_invoice.php", { invoice_id: invoice_id, invoice_code: invoice_code }).done(function(data){
                console.log(data);
                
                // show loader image
                $('#loader-image').show();
                
                // reload unit list
                var page = 1;
				var search = "";
                showInvoice(page, search);
            });
            }
        });
        
    
        $(document).on('click', '.print-btn-transaction-pdf', function(){
            var invoice_code = $(this).closest('td').find('.invoiceCode').text();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_invoice_pdf.php?invoice_code=' + invoice_code, '_blank');
        });
    
        $(document).on('click', '.print-btn-transaction-xls', function(){
            var invoice_code = $(this).closest('td').find('.invoiceCode').text();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_invoice_xls.php?invoice_code=' + invoice_code, '_blank');
        });
	
		$(document).on('click', '.btn-search', function(){
			var search = $(this).closest('input').find('.search').text();
			var page = $(this).closest('li').find('.paging').text();
			showInvoice(page, search);
		});
    
        $(document).on('click', '.delete-btn-transaction', function(){
            if(confirm('Delete Transaction?')){
            
            var transaction_id = $(this).closest('td').find('.transactionId').text();
            var transaction_code = $(this).closest('td').find('.transactionCode').text();
            
            // trigger the delete file
            $.post("/keranjangsayur/views/transaction/delete_transaction.php", { transaction_id: transaction_id, transaction_code: transaction_code }).done(function(data){
                console.log(data);
                
                // show loader image
                $('#loader-image').show();
                // reload invoice
                showTransaction(transaction_code);
            });
            }
        });
        
        $(document).on('click', '.btn-print-shipping-invoice-pdf', function(){
            var fromDate = $('#fromDate').val();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_shipping_detail_pdf_v2.php?fromDate=' + fromDate, '_blank');
        });
        
        $(document).on('click', '.btn-print-shipping-invoice-xls', function(){
            var fromDate = $('#fromDate').val();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_shipping_detail_xls_v2.php?fromDate=' + fromDate, '_blank');
        });
    
        $(document).on('click', '.btn-print-shipping-detail-pdf', function(){
            var fromDate = $('#fromDate').val();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_shipping_detail_pdf.php?fromDate=' + fromDate, '_blank');
        });
    
        $(document).on('click', '.btn-export-invoice-xls', function(){
            var dateOne = $('#dateOne').val();
            var dateTwo = $('#dateTwo').val();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_invoice_by_date.php?dateOne=' + dateOne +'&dateTwo=' + dateTwo, '_blank');
        });
    
        $(document).on('click', '.btn-export-invoice-pdf', function(){
            var dateOne = $('#dateOne').val();
            var dateTwo = $('#dateTwo').val();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_invoice_by_date_pdf.php?dateOne=' + dateOne +'&dateTwo=' + dateTwo, '_blank');
        });
    
        $(document).on('click', '.btn-print-shipping-detail-xls', function(){
            var fromDate = $('#fromDate').val();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_shipping_detail_xls.php?fromDate=' + fromDate, '_blank');
        });
    
        $(document).on('click', '.btn-print-detail-packing-pdf', function(){
            var fromDate = $('#fromDate').val();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_detailpacking_pdf.php?fromDate=' + fromDate, '_blank');
        });
    
        $(document).on('click', '.btn-print-detail-packing-xls', function(){
            var fromDate = $('#fromDate').val();
            
            var win = window.open('/keranjangsayur/views/transaction/output/print_detailpacking_xls.php?fromDate=' + fromDate, '_blank');
        });
		// end of transaction
		
		// user
		
		$(document).on('click', '.btn-create-user', function(){
			$('#loader-image').show();
            changePageTitle('Create User');
            // first view
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/user/form.php', function(){
                $('#loader-image').hide();    
                $('#page-content').fadeIn('fast');
            });
            });  
		});
	
		$(document).on('submit', '#create_user', function(){
			$('#loader-image').show();
			
			$.post("/keranjangsayur/views/user/create.php", $(this).serialize()).done(function(data){
				var page = 1;
				var search = "";
				showUser(page, search);
            });
            
            return false;
						
		});
	
		$(document).on('submit', '#update_user', function(){
			$('#loader-image').show();
			
			$.post("/keranjangsayur/views/user/update.php", $(this).serialize()).done(function(data){
				var page = 1;
				var search = "";
				showUser(page, search);
            });
            
            return false;
						
		});
	
		$(document).on('click', '.delete-btn-user', function(){
            if(confirm('Delete User?')){
            
            var user_id = $(this).closest('td').find('.userId').text();
            
            // trigger the delete file
            $.post("/keranjangsayur/views/user/delete.php", { user_id: user_id }).done(function(data){
                console.log(data);
                
                // show loader image
                $('#loader-image').show();
                
                // reload category list
                var page = 1;
				var search = "";
                showUser(page, search);
            });
            }
        });
		
		$(document).on('click', '.edit-btn-user', function(){
            var user_id = $(this).closest('td').find('.userId').text();
            changePageTitle('Edit User');
            // show a loader image
            $('#loader-image').show();
            
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/user/update-form.php?user_id=' + user_id, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        });
		
		// end user
	
		// highlight
		$('#create_highlight').click(function(){
            $('#loader-image').show();
            changePageTitle('Create Highlight');
            // first view
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/highlight/form.php', function(){
                $('#loader-image').hide();    
                $('#page-content').fadeIn('fast');
            });
            });          
        });
	
		$(document).on('click', '.btn-create-highlight', function(){
			$('#loader-image').show();
            changePageTitle('Create highlight');
            // first view
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/highlight/form.php', function(){
                $('#loader-image').hide();    
                $('#page-content').fadeIn('fast');
            });
            });  
		});
	
		$(document).on('submit', '#create_highlight', function(){
			$('#loader-image').show();
			
			$.post("/keranjangsayur/views/highlight/create.php", $(this).serialize()).done(function(data){
				var page = 1;
				var search = "";
				showHighlight(page, search);
            });
            
            return false;
						
		});
	
		$(document).on('submit', '#update_highlight', function(){
			$('#loader-image').show();
			
			$.post("/keranjangsayur/views/highlight/update.php", $(this).serialize()).done(function(data){
				var page = 1;
				var search = "";
				showHighlight(page, search);
            });
            
            return false;
						
		});
	
		$(document).on('click', '.delete-btn-highlight', function(){
            if(confirm('Delete Highlight?')){
            
            var highlight_id = $(this).closest('td').find('.highlightId').text();
            
            // trigger the delete file
            $.post("/keranjangsayur/views/highlight/delete.php", { highlight_id: highlight_id }).done(function(data){
                console.log(data);
                
                // show loader image
                $('#loader-image').show();
                
                // reload highlight list
                var page = 1;
				var search = "";
                showHighlight(page, search);
            });
            }
        });
		
		$(document).on('click', '.edit-btn-highlight', function(){
            var highlight_id = $(this).closest('td').find('.highlightId').text();
            changePageTitle('Edit Highlight');
            // show a loader image
            $('#loader-image').show();
            
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/highlight/update-form.php?highlight_id=' + highlight_id, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        });
		
		// end of highlight
	
        // customer
    
        $('#create_customer').click(function(){
            $('#loader-image').show();
            changePageTitle('Create customer');
            // first view
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/customer/form.php', function(){
                $('#loader-image').hide();    
                $('#page-content').fadeIn('fast');
            });
            });          
        });
    
        $(document).on('submit', '#create_customer', function() {

            $('#loader-image').show();
                
            $.post("/keranjangsayur/views/customer/create.php", $(this).serialize()).done(function(data){
                var page = 1;
                var search = "";
                showCustomer(page, search);
            });
            
            return false;
            
        });
    
        $(document).on('click', '.edit-btn-customer', function(){
            var customer_id = $(this).closest('td').find('.customerId').text();
            changePageTitle('Keranjang Sayur');
            // show a loader image
            $('#loader-image').show();
            
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/customer/update-form.php?customer_id=' + customer_id, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        });
    
        $(document).on('click', '.delete-btn-customer', function(){
            if(confirm('Delete customer?')){
            
            var customer_id = $(this).closest('td').find('.customerId').text();
            
            // trigger the delete file
            $.post("/keranjangsayur/views/customer/delete.php", { customer_id: customer_id }).done(function(data){
                console.log(data);
                
                // show loader image
                $('#loader-image').show();
                
                // reload customer list
                var page = 1;
                var search = "";
                showCustomer(page, search);
            });
            }
        });        
        
        $(document).on('submit', '#update_customer', function(){
            // show a loader img
            $('#loader-image').show();
            
            $.post("/keranjangsayur/views/customer/update.php", $(this).serialize()).done(function(data){
                var page = 1;
                var search = "";
                showCustomer(page, search);
            });
            
            return false;
        });

        // end of customer

        // voucher

        $(document).on('click', '#add_voucher', function(){
            changePageTitle('Add Voucher');
            var customer_id = $('#customerId').val();
            // show a loader image
            $('#loader-image').show();
            
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/voucher/form.php?customer_id=' + customer_id, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        });

        $(document).on('click', '.edit-btn-voucher', function(){
            var voucher_id = $(this).closest('td').find('.voucherId').text();
            var customer_id = $(this).closest('td').find('.customerId').text();
            changePageTitle('Keranjang Sayur');
            // show a loader image
            $('#loader-image').show();
            
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/voucher/update-form.php?voucher_id=' + voucher_id + '&customer_id=' + customer_id, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        });
    
        $(document).on('click', '.delete-btn-voucher', function(){
            if(confirm('Delete voucher?')){
            
            var voucher_id = $(this).closest('td').find('.voucherId').text();
            var customer_id = $(this).closest('td').find('.customerId').text();
            // trigger the delete file
            $.post("/keranjangsayur/views/voucher/delete.php", { voucher_id: voucher_id }).done(function(data){
                console.log(data);
                
                // show loader image
                $('#loader-image').show();
                
                // reload voucher list
                var page = 1;
                var search = "";
                showVoucher(customer_id);
            });
            }
        });        
        
        $(document).on('submit', '#create_voucher', function() {

            $('#loader-image').show();

            $.post("/keranjangsayur/views/voucher/create.php", $(this).serialize()).done(function(data){
                var customer_id = $('#customerId').val();
                showVoucher(customer_id);
            });
            
            return false;
            
        });

        $(document).on('submit', '#update_voucher', function(){
            // show a loader img
            $('#loader-image').show();
            
            $.post("/keranjangsayur/views/voucher/update.php", $(this).serialize()).done(function(data){
                var page = 1;
                var search = "";
                var customer_id = $('#customerId').val();
                showVoucher(customer_id);
            });
            
            return false;
        });

        // voucher
		// paging
		
		// invoice
		$(document).on('click', '.btn-paging-invoice', function(){
			var page = $(this).closest('li').find('.paging-invoice').text();
			var search = "";
			showInvoice(page, search);
		});
		
		// category
		$(document).on('click', '.btn-paging-category', function(){
			var page = $(this).closest('li').find('.paging-category').text();
			var search = "";
			showCategory(page, search);
		});
		
		// item
		$(document).on('click', '.btn-paging-item', function(){
			var page = $(this).closest('li').find('.paging-item').text();
			var search = "";
			showItem(page, search);
		});
		
		// unit
		$(document).on('click', '.btn-paging-unit', function(){
			var page = $(this).closest('li').find('.paging-unit').text();
			var search = "";
			showUnit(page, search);
		});
	
		// user
		$(document).on('click', '.btn-paging-user', function(){
			var page = $(this).closest('li').find('.paging-user').text();
			var search = "";
			showUser(page, search);
		});
	
        // customer

        $(document).on('click', '.btn-paging-customer', function(){
            var page = $(this).closest('li').find('.paging-customer').text();
            var search = "";
            showCustomer(page, search);
        });

		// highlight

		// category
		$(document).on('click', '.btn-paging-highlight', function(){
			var page = $(this).closest('li').find('.paging-highlight').text();
			var search = "";
			showHighlight(page, search);
		});
	
		// end of paging
		
		// search
		
		$(document).on('click', '.btn-search-invoice', function(){
			var page = 1;
			var search = $('#search-box-invoice').val();
			var stringReplace = search.replace(" ", "+");
			showInvoice(page, stringReplace);
		});
	
		$(document).on('click', '.btn-search-category', function(){
			var page = 1;
			var search = $('#search-box-category').val();
			var stringReplace = search.replace(" ", "+");
			showCategory(page, stringReplace);
		});
	   
        $(document).on('click', '.btn-search-customer', function(){
            var page = 1;
            var search = $('#search-box-customer').val();
            var stringReplace = search.replace(" ", "+");
            showCustomer(page, stringReplace);
        });

		$(document).on('click', '.btn-search-item', function(){
			var page = 1;
			var search = $('#search-box-item').val();
			var stringReplace = search.replace(" ", "+");
			showItem(page, stringReplace);
		});
	
		$(document).on('click', '.btn-search-unit', function(){
			var page = 1;
			var search = $('#search-box-unit').val();
			var stringReplace = search.replace(" ", "+");
			showUnit(page, stringReplace);
		});
	
		$(document).on('click', '.btn-search-user', function(){
			var page = 1;
			var search = $('#search-box-user').val();
			var stringReplace = search.replace(" ", "+");
			showUser(page, stringReplace);
		});
	
		$(document).on('click', '.btn-search-highlight', function(){
			var page = 1;
			var search = $('#search-box-highlight').val();
			var stringReplace = search.replace(" ", "+");
			showHighlight(page, stringReplace);
		});
	
		// end of search
	
	    function printInvoice(){
            var invoice_code = $(this).closest('td').find('.invoiceCode').text();
			
			$('#loader-image').show();
			$('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/print_invoice.php?invoice_code=' + invoice_code, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
        
        function formTransaction(){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/form_invoice.php', function(){
                    // hide loader image
					$('.chosen-select').chosen({width : "300px"});
                    $('#loader-image').hide();
                    $('#page-content').fadeIn('fast');
                });
            });
        }
        
        function showTransaction(invoice_code){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/show_transaction.php?invoice_code=' + invoice_code, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
    
        function showCategory(page, search){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/category/show.php?page=' + page + '&q=' + search, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
        
        function showItem(page, search){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/item/show.php?page=' + page + '&q=' + search, function(){
                    // hide loader image
                    $('#loader-image').hide();
                    
                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
        
        function showUnit(page, search){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/unit/show.php?page=' + page + '&q=' + search, function(){
                    // hide loader image
                    $('#loader-image').hide();
                    
                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
	
		function showInvoice(page, search){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/show_invoice.php?page=' + page + '&q=' + search, function(){
                    // hide loader image
                    $('#loader-image').hide();
                    
                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
	       
        function showDetailPacking(){
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/form_shipping_detail.php', function(){
                    // hide loader image
                    $('#loader-image').hide();
                    
                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
    
        function showShippingInvoice(){
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/form_shipping_invoice.php', function(){
                    // hide loader image
                    $('#loader-image').hide();
                    
                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
	
		function showDetailPackingSplit(){
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/form_detail_packing_split.php', function(){
                    // hide loader image
                    $('#loader-image').hide();
                    
                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
    	
        function showExportInvoice(){
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/transaction/form_print_invoice_by_date.php', function(){
                    // hide loader image
                    $('#loader-image').hide();
                    
                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
    
		function showUser(page, search){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/user/show.php?page=' + page + '&q=' + search, function(){
                    // hide loader image
                    $('#loader-image').hide();
                    
                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
	
		function showHighlight(page, search){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/highlight/show.php?page=' + page + '&q=' + search, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }

        function showCustomer(page, search){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/customer/show.php?page=' + page + '&q=' + search, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }

        function showVoucher(customer_id){
            // fade out effect first
            $('#page-content').fadeOut('fast', function(){
                $('#page-content').load('/keranjangsayur/views/voucher/show.php?customer_id=' + customer_id, function(){
                    // hide loader image
                    $('#loader-image').hide(); 

                    // fade in effect
                    $('#page-content').fadeIn('fast');
                });
            });
        }
	
        $('#show_category').click(function(){
            $('#loader-image').show();
            changePageTitle('Show Category');
			var page = 1;
			var search = "";
            showCategory(page, search);
        });
        
        $('#show_item').click(function(){
            $('#loader-image').show();
            changePageTitle('Show Item');
			var page = 1;
			var search = "";
            showItem(page, search);
        });
    
        $('#show_unit').click(function(){
            $('#loader-image').show();
            changePageTitle('Show Unit');
			var page = 1;
			var search = "";
            showUnit(page, search);
        });
	
		$('#show_invoice').click(function(){
			$('#loader-image').show();
			changePageTitle('Show Invoice');
			var page = 1;
			var search = "";
			showInvoice(page, search);
		});
    
        $('#detail_packing').click(function(){
			$('#loader-image').show();
			changePageTitle('Create Daily Omzet');
			showDetailPacking();
		});
    
        $('#shipping_invoice').click(function(){
			$('#loader-image').show();
			changePageTitle('Create Shipping Invoice');
            showShippingInvoice();
		});
    	
		$('#show-user').click(function(){
			$('#loader-image').show();
			changePageTitle('Show User');
			var page = 1;
			var search = "";
			showUser(page, search);
		});
	
		$('#detail_packing_pisah').click(function(){
			$('#loader-image').show();
			changePageTitle('Create Detail Packing');
			showDetailPackingSplit();
		});
	
        $('#export_invoice').click(function(){
			$('#loader-image').show();
			changePageTitle('Export Invoice');
			showExportInvoice();
		});
    
		$('#show_highlight').click(function(){
			$('#loader-image').show();
			changePageTitle('Show Highlight');
			var page = 1;
			var search = "";
			showHighlight(page, search);
		});
	   
        $('#show_customer').click(function(){
            $('#loader-image').show();
            changePageTitle('Show customer');
            var page = 1;
            var search = "";
            showCustomer(page, search);
        });
       
        $(document).on('click', '#show_voucher', function(){
            $('#loader-image').show();
            changePageTitle('Show Voucher');
            var customer_id = $('#cId').val();
            showVoucher(customer_id);
        });

		function welcomePage(){
		$('#page-content').fadeOut('fast', function(){
			$('#page-content').load('/keranjangsayur/welcomepage.php', function(){
				// hide loader image
				$('#loader-image').hide();

				// fade in effect
				$('#page-content').fadeIn('fast');
			});
		});
		}
    
        function changePageTitle(page_title){ 
        // ubah judul halaman 
        $('#page-title').text(page_title);  
        //ubah judul halaman 
        document.title=page_title; 
        }

        $('input.number').keyup(function(event) {

              // skip for arrow keys
              if(event.which >= 37 && event.which <= 40) return;

              // format number
              $(this).val(function(index, value) {
                return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                ;
              });
        });
        
});
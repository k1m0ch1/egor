$(document).ready(function(){
	$('#cancel-New').on('click', function(){
		$('table tr:last-child').remove();
	});

	$('[id^=simpanName]').on('click', function(){
		var currentID = $(this).attr('id').split('-')[1];
		var a = $('#txtHref-' + currentID).val();
		var b = $('#txtName-' + currentID).val();
		$.ajax({
            url: host + 'admin/menu[edit:save]',
            type: 'POST',
            data: {id: currentID, redirect: a, name: b},
            dataType: 'html',
            success: function(data) {
              console.log(currentID);
              $('#txtName-' + currentID).hide();
			  $('#simpanName-' + currentID).hide();
			  $('#cancelName-' + currentID).hide();
			  $.ajax({
		            url: host + 'admin/menu[select]',
		            type: 'GET',
		            data: {id: currentID},
		            dataType: 'html',
		            success: function(data) {
		              var hasil = JSON.parse(data);
		              $('#lblName-' + currentID).html(hasil[0].name);
			  		  $('#txtName-' + currentID).val(hasil[0].name);
			  		  $('#lblName-' + currentID).show();
		            }
		         });			  
            }
         });
	});

	$('[id^=simpanHref]').on('click', function(){
		var currentID = $(this).attr('id').split('-')[1];
		var a = $('#txtHref-' + currentID).val();
		var b = $('#txtName-' + currentID).val();
		$.ajax({
            url: host + 'admin/menu[edit:save]',
            type: 'POST',
            data: {id: currentID, redirect: a, name: b},
            dataType: 'html',
            success: function(data) {
			  $('#txtHref-' + currentID).hide();
			  $('#simpanHref-' + currentID).hide();
			  $('#cancelHref-' + currentID).hide();
			  $.ajax({
		            url: host + 'admin/menu[select]',
		            type: 'GET',
		            data: {id: currentID},
		            dataType: 'html',
		            success: function(data) {
		              var hasil = JSON.parse(data);
		              $('#lblHref-' + currentID).html(hasil[0].redirect);
			  		  $('#txtHref-' + currentID).val(hasil[0].redirect);
			  		  $('#lblHref-' + currentID).show();
		            }
		         });			  
            }
         });
	});

	$('#simpan-New').on('click', function(){
		var a = $('#txtHref-New' + currentID).val();
		var b = $('#txtName-New' + currentID).val();
		$.ajax({
            url: host + 'admin/menu[add:save]',
            type: 'POST',
            data: {id: currentID, redirect: a, name: b},
            dataType: 'html',
            success: function(data) {
			  $('#txtHref-' + currentID).hide();
			  $('#simpanHref-' + currentID).hide();
			  $('#cancelHref-' + currentID).hide();
			  $.ajax({
		            url: host + 'admin/menu[select]',
		            type: 'GET',
		            data: {id: currentID},
		            dataType: 'html',
		            success: function(data) {
		              var hasil = JSON.parse(data);
		              $('#lblHref-' + currentID).html(hasil[0].redirect);
			  		  $('#txtHref-' + currentID).val(hasil[0].redirect);
			  		  $('#lblHref-' + currentID).show();
		            }
		         });			  
            }
         });
	});
});
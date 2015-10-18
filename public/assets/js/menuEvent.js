$(document).ready(function(){
	
	dialog_child = $( "#child-form" ).dialog({
      autoOpen: false,
      height: 500,
      width: 700,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"btn-addChild", text: "Tambah Child",
                  click: function() {
                      addChild();
                }},
                {
                  id:"btn-cancel", text: "Cancel",
                  click: function() {
                  	  $(':input','#child-form')
						 .not(':button, :submit, :reset, :hidden')
						 .val('')
						 .removeAttr('checked')
						 .removeAttr('selected');
                      $(this).dialog("close");
                }}]
    });

    function addChild(){
		//$('<tr><td>Stuff</td></tr>').insertBefore('table > tbody > tr:nth-child(2)').next();
		var num = parseInt($('table#child-Form-table tr:last-child').children('td:first').text());
		//console.log(num+1);
		var str1 = '<tr><td>' + (num+1) + '</td><td><label id="lblName-New"></label><input type="text" id="txtName-New" style="width: 150px; float: left;" size=1 class="form-control"/></td>';
		var str2 = '<td>not yet</td>';
		var str3 = '<td><label id="lblHref-New"></label><input type="text" id="txtHref-New" class="form-control"/></td>';
		var str4 = '<td style="width: 100px;"><button class="btn btn-primary" id="simpan-New" style="margin-left: 3px;"><i class="fa fa-save"></i></button><button class="btn btn-danger" id="cancel-New" style="margin-left: 1px;"><i class="fa fa-close"></i></button></td></tr>';
		$(str1 + str2 + str3 + str4).appendTo('table > tbody ');
		$('#lblHref-New').hide();
		$('#lblName-New').hide();
		
		$.getScript( dir_host + "assets/js/menuOperation.js" )
	        .done(function( script, textStatus ) {
	            console.log( textStatus );
	        })
	        .fail(function( jqxhr, settings, exception ) {
	        $( "div.log" ).text( "Triggered ajaxError handler." );
	    });
	}

	$('#cancel-New').on('click', function(){
		$('table tr:last-child').remove();
	});

	$('[id^=simpanName]').on('click', function(){
		var currentID = $(this).attr('id').split('-')[1];
		var a = $('#txtHref-' + currentID).val();
		var b = $('#txtName-' + currentID).val();
		$.ajax({
            url:  host + 'admin/menu[edit:save]',
            type: 'POST',
            data: {id: currentID, redirect: a, name: b},
            dataType: 'html',
            success: function(data) {
              console.log(currentID);
              $('#txtName-' + currentID).hide();
			  $('#simpanName-' + currentID).hide();
			  $('#cancelName-' + currentID).hide();
			  $.ajax({
		            url:  host + 'admin/menu[select]',
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
		            url:  host + 'admin/menu[select]',
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
		var a = $('#txtHref-New').val();
		var b = $('#txtName-New').val();
		$.ajax({
            url:  host + 'admin/menu[add:save]',
            type: 'POST',
            data: {redirect: a, name: b},
            dataType: 'html',
            success: function(data) {
			  location.reload();			  
            }
         });
	});
});
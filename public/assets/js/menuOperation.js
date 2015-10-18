$(document).ready(function(){

	$( window ).load(function() {
		$.getScript(  dir_host + "assets/js/menuEvent.js" )
	              .done(function( script, textStatus ) {
	                console.log( textStatus );
	              })
	              .fail(function( jqxhr, settings, exception ) {
	                $( "div.log" ).text( "Triggered ajaxError handler." );
	            });
	});

	$('[id^=txtName]').hide();
	$('[id^=simpanName]').hide();
	$('[id^=cancelName]').hide();
	$('[id^=txtHref]').hide();
	$('[id^=simpanHref]').hide();
	$('[id^=cancelHref]').hide();	

	$('[id^=editMenu]').on('click', function(){
		var currentID = $(this).attr('id').split('-')[1];
		$('#lblName-' + currentID).hide();
		$('#txtName-' + currentID).show();
		$('#simpanName-' + currentID).show();
		$('#cancelName-' + currentID).show();
		$('#lblHref-' + currentID).hide();
		$('#txtHref-' + currentID).show();
		$('#simpanHref-' + currentID).show();
		$('#cancelHref-' + currentID).show();
	});

	$('[id^=cancelName]').on('click', function(){
		var currentID = $(this).attr('id').split('-')[1];
		$('#lblName-' + currentID).show();
		$('#txtName-' + currentID).hide();
		$('#simpanName-' + currentID).hide();
		$('#cancelName-' + currentID).hide();
	});

	$('[id^=cancelHref]').on('click', function(){
		var currentID = $(this).attr('id').split('-')[1];
		$('#lblHref-' + currentID).show();
		$('#txtHref-' + currentID).hide();
		$('#simpanHref-' + currentID).hide();
		$('#cancelHref-' + currentID).hide();
	});

	$('[id^=childMenu]').on('click', function(){
		dialog_child.dialog("open");
		var currentID = $(this).attr('id');
        currentID = currentID.split('-')[1];
		$.ajax({
	         url:  host + 'admin/menu:child',
	         type: 'GET',
	         data : { id: currentID },
	         dataType: 'html',
	         success: function(data){
	         	$('#form-child').html(data);
	         	$.getScript(  dir_host + "assets/js/menuEvent.js" )
	              .done(function( script, textStatus ) {
	                console.log( textStatus );
	              })
	              .fail(function( jqxhr, settings, exception ) {
	                $( "div.log" ).text( "Triggered ajaxError handler." );
	            });
	         }
	      });
	});

	$('[id^=delMenu]').on('click', function(){
		var konfirm = confirm("Yakin Hapus Data ?");
		if(konfirm){
			var currentID = $(this).attr('id').split('-')[1];
			$.ajax({
		         url:  host + 'admin/menu[del]',
		         type: 'GET',
		         data : { id: currentID },
		         dataType: 'html',
		         success: function(data){
		         	if(data=="success delParent"){
		         		location.reload();
		         	}
		         }
		      });
	 	}
	});

	$('#tambah').on('click', function(){
		//$('<tr><td>Stuff</td></tr>').insertBefore('table > tbody > tr:nth-child(2)').next();
		var num = parseInt($('table tr:last-child').children('td:first').text());
		//console.log(num+1);
		var str1 = '<tr><td>' + (num+1) + '</td><td><label id="lblName-New"></label><input type="text" id="txtName-New" style="width: 150px; float: left;" size=1 class="form-control"/></td>';
		var str2 = '<td>not yet</td>';
		var str3 = '<td><label id="lblHref-New"></label><input type="text" id="txtHref-New" class="form-control"/></td>';
		var str4 = '<td style="width: 100px;"><button class="btn btn-primary" id="simpan-New" style="margin-left: 3px;"><i class="fa fa-save"></i></button><button class="btn btn-danger" id="cancel-New" style="margin-left: 1px;"><i class="fa fa-close"></i></button></td></tr>';
		$(str1 + str2 + str3 + str4).appendTo('table > tbody ');
		$('#lblHref-New').hide();
		$('#lblName-New').hide();
		
		$.getScript( dir_host + "assets/js/menuEvent.js" )
	        .done(function( script, textStatus ) {
	            console.log( textStatus );
	        })
	        .fail(function( jqxhr, settings, exception ) {
	        $( "div.log" ).text( "Triggered ajaxError handler." );
	    });
	});
});
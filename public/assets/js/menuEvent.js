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

    dialog_add_child = $( "#add_child-form" ).dialog({
      autoOpen: false,
      height: 310,
      width: 500,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"btn-addChild", text: "Simpan",
                  click: function() {
                      simpanNewChild();
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
		dialog_add_child.dialog("open");
		
		$.ajax({
	         url:  host + 'admin/menu:child[add]',
	         type: 'GET',
	         data : { id: $('#parent_id').val() },
	         dataType: 'html',
	         success: function(data){
	         	$('#add_form-child').html(data);
	         	$.getScript(  dir_host + "assets/js/menuEvent.js" )
	              .done(function( script, textStatus ) {
	                console.log( textStatus );
	              })
	              .fail(function( jqxhr, settings, exception ) {
	                $( "div.log" ).text( "Triggered ajaxError handler." );
	            });
	         }
	      });		
	}

	function simpanNewChild(){
		var a = $('#add_child-form input#name').val();
		var b = $('#add_child-form input#href').val();
		var c = $('#add_child-form input#parent_id').val();
		var d = $('#add_child-form input#idnyah').val();
		$.ajax({
	         url:  host + 'admin/menu:child[add:save]',
	         type: 'POST',
	         data : { name:a, redirect:b, parent_id: c, id: d},
	         dataType: 'html',
	         success: function(data){
	         	dialog_add_child.dialog("close");
	         	$.ajax({
		         url:  host + 'admin/menu:child',
		         type: 'GET',
		         data : { id: $('#parent_id').val() },
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
	         }
	      });	
	}

	$('#cancel-New').on('click', function(){
		$('table tr:last-child').remove();
	});

	$('[id^=delChild').on('click', function(){
		var aw = confirm("Yakin Hapus Data ?");
		if(aw){
			var currentID = $(this).attr('id').split('-');		    
			$.ajax({
			    url:  host + 'admin/menu:child[del]',
			    type: 'GET',
			    data: {parent_id:currentID[2], id:currentID[1]},
			    dataType: 'html',
			    success: function(data){
			    	$.ajax({
			         url:  host + 'admin/menu:child',
			         type: 'GET',
			         data : { id: $('#parent_id').val() },
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
			    }
			});
		}
	});

	$('[id^=editChild').on('click', function(){
			var currentID = $(this).attr('id').split('-');
			dialog_add_child.dialog("open");		    
			$.ajax({
			    url:  host + 'admin/menu:child[edit]',
			    type: 'GET',
			    data: {parent_id:currentID[2], id:currentID[1]},
			    dataType: 'html',
			    success: function(data){
			    	$('#add_form-child').html(data);
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
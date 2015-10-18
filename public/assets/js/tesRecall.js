$(document).ready(function(){

	$("[id^=editGrid]").hide();
	$("[id^=childGrid]").hide();
	$("[id^=delGrid]").hide();

	$('[id^=childGrid]').on('click', function(e){
		dialog_child.dialog( "open" );
		var currentID = $(this).attr('id');
        currentID = currentID.split('-')[1];
        var getID = $('#idGambar' + currentID).val();
		$.ajax({
	         url:  host + 'admin/form:child',
	         type: 'GET',
	         data : { id: getID },
	         dataType: 'html',
	         success: function(data){
	         	$('#form-child').html(data);
	         	$.getScript(  dir_host + "assets/js/tesRecall.js" )
	              .done(function( script, textStatus ) {
	                console.log( textStatus );
	              })
	              .fail(function( jqxhr, settings, exception ) {
	                $( "div.log" ).text( "Triggered ajaxError handler." );
	            });
	         }
	      });
	});

	$('[id^=editChild]').on('click', function(e){
		dialog_new_child.dialog( "open" );
		var currentID = $(this).attr('id');
        currentID = currentID.split('-')[1];
        var getID = $('#child_id').val();
		$.ajax({
	         url:  host + 'admin/form:child[edit]',
	         type: 'GET',
	         data : { id: currentID },
	         dataType: 'html',
	         success: function(data){
	         	$('#add-form_child').html(data);
	         }
	      });
	});

	$('[id^=delChild]').on('click', function(e){
		var konfirm = confirm("Yakin Menghapus Child ?");
		if(konfirm){
				var currentID = $(this).attr('id');
		        currentID = currentID.split('-')[1];
		        var getID = $('#child_id').val();
				$.ajax({
			         url:  host + 'admin/form:child[delete]',
			         type: 'GET',
			         data : { id: currentID },
			         dataType: 'html',
			         success: function(data){
			         	var currentID = $(this).attr('id').split('-')[1];
			         	$.ajax({
					         url:  host + 'admin/form:child',
					         type: 'GET',
					         data : { id: currentID },
					         dataType: 'html',
					         success: function(data){
					         	$('#form-child').html(data);
					         	dialog_child.dialog( "close" );
					         	dialog_child.dialog( "open" );
					         }
					      });
			         }
			      });
		}
	});

	$('[id^=delGrid]').on('click', function(e){
		var konfirm = confirm("Yakin Menghapus Grid ?");
		if(konfirm){
				var currentID = $(this).attr('id');
		        currentID = currentID.split('-')[1];
				$.ajax({
			         url:  host + 'admin/dashboard[delete]',
			         type: 'GET',
			         data : { id: currentID },
			         dataType: 'html',
			         success: function(data){
			         	location.reload();
			         }
			      });
		}
	});

	$('[id^=editGrid]').on('click', function(e){
            dialog.dialog( "open" );
            var currentTD = $(this).parent();
            damn = $('tr td').index(currentTD);
            var currentID = $(this).attr('id');
            currentID = currentID.split('-')[1];
            var getID = $('#idGambar' + currentID).val();
            $.ajax({
	         url:  host + 'admin/form:dashboard',
	         type: 'GET',
	         data: { id: getID },
	         dataType: 'html',
	         success: function(data){
	         	$.ajax({
		            url:  host + "assets/css/image-picker.css",
		            dataType:"script",
		            success:function(data){
		                $("head").append("<style>" + data + "</style>");
		            }
		        });
	         	$('#formnyah').html(data);
	         	$.getScript(  dir_host + "/assets/js/image-picker.js" )
		              .done(function( script, textStatus ) {
		                console.log( textStatus );
		              })
		              .fail(function( jqxhr, settings, exception ) {
		                $( "div.log" ).text( "Triggered ajaxError handler." );
		            });
	         }
	      });
    });

	$(".pindah").hover(function(){
               // Mouse-over, move and show 'minimenu'
		 var parent = $(this).parents("#menu-wrapper tr td"); // "This" is the image, "galleryitem" is the container
		 var parent_pos = parent.position; // Get X and Y position of container
		 var minimenu = $("[id^=editGrid]");
		 var minimenu2 = $("[id^=childGrid]");
		 var minimenu3 = $("[id^=delGrid]");
		 minimenu.css("position", "absolute");
		 minimenu.css("left", 142+"px");
		 minimenu.css("top", -192+"px");
		 minimenu.show();
		 minimenu2.css("position", "absolute");
		 minimenu2.css("left", 107+"px");
		 minimenu2.css("top", -192+"px");
		 minimenu2.show();
		 minimenu3.css("position", "absolute");
		 minimenu3.css("left", 107+"px");
		 minimenu3.css("top", -192+"px");
		 minimenu3.show();
	 },function(){	                // Mouse out, hide menu
		 $("[id^=editGrid]").hide();
		 $("[id^=childGrid]").hide();
		 $("[id^=delGrid]").hide();
	 });

});
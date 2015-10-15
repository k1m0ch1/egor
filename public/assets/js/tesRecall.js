$(document).ready(function(){

	var host = 'http://' + $(location).attr('host') + '/egor/public/';

	$('[id^=editGrid]').on('click', function(e){
            dialog.dialog( "open" );
            var currentTD = $(this).parent();
            damn = $('tr td').index(currentTD);
            var currentID = $(this).attr('id');
            currentID = currentID.split('-')[1];
            var getID = $('#idGambar' + currentID).val();
            $.ajax({
	         url: host + 'index.php/admin/form:dashboard',
	         type: 'GET',
	         data: { id: getID },
	         dataType: 'html',
	         success: function(data){
	         	$.ajax({
		            url: host + "assets/css/image-picker.css",
		            dataType:"script",
		            success:function(data){
		                $("head").append("<style>" + data + "</style>");
		                //loading complete code here
		            }
		        });
	         	$('#formnyah').html(data);
	         	$.getScript( host + "/assets/js/image-picker.js" )
		              .done(function( script, textStatus ) {
		                console.log( textStatus );
		              })
		              .fail(function( jqxhr, settings, exception ) {
		                $( "div.log" ).text( "Triggered ajaxError handler." );
		            });
	         }
	      });
    });

});
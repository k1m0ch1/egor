$(document).ready(function(){

	$('[id^=editGrid]').on('click', function(e){
            dialog.dialog( "open" );
            var currentTD = $(this).parent();
            damn = $('tr td').index(currentTD);
            var currentID = $(this).attr('id');
            currentID = currentID.split('-')[1];
            var getID = $('#idGambar' + currentID).val();
            $.ajax({
	         url: 'http://localhost/egor/public/index.php/admin/form:dashboard',
	         type: 'GET',
	         data: { id: getID },
	         dataType: 'html',
	         success: function(data){
	         	$.ajax({
		            url:"http://localhost/egor/public/assets/css/image-picker.css",
		            dataType:"script",
		            success:function(data){
		                $("head").append("<style>" + data + "</style>");
		                //loading complete code here
		            }
		        });
	         	$('#formnyah').html(data);
	         	$.getScript( "http://localhost/egor/public/assets/js/image-picker.js" )
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
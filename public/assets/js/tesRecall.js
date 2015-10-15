$(document).ready(function(){

	var host = 'http://' + $(location).attr('host') + '/egor/public/';
	$("[id^=editGrid]").hide();
	$("[id^=childGrid]").hide();

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

	$(".pindah").hover(function(){
               // Mouse-over, move and show 'minimenu'
		 var parent = $(this).parents("#menu-wrapper tr td"); // "This" is the image, "galleryitem" is the container
		 var parent_pos = parent.position; // Get X and Y position of container
		 var minimenu = $("[id^=editGrid]");
		 var minimenu2 = $("[id^=childGrid]");
		 minimenu.css("position", "absolute");
		 minimenu.css("left", 142+"px");
		 minimenu.css("top", -192+"px");
		 minimenu.show();
		 minimenu2.css("position", "absolute");
		 minimenu2.css("left", 107+"px");
		 minimenu2.css("top", -192+"px");
		 minimenu2.show();
	 },function(){	                // Mouse out, hide menu
		 $("[id^=editGrid]").hide();
		 $("[id^=childGrid]").hide();
	 });

});
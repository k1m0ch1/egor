$(document).ready(function(){

    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 410,
      width: 500,
      modal: true,
      buttons: {
        "Simpan": simpan,
        Cancel: function() {
          dialog.dialog( "close" );
        }
      },
      close: function() {
        form[0].reset();
      }
    });

   form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      simpan();
    });

    $('[id^=editRule]').on('click', function(){
        alert('wtf');
    		var currentID = $(this).attr('id');
    		currentID = currentID.split('-')[1];
    		var idnyah = currentID;
            dialog.dialog( "open" );
            $.ajax({
	            url:  host + 'admin/roles[edit:show]',
	            type: 'GET',
	            data: { id: id, as: "edit" },
	            dataType: 'html',
	            success: function(data) {
	            	$('#formnyah').html(data);
	            }
	         });
    });

    function simpan(){
    	var a = $('#dialog-form form input#name').val();
	    var b = $('#dialog-form form input#email').val();
	    var c = $('#dialog-form form input#password').val();
	    var d = $('#dialog-form form input#idnyah').val();
    	$.ajax({
	            url: host+ 'admin/users[edit:save]',
	            type: 'POST',
	            data: { id: d, name: a, email: b, password: c},
	            dataType: 'html',
	            success: function(data) {
	            	
	            }
	         });
    	dialog.dialog("close");    
    }
});
$(document).ready(function(){
	$('[id^=editUser]').on('click', function(){
    		var currentID = $(this).attr('id');
    		currentID = currentID.split('-')[1];
    		var idnyah = currentID;
            dialog.dialog( "open" );
            $.ajax({
	            url:  host + 'admin/users[edit:show]',
	            type: 'GET',
	            data: { id: idnyah },
	            dataType: 'html',
	            success: function(data) {
	            	$('#formnyah').html(data);
	            }
	         });
    });

    $('[id^=delUser]').on('click', function(){
      var konfirm = confirm("Yakin hapus data ?");
      if(konfirm){
        var currentID = $(this).attr('id');
        currentID = currentID.split('-')[1];
        var idnyah = currentID;
            $.ajax({
              url:  host + 'admin/users[delete]',
              type: 'GET',
              data: { id: idnyah },
              dataType: 'html',
              success: function(data) {
                $.ajax({
                    url:  host + 'admin/users[show]',
                    type: 'GET',
                    dataType: 'html',
                    success: function(data){
                      $('#tbody-user').html(data);
                      $.getScript(  dir_host + "assets/js/user_js_event.js" )
                      .done(function( script, textStatus ) {
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
});
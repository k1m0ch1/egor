$(document).ready(function(){


   $( window ).load(function() {
      $.ajax({
          url:  host + 'admin/roles[show]',
          type: 'GET',
          dataType: 'html',
          success: function(data){
            $('#tbody-roles').html(data);
            $.getScript(  dir_host + "assets/js/roleEvent.js" )
            .done(function( script, textStatus ) {
            })
            .fail(function( jqxhr, settings, exception ) {
              $( "div.log" ).text( "Triggered ajaxError handler." );
            });
         }
      }); 
   });

   $('[id^=editRule]').on('click', function(){
                var currentID = $(this).attr('id');
                currentID = currentID.split('-')[1];
                var idnyah = currentID;
                    dialog.dialog("open");
                    $.ajax({
                      url:  host + 'admin/roles[edit:show]',
                      type: 'GET',
                      data: { id: currentID, as: "edit" },
                      dataType: 'html',
                      success: function(data) {
                        $('#formnyah').html(data);
                      }
                   });
    });

});
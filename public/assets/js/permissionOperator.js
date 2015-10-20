$(document).ready(function(){
   $( window ).load(function() {
      $.ajax({
          url:  host + 'admin/permission[show]',
          type: 'GET',
          dataType: 'html',
          success: function(data){
            $('#tbody-permission').html(data);
            $.getScript(  dir_host + "assets/js/permissionEvent.js" )
            .done(function( script, textStatus ) {
            })
            .fail(function( jqxhr, settings, exception ) {
              $( "div.log" ).text( "Triggered ajaxError handler." );
            });
         }
      });
   });

   $('[id^=editPermission]').on('click', function(){
                var currentID = $(this).attr('id');
                currentID = currentID.split('-')[1];
                var idnyah = currentID;
                    dialog.dialog("open");
                    $.ajax({
                      url:  host + 'admin/permission[edit:show]',
                      type: 'GET',
                      data: { id: currentID, as: "edit" },
                      dataType: 'html',
                      success: function(data) {
                        $('#formnyah').html(data);
                      }
                   });
    });

   $('[id^=delPermission]').on('click', function(){
      var konfirm = confirm("Yakin Hapus Data?");
      if(konfirm){
                var currentID = $(this).attr('id');
                currentID = currentID.split('-')[1];
                var idnyah = currentID;
                    $.ajax({
                      url:  host + 'admin/permission[del]',
                      type: 'GET',
                      data: { id: currentID},
                      dataType: 'html',
                      success: function(data) {
                          $.ajax({
                            url:  host + 'admin/permission[show]',
                            type: 'GET',
                            dataType: 'html',
                            success: function(data){
                               $('#tbody-permission').html(data);
                              $.getScript(  dir_host + "assets/js/permissionOperator.js" )
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

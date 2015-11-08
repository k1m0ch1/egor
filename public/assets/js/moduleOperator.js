$(document).ready(function(){
   $( window ).load(function() {
      $.ajax({
          url:  host + 'admin/module[show]',
          type: 'GET',
          dataType: 'html',
          success: function(data){
            $('#tbody-module').html(data);
            $.getScript(  dir_host + "assets/js/moduleEvent.js" )
            .done(function( script, textStatus ) {
            })
            .fail(function( jqxhr, settings, exception ) {
              $( "div.log" ).text( "Triggered ajaxError handler." );
            });
         }
      });
   });

   $('[id^=editModule]').on('click', function(){
                var currentID = $(this).attr('id');
                currentID = currentID.split('-')[1];
                var idnyah = currentID;
                    dialog.dialog("open");
                    $.ajax({
                      url:  host + 'admin/module[edit:show]',
                      type: 'GET',
                      data: { id: currentID, as: "edit" },
                      dataType: 'html',
                      success: function(data) {
                        $('#formnyah').html(data);
                      }
                   });
    });

   $('[id^=deleteModule]').on('click', function(){
      var konfirm = confirm("Yakin Hapus Data?");
      if(konfirm){
                var currentID = $(this).attr('id');
                currentID = currentID.split('-')[1];
                var idnyah = currentID;
                    $.ajax({
                      url:  host + 'admin/module[del]',
                      type: 'GET',
                      data: { id: currentID},
                      dataType: 'html',
                      success: function(data) {
                          $.ajax({
                            url:  host + 'admin/module[show]',
                            type: 'GET',
                            dataType: 'html',
                            success: function(data){
                               $('#tbody-module').html(data);
                              $.getScript(  dir_host + "assets/js/moduleOperator.js" )
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

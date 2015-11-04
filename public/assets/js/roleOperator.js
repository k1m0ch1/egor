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

    $('[id^=delRule]').on('click', function(){
    	var konfirm = confirm("Yakin Hapus Data?");
      	if(konfirm){
                var currentID = $(this).attr('id');
                currentID = currentID.split('-')[1];
                var idnyah = currentID;
                    $.ajax({
                      url:  host + 'admin/roles[del]',
                      type: 'GET',
                      data: { id: currentID},
                      dataType: 'html',
                      success: function(data) {
                        	$.ajax({
			                  url:  host + 'admin/roles[show]',
			                  type: 'GET',
			                  dataType: 'html',
			                  success: function(data){
			                    $('#tbody-roles').html(data);
			                    $.getScript(  dir_host + "assets/js/roleOperator.js" )
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

		$('[id^=editPermission]').on('click', function(){
				var currentID = $(this).attr('id');
				currentID = currentID.split('-')[1];
				dialogSetPermission.dialog("open");
				$.ajax({
					url:  host + 'admin/permission[show2]',
					type: 'GET',
					data : {role_id: currentID},
					dataType: 'html',
					success: function(data) {
						$('#form-setPermission').html(data);
					}
				});
			// 	$.ajax({
			// 		url:  host + 'admin/roles[permission:show]',
			// 		type: 'GET',
			// 		data: { id: currentID },
			// 		dataType: 'html',
			// 		success: function(data) {
			// 			$('#tbody-permission-roles').html(data);
			// 		}
			// });
		});

   $("select#permission_id").on('change', function(){
      console.log(this);
      $.get(host + '/api/v1/permission/show/'+this.val(), function(data){
        console.log(data);
      })
    });
});

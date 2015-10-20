$(document).ready(function(){

	$("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });

    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 320,
      width: 700,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"btn-simpan", text: "Simpan",
                  click: function() {
                      simpanPermission();
                }},
                {
                  id:"btn-cancel", text: "Cancel",
                  click: function() {
                      $(':input','#child-form')
                         .not(':button, :submit, :reset, :hidden')
                         .val('')
                         .removeAttr('checked')
                         .removeAttr('selected');
                      $(this).dialog("close");
                }}]
    });

   form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      simpanPermission();
    });

   $('#tambah').on('click', function(){
        dialog.dialog("open");
            $.ajax({
              url:  host + 'admin/permission[add:show]',
              type: 'GET',
              data: { as: "add" },
              dataType: 'html',
              success: function(data) {
                $('#formnyah').html(data);
              }
           });
    });

   function simpanPermission(){
      var id = $('input#id').val();
      var as = id=="xxx"?"add":"edit";
      var name = $('input#name').val();
      var displayname = $('input#displayName').val();
      var description = $('textarea#description').val();
			var action = $('select#action').val();
			var access = $('select#access').val();
      console.log(description);
      $.ajax({
           url:  host + 'admin/permission[edit:save]',
           type: 'POST',
           data : { id: id, as : as, name : name, displayname:displayname, description:description, action: action, access:access},
           dataType: 'html',
           success: function(data){
              dialog.dialog("close");
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

    $('[id^=deletePermission]').on('click', function(){
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

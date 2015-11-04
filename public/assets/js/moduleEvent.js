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
      height: 420,
      width: 500,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"btn-simpan", text: "Simpan",
                  click: function() {
                      simpanModule();
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
      simpanModule();
    });

   $('#tambah').on('click', function(){
        dialog.dialog("open");
            $.ajax({
              url:  host + 'admin/module[add:show]',
              type: 'GET',
              data: { as: "add" },
              dataType: 'html',
              success: function(data) {
                $('#formnyah').html(data);
              }
           });
    });

   function simpanModule(){
      var id = $('input#id').val();
      var as = id=="xxx"?"add":"edit";
      var name = $('input#name').val();
      var route = $('input#route').val();
      var description = $('textarea#description').val();
      $.ajax({
           url:  host + 'admin/module[edit:save]',
           type: 'POST',
           data : { id: id, as : as, name : name, route:route,
						description:description},
           dataType: 'html',
           success: function(data){
              dialog.dialog("close");
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
			                    $.getScript(  dir_host + "assets/js/ModuleOperator.js" )
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

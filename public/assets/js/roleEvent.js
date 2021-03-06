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
      height: 430,
      width: 500,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"btn-simpan", text: "Simpan",
                  click: function() {
                      simpanRoles();
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

		dialogPermission = $( "#dialog-form-permission" ).dialog({
      autoOpen: false,
      height: 430,
      width: 700,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"btn-simpan", text: "Tambah",
                  click: function() {
                      setPermission();
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

		dialogSetPermission = $( "#dialog-form-setPermission" ).dialog({
      autoOpen: false,
			height: 430,
      width: 700,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"btn-simpan", text: "Simpan",
                  click: function() {
										saveSetPermission();
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
      simpanRoles();
    });

		formPermission = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      setPermission();
    });

		formSetPermission = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      saveSetPermission();
    });

   $('#tambah').on('click', function(){
        dialog.dialog("open");
            $.ajax({
              url:  host + 'admin/roles[add:show]',
              type: 'GET',
              data: { as: "add" },
              dataType: 'html',
              success: function(data) {
                $('#formnyah').html(data);
              }
           });
    });

   function simpanRoles(){
      var id = $('input#id').val();
      var as = id=="xxx"?"add":"edit";
      var name = $('input#name').val();
      var displayname = $('input#displayName').val();
      var description = $('textarea#description').val();
      console.log(name);
      $.ajax({
           url:  host + 'admin/roles[edit:save]',
           type: 'POST',
           data : { id: id, as : as, name : name, displayname:displayname, description:description},
           dataType: 'html',
           success: function(data){
              dialog.dialog("close");
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

	function setPermission(){
		dialogSetPermission.dialog("open");
		$.ajax({
			url:  host + 'admin/permission[show2]',
			type: 'GET',
			data : {role_id: $('#role_id').val()},
			dataType: 'html',
			success: function(data) {
				$('#form-setPermission').html(data);
			}
		});
	}

	function saveSetPermission(){
		var role_id = $('#role_id').val();
		var modCount = $('#modCount').val();
		var appCount = $('#appCount').val();
		var modPerm = Array();
		var appPerm = Array();
		var x = 0;
		for(var a=0;a<modCount;a++){
			if($('input#modID-'+a+':checked').length>0){
				modPerm[x++] = $('input#modID-'+a+':checked').val();
			}
		}

		modPerm = JSON.stringify(modPerm);

		var x = 0;
		for(var a=0;a<appCount;a++){
			if($('input#appID-'+a+':checked').length>0){
				appPerm[x++] = $('input#appID-'+a+':checked').val();
			}
		}

		appPerm = JSON.stringify(appPerm);

		$.ajax({
			url:  host + 'admin/roles[set:permission]',
			type: 'POST',
			data: {role_id: role_id, modPerm: modPerm, appPerm: appPerm},
			dataType: 'html',
			success: function(data) {
				dialogSetPermission.dialog('close');
			}
		});
	}

    $("#permission_id").on('change', function(){
      console.log(this);
      $.get(host + '/api/v1/permission/show/'+this.val(), function(data){
        console.log(data);
      })
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

});

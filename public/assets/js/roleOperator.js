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

   form = dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      simpanRoles();
    });

   $( window ).load(function() {
      $.ajax({
          url:  host + 'admin/roles[show]',
          type: 'GET',
          dataType: 'html',
          success: function(data){
            $('#tbody-roles').html(data);
         }
      }); 
   });

   function simpanRoles(){
      var id = $('input#id').val();
      var name = $('input#name').val();
      var displayname = $('input#displayName').val();
      var description = $('input#description').val();
      $.ajax({
           url:  host + 'admin/roles[edit:save]',
           type: 'POST',
           data : { id: id, as : "edit", name : name, displayname:displayname, description:description},
           dataType: 'html',
           success: function(data){
              dialog.dialog("close");
              $.ajax({
                 url:  host + 'admin/roles[edit:save]',
                 type: 'POST',
                 data : { id: id, as : "edit", name : name, displayname:displayname, description:description},
                 dataType: 'html',
                 success: function(data){
                    dialog.dialog("close");
                 }
              });  
           }
        });   
   }

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
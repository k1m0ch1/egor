$(document).ready(function(){

    dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 420,
      width: 700,
      modal: true,
      draggable: false,
			resizable: false,
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

    dialogAdd = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 540,
      width: 700,
      modal: true,
      draggable: false,
			resizable: false,
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

   $( window ).load(function() {
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
   });

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
            dialog.dialog( "open" );
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

    function simpan(){
    	var a = $('#dialog-form form input#name').val();
	    var b = $('#dialog-form form input#email').val();
	    var d = $('#dialog-form form input#idnyah').val();
      var e = $("#dialog-form form input[type=radio][name=roles]:checked").val();
      var f = d=="xxx"?$('#dialog-form form input#password').val():"";
      var g = $('#dialog-form form input#phone').val();
      var h = $('#dialog-form form input#jabatan').val();
      var i = $('#dialog-form form input#Upassword').val();
      var j = $('#dialog-form form input#nip').val();

      var fd = new FormData();
      fd.append("name", a);
      fd.append("email", b);
      fd.append("avatar", $('#fileUpload').prop('files')[0]);
      if(d != 'xxx'){
        fd.append("id", d);
      }
      fd.append("roles", e);
      fd.append("password", f);
      fd.append("password_confirmation", i);
      fd.append("as", "add");
      fd.append("phone", g);
      fd.append("department", h);
      fd.append("nip", j);
    	$.ajax({
	            url: host+ 'admin/users[edit:save]',
	            type: 'POST',
              processData: false,
              contentType: false,
	            data: fd,
	            dataType: 'html',
	            success: function(data) {
	            	$.ajax({
                    url:  host + 'admin/users[show]',
                    type: 'GET',
                    dataType: 'html',
                    success: function(data){
                      console.log(data);
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
    	dialog.dialog("close");
    }

    $('#tambah').on('click', function(){
        dialogAdd.dialog("open");
            $.ajax({
              url:  host + 'admin/users[add:show]',
              type: 'GET',
              data: { as: "add" },
              dataType: 'html',
              success: function(data) {
                $('#formnyah').html(data);
              }
           });
    });
});

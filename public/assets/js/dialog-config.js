$(document).ready(function(){

	dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 420,
      width: 500,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"simpanData", text: "Simpan",
                  click: function() {
                      simpan();
                  }}, 
                {
                  id:"btn-cancel", text: "Cancel",
                  click: function() {
                  	  $(':input','dialog-form')
						 .not(':button, :submit, :reset, :hidden')
						 .val('')
						 .removeAttr('checked')
						 .removeAttr('selected');
                      $(this).dialog("close");
                }}]
    });

   dialog_child = $( "#child-form" ).dialog({
      autoOpen: false,
      height: 500,
      width: 700,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"btn-addChild", text: "Tambah Child",
                  click: function() {
                      addChild();
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

   dialog_new_child = $( "#add-child-form" ).dialog({
      autoOpen: false,
      height: 420,
      width: 500,
      modal: true,
      draggable: false,
      buttons: [{
                  id:"simpan-child", text: "Simpan",
                  click: function() {
                      simpanNewChild();
                  }}, 
                {
                  id:"btn-cancel", text: "Cancel",
                  click: function() {
                  	  $(':input','#add-child-form')
						 .not(':button, :submit, :reset, :hidden')
						 .val('')
						 .removeAttr('checked')
						 .removeAttr('selected');
                      $(this).dialog("close");
                }}]
    });

   form = dialog.find( "form#dialog-form" ).on( "submit", function( event ) {
      event.preventDefault();
    });
   form_child = dialog.find( "form#child-form" ).on( "submit", function( event ) {
      event.preventDefault();
    });
   form_add_child = dialog.find( "form#add-child-form" ).on( "submit", function( event ) {
      event.preventDefault();
    });

    function addChild(){
      $.ajax({
            url: host + 'admin/form:child[add]',
            type: 'GET',
            data: { parent_id : $('#parent_id').val() } ,
            dataType: 'html',
            success: function(data) {
              $('#add-child-form').html(data);
              dialog_child.dialog( "close" );
              dialog_new_child.dialog("open");
              $.getScript( dir_host + "assets/js/tesRecall.js" )
              .done(function( script, textStatus ) {
                console.log( textStatus );
              })
              .fail(function( jqxhr, settings, exception ) {
                $( "div.log" ).text( "Triggered ajaxError handler." );
            });
            }
         });
   }

   function simpanNewChild(){
   		var a = $('#add-child-form input#name').val();
      	var b = $('#add-child-form input#href').val();
      	var c = $("#add-child-form input[type='radio'][name='target']:checked");
      	var d = $('#add-child-form input#idnyah').val();
      	var e = $('#add-child-form input#parent_id').val();
      	console.log(e);
      	c = c.length>0?c.val():0;
      	var myFormData2 = new FormData();
     	  myFormData2.append("image", $('#fileUpload').prop('files')[0]);
      	myFormData2.append("nama", a);
      	myFormData2.append("redirect", b);
      	myFormData2.append("mode", c);
      	myFormData2.append("idnyah", d);
      	myFormData2.append("parent_id", e);	
   		$.ajax({
            url: host + 'admin/form:child[add:save]',
            type: 'POST',
            processData: false,
	        contentType: false,
            data: myFormData2 ,
            dataType: 'html',
            success: function(data) {
              var e = $('#add-child-form input#parent_id').val();
              console.log(e);
              dialog_new_child.dialog( "close" );
              $.ajax({
      		         url: host + 'admin/form:child',
      		         type: 'GET',
      		         data : { id: e },
      		         dataType: 'html',
      		         success: function(data){
      		         	$('#form-child').html(data);
      		         	dialog_child.dialog( "open" );
      		         }
      		      });
            }
         });
   }

   function simpan(){
      var a = $('#dialog-form form input#name').val();
      var b = $('#dialog-form form input#href').val();
      //var c = $('#dialog-form form select#image').val();
      var c = $("input[type='radio'][name='target']:checked");
      c = c.length>0?c.val():0;
      var myFormData = new FormData();
      var d = $('#dialog-form form input#idnyah').val();
      if($('#fileUpload').prop('files').length > 0){
        myFormData.append("image", $('#fileUpload').prop('files')[0]);
      }

      myFormData.append("id", d);
      myFormData.append("nama", a);
      myFormData.append("redirect", b);
      myFormData.append("mode", c);

      $.ajax({
            url: host + 'admin/dashboard[edit:save]',
            type: 'POST',
            processData: false,
            contentType: false,
            data: myFormData,
            dataType: 'json',
            success: function(data) {
              $("#message-body").hide();
              var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text(data.message);
              var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
              $("#message-body").html(el);
              $("#message-body").fadeIn('slow');

              $("#img-thumbnail-"+d).attr('src', location.protocol+'//'+location.hostname+'/assets/img/uploaded/menu/'+data.result.image);
              dialog.dialog( "close" );
            }
         });
   }
});
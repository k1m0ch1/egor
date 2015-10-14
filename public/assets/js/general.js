$(document).ready(function(){
   var dialog = $( "#dialog-ajah" ).dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true
    });

   $( "#tambah" ).button().on( "click", function() {
      dialog.dialog( "open" );
   });
});
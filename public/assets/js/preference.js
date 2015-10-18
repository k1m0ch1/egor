$(document).ready(function(){

    $("select").imagepicker();

    var formTitle, formBackground, formLogo;

    formTitle = $( "#FormTitle" ).on( "submit", function( event ) {
      event.preventDefault();
      simpanTitle();
    });

    formBackground = $( "#FormBackground" ).on( "submit", function( event ) {
      event.preventDefault();
      simpanBackground();
    });

    formLogo = $( "#FormLogo" ).on( "submit", function( event ) {
      event.preventDefault();
      simpanLogo();
    });

    function simpanTitle(){
        var title = $('#inputTitle').val();
        $.ajax({
              url:  'admin/preference:title[save]',
              type: 'POST',
              data: { judul : title },
              dataType: 'html',
              success: function(data) {
                
              }
           });
    }

    function simpanBackground(){
        var a=$("#background option:selected" ).text();
        $.ajax({
              url:  'admin/preference:background[save]',
              type: 'POST',
              data: { namaFile : a },
              dataType: 'html',
              success: function(data) {
                
              }
           });
    }

    function simpanLogo(){
        var a=$("#logo option:selected" ).text();
        $.ajax({
              url:  'admin/preference:logo[save]',
              type: 'POST',
              data: { namaFile : a },
              dataType: 'html',
              success: function(data) {
                
              }
           });
    }
});
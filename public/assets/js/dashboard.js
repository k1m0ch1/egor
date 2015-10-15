$(document).ready(function(){

    var host = 'http://' + $(location).attr('host') + '/egor/public/';

   dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 400,
      width: 500,
      modal: true,
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

   function simpan(){
      var a = $('#dialog-form form input#name').val();
      var b = $('#dialog-form form input#href').val();
      var c = $('#dialog-form form select#image').val();
      var d = $('#dialog-form form input#idnyah').val();
      $.ajax({
            url: host + 'index.php/admin/dashboard[edit:save]',
            type: 'POST',
            data: { idnyah: d, nama: a, redirect: b, image: c },
            dataType: 'html',
            success: function(data) {
              dialog.dialog( "close" );
            }
         });
   }

   $( window ).load(function() {
      $.ajax({
         url: host + 'index.php/admin/grid',
         type: 'GET',
         data: { 'w': 3, 'h': 3},
         dataType: 'html',
         success: function(data) {
            $('#menu-wrapper').html("");
            $('#menu-wrapper').html(data);
            var cols = document.querySelectorAll('#menu-wrapper .pindah');
                   [].forEach.call(cols, function (col) {
                       col.addEventListener('dragstart', handleDragStart, false);
                       col.addEventListener('dragenter', handleDragEnter, false)
                       col.addEventListener('dragover', handleDragOver, false);
                       col.addEventListener('dragleave', handleDragLeave, false);
                       col.addEventListener('drop', handleDrop, false);
                       col.addEventListener('dragend', handleDragEnd, false);
                   });
            $.getScript( host + "assets/js/tesRecall.js" )
              .done(function( script, textStatus ) {
                console.log( textStatus );
              })
              .fail(function( jqxhr, settings, exception ) {
                $( "div.log" ).text( "Triggered ajaxError handler." );
            });
         }
      });

   });

   $('#grid-dashboard').change(function() {
      var dimension=$("#grid-dashboard option:selected" ).text();
      dimension = dimension.split('x');
      var w = dimension[0];
      var h = dimension[1];
      $.ajax({
         url: host + 'index.php/admin/grid',
         type: 'GET',
         data: { 'w': w, 'h': h},
         dataType: 'html',
         success: function(data) {
            $('#menu-wrapper').html("");
            $('#menu-wrapper').html(data);
            var cols = document.querySelectorAll('#menu-wrapper .pindah');
                   [].forEach.call(cols, function (col) {
                       col.addEventListener('dragstart', handleDragStart, false);
                       col.addEventListener('dragenter', handleDragEnter, false)
                       col.addEventListener('dragover', handleDragOver, false);
                       col.addEventListener('dragleave', handleDragLeave, false);
                       col.addEventListener('drop', handleDrop, false);
                       col.addEventListener('dragend', handleDragEnd, false);
                   });
         }
      });
   });

    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $('<p/>').text(file.name).appendTo(document.body);
            });
        }
    });

    $('#simpan').click(function(){
         //var dimension=$("#grid-dashboard option:selected" ).text();
         // dimension = dimension.split('x');
         // var total = dimension[0] * dimension[1];
         var countRow = $("table").find("tr td").length;         
         var aw = '';
         var iw = new Array(new Array());
         var ew = '';
         var uw = '';
         var ow = [];
         for(xx=0;xx<countRow;xx++){
            aw = $('#idGambar' + xx).parent();
            ew = $('tr td').index(aw)+1;
            uw = $('#idGambar' + xx).val();
            iw[xx] = new Array(uw, ew);
         }

         // for(xx=0;xx<countRow;xx++){
         //    console.log(iw[xx][0]);
         //    console.log(iw[xx][1]);
         // }

         $.ajax({
         url: host + 'index.php/admin/grid:savePosition',
         type: 'POST',
         data: { dataWaw : iw, size: countRow },
         dataType: 'json',
         success: function(data) {
            
         }
      });
    });
});
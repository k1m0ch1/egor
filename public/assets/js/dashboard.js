$(document).ready(function(){

    function makeid(){
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

      for( var i=0; i < 5; i++ )
          text += possible.charAt(Math.floor(Math.random() * possible.length));

      return text;
    }

   $( window ).load(function() {
      $.ajax({
         url: host + 'admin/grid',
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
            $.getScript( dir_host + "assets/js/tesRecall.js" )
              .done(function( script, textStatus ) {
                console.log( textStatus );
              })
              .fail(function( jqxhr, settings, exception ) {
                $( "div.log" ).text( "Triggered ajaxError handler." );
            });

            $.getScript( dir_host + "holder.js" )
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
         url: host + 'admin/grid',
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
            $.getScript( dir_host + "holder.js" )
              .done(function( script, textStatus ) {
                console.log( textStatus );
              })
              .fail(function( jqxhr, settings, exception ) {
                $( "div.log" ).text( "Triggered ajaxError handler." );
            });

            $.getScript( dir_host + "assets/js/tesRecall.js" )
              .done(function( script, textStatus ) {
                console.log( textStatus );
              })
              .fail(function( jqxhr, settings, exception ) {
                $( "div.log" ).text( "Triggered ajaxError handler." );
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
         url: host + 'admin/grid:savePosition',
         type: 'POST',
         data: { dataWaw : iw, size: countRow },
         dataType: 'json',
         success: function(data) {
            
         }
      });
    });
});
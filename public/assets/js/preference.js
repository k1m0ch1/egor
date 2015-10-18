$(document).ready(function(){

    $("select").imagepicker();

    $( window ).load(function() {
      var dirBG = 'assets/img/uploaded/background/';
      var selectorBG = 'selector-BG';
      var selectorLogo = 'selector-Logo';
      var dirMenu = 'assets/img/uploaded/menu/';
      var dirLogo = 'assets/img/uploaded/logo/';
      $.ajax({
              url:  host + 'admin/filesList',
              type: 'POST',
              data: { dir : dirBG, idSelector: selectorBG },
              dataType: 'html',
              success: function(data) {
                $('#FileBG').html(data);
                $.getScript(  dir_host + "assets/js/image-picker.js" )
                  .done(function( script, textStatus ) {
                  })
                  .fail(function( jqxhr, settings, exception ) {
                    $( "div.log" ).text( "Triggered ajaxError handler." );
                });
                $("#" + selectorBG).imagepicker();
              }
      });
      $.ajax({
              url:  host + 'admin/filesList',
              type: 'POST',
              data: { dir : dirLogo, idSelector: selectorLogo },
              dataType: 'html',
              success: function(data) {
                $('#FileLogo').html(data);
                $.getScript(  dir_host + "assets/js/image-picker.js" )
                  .done(function( script, textStatus ) {
                  })
                  .fail(function( jqxhr, settings, exception ) {
                    $( "div.log" ).text( "Triggered ajaxError handler." );
                });
                $("#" + selectorLogo).imagepicker();
              }
      });

    });
});
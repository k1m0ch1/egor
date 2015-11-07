$(document).ready(function(){

    $("select").imagepicker();

    $( window ).load(function() {
      $.get(host + 'api/v1/path/uploads/background').done(function(data){
        var dirBG = data.result;
        var selectorBG = 'selector-BG';
        var selectedBG = data.background;
        var selectedLogo = data.logo;
        $.ajax({
              url:  host + 'admin/filesList/background',
              type: 'POST',
              data: { dir : dirBG, idSelector: selectorBG },
              dataType: 'html',
              success: function(data) {
                $('#FileBG').html(data);
                $("#selector-BG option[value='" + selectedBG + "']").prop('selected', true);
                $.getScript(  dir_host + "assets/js/image-picker.js" )
                  .done(function( script, textStatus ) {
                  })
                  .fail(function( jqxhr, settings, exception ) {
                    $( "div.log" ).text( "Triggered ajaxError handler." );
                });
                $("#" + selectorBG).imagepicker();
              }
        });
      });

      $.get(host + 'api/v1/path/uploads/logo').done(function(data){
        var selectorLogo = 'selector-Logo';
        var dirLogo = data.result;
        var selectedBG = data.background;
        var selectedLogo = data.logo;
        $.ajax({
                url:  host + 'admin/filesList/logo',
                type: 'POST',
                data: { dir : dirLogo, idSelector: selectorLogo },
                dataType: 'html',
                success: function(data) {
                  $('#FileLogo').html(data);
                  $("#selector-Logo option[value='" + selectedLogo + "']").prop('selected', true);
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
});

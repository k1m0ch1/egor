$(function(){

    function reLoadBG(){
      $.get(host + 'api/v1/path/uploads/background').done(function(data){
        var dirBG = data.result;
        var selectorBG = 'selector-BG';
        $.ajax({
              url:  host + 'admin/filesList/background',
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
      });
    }

    function reloadLogo(){
      $.get(host + 'api/v1/path/uploads/logo').done(function(data){
        var selectorLogo = 'selector-Logo';
        var dirLogo = data.result;
        $.ajax({
                url:  host + 'admin/filesList/logo',
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
    }

    $("select").imagepicker();

    var ul = $('#upload ul');
    var ulLogo = $('#uploadLogo ul');
    var ulBg = $('#uploadBg ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    $('#drop-Logo a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });

    $('#drop-Bg a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });


    // Initialize the jQuery File Upload plugin
    $('#uploadLogo').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop-Logo'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working" id="logo"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ulLogo);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
                //location.reload();

            }
        },

        done:function(e, data){
          // console.log(data.result.info);
          // console.log(data.result.message);
          $("#message-body").hide();
          var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text(data.result.message);
          var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
          $("#message-body").html(el);
          $("#message-body").fadeIn('slow');
          reLoad();
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });

    $('#uploadBg').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop-Bg'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working" id="background"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ulBg);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data, response){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){

                data.context.removeClass('working');
                //location.reload();

            }
        },

        done:function(e, data){
          // console.log(data.result.info);
          // console.log(data.result.message);
          $("#message-body").hide();
          var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text(data.result.message);
          var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
          $("#message-body").html(el);
          $("#message-body").fadeIn('slow');
          reLoadBG();
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });

    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });

    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }

});

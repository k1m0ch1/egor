$(document).ready(function(){

	var formTitle, formBackground, formLogo, formFooter;

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

    formFooter = $( "#FormFooter" ).on( "submit", function( event ) {
      event.preventDefault();
      simpanFooter();
    });

	// $("#selector-Logo").on('change', function(){
	//       var dimension=$("#selector-Logo option:selected").text();
	//       console.log(dimension);
	// });

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

	function simpanLogo(){
		var fileName=$("#selector-Logo option:selected").text();
		$.ajax({
              url:  host + 'admin/preference:logo[save]',
              type: 'POST',
              data: { name: "logo", value : fileName },
              dataType: 'json',
              success: function(data) {
                $("#message-body").hide();
                var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text(data.message);
                var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
                $("#message-body").html(el);
                $("#message-body").fadeIn('slow');
              }
     	 });
	}

	function simpanBackground(){
		var fileName=$("#selector-BG option:selected").text();
		$.ajax({
              url:  host + 'admin/preference:background[save]',
              type: 'POST',
              data: { name: "background" ,value : fileName },
              dataType: 'json',
              success: function(data) {
                $("#message-body").hide();
                var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text(data.message);
                var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
                $("#message-body").html(el);
                $("#message-body").fadeIn('slow');
              }
     	 });
	}

	function simpanTitle(){
        var title = $('#inputTitle').val();
        $.ajax({
              url:  host + 'admin/preference:title[save]',
              type: 'POST',
              data: { name: "title", value : title },
              dataType: 'json',
              success: function(data) {
                $("#message-body").hide();
                var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text(data.message);
                var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
                $("#message-body").html(el);
                $("#message-body").fadeIn('slow');
              }
           });
    }

    function simpanFooter(){
        var text = $('#inputFooter').val();
        $.ajax({
              url:  host + 'admin/preference:footer[save]',
              type: 'POST',
              data: { name : "footer", value : text },
              dataType: 'json',
              success: function(data) {

                $("#message-body").hide();
                var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text(data.message);
                var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
                $("#message-body").html(el);
                $("#message-body").fadeIn('slow');
              }
           });
    }

		$('#hapusBackground').on('click', function(){
			if(confirm("Yakin Hapus Data?")){
				var fileName=$("#selector-BG option:selected").text();
				$.ajax({
									url:  host + 'admin/preference:background[delete]',
									type: 'POST',
									data: { name: "background" ,value : fileName },
									dataType: 'html',
									success: function(data) {
										$("#message-body").hide();
										var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text("File terhapus");
										var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
										$("#message-body").html(el);
										$("#message-body").fadeIn('slow');
										reLoadBG();
									}
					 });
			}
		});

		$('#hapusLogo').on('click', function(){
			if(confirm("Yakin Hapus Data?")){
				var fileName=$("#selector-Logo option:selected").text();
				$.ajax({
									url:  host + 'admin/preference:logo[delete]',
									type: 'POST',
									data: { name: "background" ,value : fileName },
									dataType: 'html',
									success: function(data) {
										$("#message-body").hide();
										var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text("File terhapus");
										var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
										$("#message-body").html(el);
										$("#message-body").fadeIn('slow');
										reLoadLogo();
									}
					 });
			}
		});

});

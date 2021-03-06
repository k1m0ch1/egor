$(document).ready(function(){
		var width = 3;
		var height = 3;
		function makeid(){
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

			for( var i=0; i < 5; i++ )
					text += possible.charAt(Math.floor(Math.random() * possible.length));

			return text;
		}
		// Loading grid size
	 $( window ).load(function() {
	 		$.get( host + 'api/v1/grid/size').done(function(data){
	 			width = data.w;
	 			height = data.h;

	 			$.ajax({
				 url:  host + 'admin/grid',
				 type: 'GET',
				 data: { 'w': width, 'h': height},
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
						$.getScript(  dir_host + "assets/js/tesRecall.js" )
							.done(function( script, textStatus ) {
							})
							.fail(function( jqxhr, settings, exception ) {
								$( "div.log" ).text( "Triggered ajaxError handler." );
						});

						$.getScript( dir_host +  "holder.js" )
							.done(function( script, textStatus ) {
							})
							.fail(function( jqxhr, settings, exception ) {
								$( "div.log" ).text( "Triggered ajaxError handler." );
						});
				 }
			});

	 		});

	 });

	 $('#grid-dashboard').change(function() {
			var dimension=$("#grid-dashboard option:selected" ).text();
			dimension = dimension.split('x');
			var w = dimension[0];
			var h = dimension[1];
			$.ajax({
				 url:  host + 'admin/setGrid',
				 type: 'GET',
				 data: { 'w': w, 'h': h},
				 dataType: 'json',
				 success: function(data) {
				 	$("#message-body").hide();
				 	var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text(data.message);
				 	var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
				 	$("#message-body").html(el);
				 	$("#message-body").fadeIn('slow');

					$.ajax({
						 url:  host + 'admin/grid',
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
								$.getScript(  dir_host + "holder.js" )
									.done(function( script, textStatus ) {
									})
									.fail(function( jqxhr, settings, exception ) {
										$( "div.log" ).text( "Triggered ajaxError handler." );
								});

								$.getScript(  dir_host + "assets/js/tesRecall.js" )
									.done(function( script, textStatus ) {
									})
									.fail(function( jqxhr, settings, exception ) {
										$( "div.log" ).text( "Triggered ajaxError handler." );
								});

						 }
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

				 var countRow = $("table").find("tr td").length;

					var aw = '';
				 	var iw = new Array(new Array());
					var ew = '';
					var uw = '';
					var ow = [];

					var idMenu = 0;
					var position = 0;
					var changes = new Array();
					$("table").find("tr td").each(function(){
						idMenu = this.getElementsByTagName("input")[0].value;
						position = (this.parentNode.rowIndex * height) + this.cellIndex + 1;
						if(idMenu != 'x'){
							changes.push(new Array(idMenu, position));
						}
					});

				 $.ajax({
				 url:  host + 'admin/grid:savePosition',
				 type: 'POST',
				 data: { dataWaw : changes, size: countRow },
				 dataType: 'json',
				 success: function(data) {
				 	$("#message-body").hide();
				 	var el = $('<div />').attr('class', 'alert alert-success alert-dismissable').text(data.message);
				 	var close = $('<button />').attr('type', 'button').attr('class', 'close').attr('data-dismiss', 'alert').text('x').appendTo(el);
				 	$("#message-body").html(el);
				 	$("#message-body").fadeIn('slow');
				 }
			});
		});
});
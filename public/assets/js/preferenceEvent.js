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

});

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
              data: { name: "Logo", value : fileName },
              dataType: 'html',
              success: function(data) {
                
              }
     	 });
	}

	function simpanBackground(){
		var fileName=$("#selector-BG option:selected").text();
		$.ajax({
              url:  host + 'admin/preference:background[save]',
              type: 'POST',
              data: { name: "Background" ,value : fileName },
              dataType: 'html',
              success: function(data) {
                
              }
     	 });
	}

	function simpanTitle(){
        var title = $('#inputTitle').val();
        $.ajax({
              url:  host + 'admin/preference:title[save]',
              type: 'POST',
              data: { name: "Title", value : title },
              dataType: 'html',
              success: function(data) {
                
              }
           });
    }

    function simpanFooter(){
        var text = $('#inputFooter').val();
        $.ajax({
              url:  host + 'admin/preference:footer[save]',
              type: 'POST',
              data: { name : "Footer", value : text },
              dataType: 'html',
              success: function(data) {
                
              }
           });
    }

});
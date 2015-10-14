$(document).ready(function(){

	$('[id^=editGrid]').on('click', function(e){
            dialog.dialog( "open" );
            var currentTD = $(this).parent();
            damn = $('tr td').index(currentTD);
            var currentID = $(this).attr('id');
            currentID = currentID.split('-')[1];
            var getID = $('#idGambar' + currentID).val();
            $.ajax({
	         url: 'http://localhost/egor/public/index.php/admin/form:dashboard',
	         type: 'GET',
	         data: { id: getID },
	         dataType: 'html',
	         success: function(data) {
	            $('#formnyah').html(data);
	         }
	      });
    });

});
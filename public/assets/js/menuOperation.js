$(document).ready(function(){

	$('[id^=txtName]').hide();
	$('[id^=simpanName]').hide();
	$('[id^=cancelName]').hide();
	$('[id^=txtHref]').hide();
	$('[id^=simpanHref]').hide();
	$('[id^=cancelHref]').hide();	

	$('[id^=editMenu]').on('click', function(){
		var currentID = $(this).attr('id').split('-')[1];
		$('#lblName-' + currentID).hide();
		$('#txtName-' + currentID).show();
		$('#simpanName-' + currentID).show();
		$('#cancelName-' + currentID).show();
		$('#lblHref-' + currentID).hide();
		$('#txtHref-' + currentID).show();
		$('#simpanHref-' + currentID).show();
		$('#cancelHref-' + currentID).show();
	});

	$('[id^=cancelName]').on('click', function(){
		var currentID = $(this).attr('id').split('-')[1];
		$('#lblName-' + currentID).show();
		$('#txtName-' + currentID).hide();
		$('#simpanName-' + currentID).hide();
		$('#cancelName-' + currentID).hide();
	});

	$('[id^=cancelHref]').on('click', function(){
		var currentID = $(this).attr('id').split('-')[1];
		$('#lblHref-' + currentID).show();
		$('#txtHref-' + currentID).hide();
		$('#simpanHref-' + currentID).hide();
		$('#cancelHref-' + currentID).hide();
	});

	$('#tambah').on('click', function(){
		$('#child-Form-table').append("<tr><<td>ROW</td><td>ROW</td><td>ROW</td><td>ROW</td><td>ROW</td>/tr>");
	});
});
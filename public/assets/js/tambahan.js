$(document).ready(function(){


	$("#tambah").click( function(){
			 var a = '<li class="pindah"><img src="http://localhost/egor/public/assets/img/addimage.png" alt="" /><a href=""><center>Baru Lamb</center></a></li>';
             $(".box-body .row ul li:last").after(a);
           }
      );
});
$(document).ready(function(){

	if($('input[name=error_msg]').length){
		var msg = $('input[name=error_msg]').val();
		swal({
		  title: 'Error!',
		  type: 'error',
		  html:msg,
		  confirmButtonText: 'Baiklah'
		})
	}


	if($('input[name=success_msg]').length){
		var msg = $('input[name=success_msg]').val();
		swal({
		  title: 'Selamat',
		  text: msg,
		  type: 'success',
		  confirmButtonText: 'OK'
		})
	}

	// if($('input[name=tanggal_lahir]').length){
	// 	$('input[name=tanggal_lahir]').datepicker({
	// 		format:'dd-mm-yyyy'
	// 	})
	// }

    jQuery.validator.addMethod("dateFormat",function(value,element){
			return this.optional(element) || /^\d{1,2}\-\d{1,2}\-\d{4}$/.test(value);
		},"The date formati must be DD-MM-YYYY, e.g: 17-08-1945");
})
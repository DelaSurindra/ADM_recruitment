$(document).ready(function(){

	if($('input[name=error_msg]').length){
		var msg = $('input[name=error_msg]').val();
		alert(msg);
	}


	if($('input[name=success_msg]').length){
		var msg = $('input[name=success_msg]').val();
		alert(msg);
	}
})
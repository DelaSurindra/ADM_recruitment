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

function deleteJob(id) {
    if (confirm("Anda yakin menghapus Lowongan ini?") == true) {
        window.location.href = "delete/"+id;
    } else {
		console.log('gagal');
	}
}

function deleteJobList(id) {
    if (confirm("Anda yakin menghapus Lowongan ini?") == true) {
        window.location.href = "vacancy/delete/"+id;
    } else {
		console.log('gagal');
	}
}
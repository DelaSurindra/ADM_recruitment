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

    var x = document.getElementById("roleCV").value;
    if (x==1) {
    	$("#titleCV").html("Submit you CV, resume or Portfolio below.");
    	$("#wizard-picture").prop('required',true);
    	$("#finish").prop('disabled', true);
    }else{
    	$("#titleCV").html("Submit you CV, resume or Portfolio below.</br> You can skip if you have submit them to our recruitment staff.");
    	$("#wizard-picture").prop('required',false);
    }
})

$( "#wizard-picture" ).change(function() {
    $("#finish").prop('disabled', false);
});

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

function editRole(id) {
    if (confirm("Anda yakin mengubah role input CV?") == true) {
        window.location.href = "vacancy/role/"+id;
    } else {
		console.log('gagal');
	}
}
// function deletePelamar(id) {
// 	// console.log($id);
//     if (confirm("Anda yakin menghapus Lamaran ini?") == true) {
//         window.location.href = "/delete/"+id;
//     } else {
// 		console.log('gagal');
// 	}
// }
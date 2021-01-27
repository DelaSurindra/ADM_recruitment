var form = {
	init:function(){
		$('form').attr('autocomplete', 'off');
		$.validator.addMethod("lettersonly", function(value, element) {
		 	return this.optional(element) || /^[a-z]+$/i.test(value);
		}, "Letters only please");

		$.validator.addMethod("regexp", function(value, element, regexpr) {
		 	return regexpr.test(value);
		}, "");
		$.each($('form'),function(key,val){
			$(this).validate(formrules[$(this).attr('id')]);
		});
		$('form').submit(function(e){
			e.preventDefault();
			console.log('masuk')
			var form_id = $(this).attr('id');
			form.validate(form_id);
		});

	},
	validate:function(form_id){

		var formVal = $('#'+form_id);
		var message = formVal.attr('message');
		var agreement = formVal.attr('agreement');
		var defaultOptions = {
			errorPlacement: function(error, element) {
				if (element.parent().hasClass('input-group')) {
					error.appendTo(element.parent().parent());
				} else {
					var help = element.parents('.form-group').find('.help-block');
					if(help.length){
						error.appendTo(help);
					}else{
						error.appendTo(element.parents('.form-group'))
					}
				}
			},
			highlight:function(element, errorClass, validClass){
				alert('test')
				$(element).parents('.form-group').addClass('has-error');
			},
			unhighlight:function(element, errorClass, validClass){

				$(element).parents('.form-group').removeClass('has-error');
			},
		}
		var ops = Object.assign(defaultOptions,formrules[form_id]);

		var myform = formVal.validate(ops);
		$('button[type=reset]').click(function(){
			myform.resetForm();
		});
		if(formVal.valid()){
			console.log(form_id)
			if(message!=null && message!=''){
				if(message.indexOf('|') > -1){
					var m_data = message.split('|');
					var m_text = m_data[0];
					var m_val = m_data[1];


					var t_data = m_val.split(';');
					var table = '<table class="table">';
					$.each(t_data,function(key,val){
						var c1 = val.split(':')[0];
						var c2 = form.find('input[name='+val.split(':')[1]+'],select[name='+val.split(':')[1]+']').val();
						table += '<tr><td>'+c1+'</td><td>'+c2+'</td></tr>';
					});
					table +='</table>';


					message = m_text+table;
				}
				ui.popup.confirm('Konfirmasi',message,'form.submit("'+form_id+'")');
			}
			else if(agreement != null && agreement != '') {
				message = $("#"+agreement).html();
				ui.popup.agreement('Persetujuan Agen Baru', message, 'form.submit("'+form_id+'")');
			}
			else{
				form.submit(form_id);
			}
		}else{
			ui.popup.show('error','Harap cek isian','Form Tidak Valid');
		}
	},
	submit:function(form_id){
		var form = $('#'+form_id);
		var url = form.attr('action');
		var ops = formrules[form_id];
		if(ops==null){
			ops={};
		}
		var i =1;
		var input = $('.form-control');
		var data = form.serialize();
		var isajax = form.attr('ajax');
		var isFilter = form.attr('filter');
		if(isajax=='true'){
			if(form_id=='payform'){
				form_id = $('#'+form_id).attr('for');
			}
			ajax.submitData(url,data,form_id);
		}else if(isFilter=='true'){
			table.filter(form_id,data);
		}else{
			other.encrypt(data,function(err,encData){
				if(err){
					callback(err);
				}else{
					var encryptedElement = $('<input type="hidden" name="data" />');
					$(encryptedElement).val(encData['data']);
					form.find('select,input:not("input[type=file],input[type=hidden][name=_token],input[name=captcha]")')
						.attr('disabled','true')
						.end()
						.append(encryptedElement)
						.unbind('submit')
						.submit();
				}
			});
		}

	}
}

// Select untuk get data wilayah
if ($('.select-provinsi').length) {
    $('.select-provinsi').empty();
	$('.select-provinsi').append('<label class="form-label">Provinsi</label>'+
								'<div class="input-form-select">'+
									'<select name="provinsi" id="provinsi" class="form-control select2 input-form-select">'+
										'<option></option>'+
									'</select>'+
								'</div>')

    $('.select-kota').empty();
	$('.select-kota').append('<label class="form-label">Kota/Kabupaten</label>'+
								'<div class="input-form-select">'+
									'<select name="kota" id="kota" class="form-control select2 input-form-select">'+
										'<option></option>'+
									'</select>'+
								'</div>')

    ajax.getData('wilayah/search-provinsi', 'post', null, function(data){
    	var dataProvinsi = [];
        for (var i = 0; i < data.length; i++) {
	      	var option = '<option value="'+data[i].propinsi+'">'+data[i].propinsi+'</option>'
		    dataProvinsi.push(option);
	    }

	    $("#provinsi").append(dataProvinsi);

	    $("#provinsi").select2({
	     	placeholder: 'Pilih Provinsi'
	    });

	    $("#kota").select2({
	     	placeholder: 'Pilih Kota'
	    });

	    $('#provinsi').change(function(){

	    	var provinsi = $('#provinsi').val();

	    	ajax.getData('wilayah/search-kota', 'post', {provinsi:provinsi}, function(data){
			    var dataKota = [];

            	$('.select-kota').empty();
			    $('.select-kota').append('<label class="form-label">Kota/Kabupaten</label>'+
											'<div class="input-form-select">'+
												'<select name="kota" id="kota" class="form-control select2 input-form-select">'+
													'<option></option>'+
												'</select>'+
											'</div>'
			    );


            	$("#kota").select2({
			     	placeholder: 'Pilih Kota'
			    });


			    for (var i = 0; i < data.length; i++) {
				      var option = '<option value="'+data[i].kabupaten+'">'+data[i].kabupaten+'</option>'

				      dataKota.push(option);
			    }

			    $("#kota").append(dataKota).val("").trigger("change");
    		});
		});
    });

}

if ($('.select-provinsi-edit').length) {
	$('#provinsiEdit').change(function(){

    	var provinsi = $('#provinsiEdit').val();

    	ajax.getData('wilayah/search-kota', 'post', {provinsi:provinsi}, function(data){
		    var dataKota = [];

        	$('.select-kota-edit').empty();
		    $('.select-kota-edit').append('<label>Kota/Kabupaten</label>'+
		                            '<select name="kotaEdit" id="kotaEdit" class="form-control upgrade-input">'+
		                                '<option></option>'+
		                            '</select>'
		    );


        	$("#kotaEdit").select2({
		     	placeholder: 'Pilih Kota'
		    });

		    for (var i = 0; i < data.length; i++) {
			      var option = '<option value="'+data[i].kabupaten+'">'+data[i].kabupaten+'</option>'

			      dataKota.push(option);
		    }

		    $("#kotaEdit").append(dataKota).val("").trigger("change");

		});
	});
}

// Fungsi Format rupiah untuk form
function formatRupiahRp(angka) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
	split = number_string.split(","),
	sisa = split[0].length % 3,
	rupiah = split[0].substr(0, sisa),
	ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if (ribuan) {
		separator = sisa ? "." : "";
		rupiah += separator + ribuan.join(".");
	}

	rupiah = split[1] != undefined ? rupiah + split[1] : rupiah;
	// return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
	return 'Rp '+rupiah
}
if ($('#formAddVa').length) {
	var billing_amount = document.getElementById('billing_amount');
  	billing_amount.addEventListener("keyup", function(e) {
	    // tambahkan 'Rp.' pada saat form di ketik
	    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
		billing_amount.value = formatRupiahRp(this.value);
	});
}
////////

var form = {
	init:function(){
		$('form').attr('autocomplete', 'off');
		if ($('.select2').length) {
			$('.select2').select2();
		}
		$('input').focus(function(){
			$(this).parents('.form-group').addClass('focused');
		});
		
		$('textarea').focus(function(){
			$(this).parents('.form-group').addClass('focused');
		});
		$('input').blur(function(){
			var inputValue = $(this).val();
			if ( inputValue == "" ) {
				$(this).removeClass('filled');
				$(this).parents('.form-group').removeClass('focused');
			} else {
				$(this).addClass('filled');
			}
		})
		$('textarea').blur(function(){
			var inputValue = $(this).val();
			if ( inputValue == "" ) {
				$(this).removeClass('filled');
				$(this).parents('.form-group').removeClass('focused');
			} else {
				$(this).addClass('filled');
			}
		})
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

function formatRupiahKoma(angka) {
    var number_string = angka.replace(/[^.\d]/g, "").toString(),
    split = number_string.split("."),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? "," : "";
        rupiah += separator + ribuan.join(",");
    }

    rupiah = split[1] != undefined ? rupiah + split[1] : rupiah;
    return rupiah
}

if ($("#formAddEventNews").length) {
	$('#tglMulaiNewsEvent').datetimepicker({
		format: 'DD-MM-YYYY',
	});

	$('#tglSelesaiNewsEvent').datetimepicker({
		format: 'DD-MM-YYYY',
	});

	$('#descriptionNewsEvent').summernote({
        height: 200, //set editable area's height
    });

	$('#descriptionNewsEvent').each(function () {
        var summernote = $(this);
        $('form').on('submit', function () {
            if (summernote.summernote('isEmpty')) {
                summernote.val('');
            } else if (summernote.val() == '<br>') {
                summernote.val('');
            }
        });
    });
}

if ($("#formEditEventNews").length) {
	$('#tglMulaiNewsEvent').datetimepicker({
		format: 'DD-MM-YYYY',
	});

	$('#tglSelesaiNewsEvent').datetimepicker({
		format: 'DD-MM-YYYY',
	});

	$('#descriptionNewsEvent').summernote({
        height: 200, //set editable area's height
    });

	$('#descriptionNewsEvent').each(function () {
        var summernote = $(this);
        $('form').on('submit', function () {
            if (summernote.summernote('isEmpty')) {
                summernote.val('');
            } else if (summernote.val() == '<br>') {
                summernote.val('');
            }
        });
    });
}

if ($("#formAddVacancy").length) {
	var minSalary = document.getElementById('minSalaryVacancy');
	minSalary.addEventListener("keyup", function (e) {
		minSalary.value = formatRupiahKoma(this.value);
	});

	var maxSalary = document.getElementById('maxSalaryVacancy');
	maxSalary.addEventListener("keyup", function (e) {
		maxSalary.value = formatRupiahKoma(this.value);
	});

	$('#activatedDate').datetimepicker({
		format: 'DD-MM-YYYY',
	});

	$('#descriptionVacancy').summernote({
        height: 200, //set editable area's height
    });

	$('#descriptionVacancy').each(function () {
        var summernote = $(this);
        $('form').on('submit', function () {
            if (summernote.summernote('isEmpty')) {
                summernote.val('');
            } else if (summernote.val() == '<br>') {
                summernote.val('');
            }
        });
    });
}

if ($("#formEditVacancy").length) {
	var minSalary = document.getElementById('minSalaryVacancy');
	minSalary.addEventListener("keyup", function (e) {
		minSalary.value = formatRupiahKoma(this.value);
	});

	var maxSalary = document.getElementById('maxSalaryVacancy');
	maxSalary.addEventListener("keyup", function (e) {
		maxSalary.value = formatRupiahKoma(this.value);
	});

	$('#activatedDate').datetimepicker({
		format: 'DD-MM-YYYY',
	});

	$('#descriptionVacancy').summernote({
        height: 200, //set editable area's height
    });

	$('#descriptionVacancy').each(function () {
        var summernote = $(this);
        $('form').on('submit', function () {
            if (summernote.summernote('isEmpty')) {
                summernote.val('');
            } else if (summernote.val() == '<br>') {
                summernote.val('');
            }
        });
    });
}

function readFile(input) {
    console.log(input.files, input.files[0])
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var htmlPreview = '<img src="' + e.target.result + '" style="width:100%;height:auto" />';
            var wrapperZone = $(input).parent();
            var previewZone = $(input).parent().parent().find('.preview-zone');
            var boxZone = $(input).parent().find('.dropzone-desc');
			var top = Math.floor(150/2);

            wrapperZone.removeClass('dragover');
            previewZone.removeClass('hidden');
            boxZone.empty();
			boxZone.css('top', '0');
            boxZone.append(htmlPreview);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
function reset(e) {
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
}

$(".dropzone").change(function(){
    readFile(this);
});
$('.dropzone-wrapper').on('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass('dragover');
});
$('.dropzone-wrapper').on('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass('dragover');
});
$('.remove-preview').on('click', function() {
    var boxZone = $(this).parents('.preview-zone').find('.box-body');
    var previewZone = $(this).parents('.preview-zone');
    var dropzone = $(this).parents('.form-group').find('.dropzone');
    boxZone.empty();
    previewZone.addClass('hidden');
    reset(dropzone);
});

$("#tipeNewsEvent").change(function(){
	var valueTipe = $("#tipeNewsEvent").val();
	
	if (valueTipe == "1") {
		$("#divDateNewsEvent").addClass('hidden');
		$(".dateNewsEvent").attr('disabled', true);
	} else {
		$("#divDateNewsEvent").removeClass('hidden');
		$(".dateNewsEvent").attr('disabled', false);
	}
})

if ($("#formFirstLogin").length) {
	$('#startDateEdication').datetimepicker({
		format: 'DD-MM-YYYY',
	});

	$('#endDateEdication').datetimepicker({
		format: 'DD-MM-YYYY',
	});

	$('.btnAddListEdication').click(function(e){
		e.preventDefault()
		$('.btnAddListEdication.large').hide()
		$('.firstBtnListEducation').removeClass('margin-right-2rem')
	
		var option = '<div class="listStudy">'+
						'<hr>'+
						'<div class="row">'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">School/University<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" class="form-control" placeholder="School/University">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Degree<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<select name="" id="" class="select2 form-control">'+
												'<option value="">Choose your degree</option>'+
												'<option value="">Opt 1</option>'+
												'<option value="">Opt 1</option>'+
											'</select>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Faculty<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" class="form-control" placeholder="Faculty">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Major<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" class="form-control" placeholder="Major">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Start Date<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12 with-icon">'+
											'<input type="text" class="form-control" placeholder="Choose date" id="startDateEdication" name="startDateEdication">'+
											'<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">End Date<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12 with-icon">'+
											'<input type="text" class="form-control" placeholder="Choose date" id="endDateEdication" name="endDateEdication">'+
											'<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Certificate of Study<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" class="form-control" placeholder="Format jpg/png maximum 2MB file">'+
											'<p id="filenameCertificateStudy" class="m-1"></p>'+
											'<span class="btn btn-file pl-1 mb-2">'+
												'Upload File <input type="file">'+
											'</span>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-lg-6 col-md-12 removeThisEducation">'+
								'<div class="form-group">'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<button type="button" class="btn btn-white btn-block btnAddListEdication">'+
												'<i class="fas fa-trash mr-2" style="font-size:18px"></i> Delete the Education Data Above'+
											'</button>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12 secondBtnEducation">'+
								'<div class="form-group">'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<button type="button" class="btn btn-white btn-block btnAddListEdication">'+
												'<i class="fas fa-plus mr-2" style="font-size:18px"></i> Add Another Education'+
											'</button>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
	
		$('#listEducationCandidate').append(option)
	
		$('input[name="startDateEdication"]').datetimepicker({
			format: 'DD-MM-YYYY',
		});
	
		$('input[name="endDateEdication"]').datetimepicker({
			format: 'DD-MM-YYYY',
		});
	
		if ($('.select2').length) {
			$('.select2').select2();
		}
		if ($('.removeThisEducation').length) {
			$('.removeThisEducation').click(function(){
				console.log('click')
				$(this).parent().parent().remove()

				if ($('.listStudy').length < 2) {
					$('.btnAddListEdication.large').show()
				}
			})
		}
		if ($('.secondBtnEducation').length) {
			$('.secondBtnEducation').click(function(){
				$(this).remove()
				$('.btnAddListEdication.large').click();
			})
		}
	})
}

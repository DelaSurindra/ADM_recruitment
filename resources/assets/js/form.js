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

		$('.goToLogin').click(function(){
			$('.modal').modal('hide');
			$('#modalLoginCandidate').modal('show')
		});
	
		$('.goToRegister').click(function(){
			$('.modal').modal('hide');
			$('#modalSignUpCandidate').modal('show')
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
			if (form_id == 'filterSearchList' || form_id == 'filterJobList') {
				var filterSearch = $('#filterSearchList').serialize();
				var filterJob = $('#filterJobList').serialize();
				data = filterSearch+'&'+filterJob;
			}
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

function formatRupiah(angka) {
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
	// var minSalary = document.getElementById('minSalaryVacancy');
	// minSalary.addEventListener("keyup", function (e) {
	// 	minSalary.value = formatRupiah(this.value);
	// });

	// var maxSalary = document.getElementById('maxSalaryVacancy');
	// maxSalary.addEventListener("keyup", function (e) {
	// 	maxSalary.value = formatRupiah(this.value);
	// });

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

	var next2 = 1;
	$(".add-more-syarat").click(function(e){
		e.preventDefault();
		var childDivs = document.querySelectorAll('#fieldMajorDiv'+next2+' span')
		console.log(childDivs);
		var addto = "#field-syarat" + next2;
		var addRemove = "#field-syarat" + (next2);
		next2 = next2 + 1;
		// var newIn = '<label>Syarat</label><input autocomplete="off" class="form-input bg-input form-control" id="field-syarat' + next2 + '" name="syarat[]" type="text" style="width: 93%; float: left;">';
		var newIn = '<select class="select2 min-width" id="field-syarat' + next2 + '" name="majorVacancy">'+
						'<option value="">-- Pilih Major --</option>'+
						'<option value="Sistem Informasi">Sistem Informasi</option>'+
						'<option value="Akuntansi">Akuntansi</option>'+
					'</select>';
		$("#field-syarat"+next2).select2();
		var newInput = $(newIn);
		var removeBtn = '<button id="remove-syarat' + (next2 - 1) + '" class="btn remove-me-syarat btn-min">-</button></><div id="field-syarat">';
		var removeButton = $(removeBtn);
		$(addto).after(newInput);
		$(addRemove).after(removeButton);

		$("#field-syarat" + next2).attr('data-source',$(addto).attr('data-source'));
		$("#count").val(next2);  
		$('.remove-me-syarat').click(function(e){
			e.preventDefault();
			var fieldNum = 'field'+this.id.toString().replace('remove','');
			console.log(fieldNum)
			$('#'+fieldNum).remove();
			$(this).prev().remove();
			$(this).remove();
		});

		$('select[name="majorVacancy"]').select2()
	});

}

if ($("#formEditVacancy").length) {
	// var minSalary = document.getElementById('minSalaryVacancy');
	// minSalary.addEventListener("keyup", function (e) {
	// 	minSalary.value = formatRupiah(this.value);
	// });

	// var maxSalary = document.getElementById('maxSalaryVacancy');
	// maxSalary.addEventListener("keyup", function (e) {
	// 	maxSalary.value = formatRupiah(this.value);
	// });

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

	$(".add-more-syarat").click(function(e){
		e.preventDefault();
		this.remove();
		var btnAdd = this;
		var jml = $('#fieldMajorDiv1 select').length
		var next = jml+1

		//change btn to minus
		var removeBtn = '<button type="button" id="remove-syarat' + jml + '" class="btn remove-me-syarat btn-min">-</button>';
		var after = $('#field-syarat'+jml).next()
		after.after(removeBtn)
		
		var newIn = '<select class="select2 min-width" id="field-syarat' + next + '" name="majorVacancy">'+
						'<option value="">-- Pilih Major --</option>'+
						'<option value="Sistem Informasi">Sistem Informasi</option>'+
						'<option value="Akuntansi">Akuntansi</option>'+
					'</select>';
		$('#fieldMajorDiv1').append(newIn)
		$('#fieldMajorDiv1').append(btnAdd)

		$('select[name="majorVacancy"]').select2()
	});

	$('.remove-me-syarat').click(function(e){
		e.preventDefault();
		var fieldNum = 'field'+this.id.toString().replace('remove','');
		console.log(fieldNum)
		$('#'+fieldNum).remove();
		$(this).prev().remove();
		$(this).remove();
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
	function readFile(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('.photoProfileLabel').empty();
				$('.photoProfileImage').attr('src', e.target.result);
				$('.photoProfileLabel').html(input.files[0].name);
			};
			
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$("#photoProfile").change(function(){
		readFile(this);
	});

	function readFileInput(input) {
		console.log(input)
		console.log(input.files)
		console.log(input.files[0])
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				var inputLabel = $(input).parent().parent().find('.file-input-label');
				inputLabel.val();
				inputLabel.val(input.files[0].name);
			};
			
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$('.uploadCertificate').change(function(e){
		e.preventDefault();
		readFileInput(this);
	});

	$('input[name="birthDate"]').datetimepicker({
		format: 'DD-MM-YYYY',
	});

	$('#startDateEducation').datetimepicker({
		format: 'YYYY',
	});

	$('#endDateEducation').datetimepicker({
		format: 'YYYY',
	});

	$('.btnAddListEducation').click(function(e){
		e.preventDefault()
		$('.btnAddListEducation.large').hide()
		$('.firstBtnListEducation').removeClass('margin-right-2rem')
	
		var option = '<div class="listStudy">'+
						'<hr>'+
						'<div class="row">'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">School/University<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" name="university" id="university" class="form-control" placeholder="School/University">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Degree<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<select name="degree" id="degree" class="select2 form-control">'+
												'<option value="">Choose your degree</option>'+
												'<option value="1">Diploma Degree</option>'+
												'<option value="2">Bachelor Degree</option>'+
												'<option value="3">Master Degree</option>'+
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
											'<input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Major<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<select name="major" id="major" class="select2 form-control">'+
												'<option value="">Choose your major</option>'+
												'<option value="Sistem Informasi">Sistem Informasi</option>'+
												'<option value="Akuntansi">Akuntansi</option>'+
											'</select>'+
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
											'<input type="text" class="form-control" placeholder="Choose date" id="startDateEducation" name="startDateEducation">'+
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
											'<input type="text" class="form-control" placeholder="Choose date" id="endDateEducation" name="endDateEducation">'+
											'<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">GPA<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" class="form-control" placeholder="0 - 100" id="gpa" name="gpa">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Certificate of Study<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" class="form-control file-input-label" placeholder="Format jpg/png maximum 2MB file" disabled>'+
											'<span class="btn btn-file pl-1 mb-2">'+
												'Upload File <input type="file" name="certificate[]" id="certificate" class="uploadCertificate" accept=".jpg, .png, .jpeg">'+
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
											'<button type="button" class="btn btn-white btn-block btnAddListEducation">'+
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
											'<button type="button" class="btn btn-white btn-block btnAddListEducation">'+
												'<i class="fas fa-plus mr-2" style="font-size:18px"></i> Add Another Education'+
											'</button>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
	
		$('#listEducationCandidate').append(option)
	
		$('input[name="startDateEducation"]').datetimepicker({
			format: 'YYYY',
		});
	
		$('input[name="endDateEducation"]').datetimepicker({
			format: 'YYYY',
		});
	
		if ($('.select2').length) {
			$('.select2').select2();
		}
		if ($('.removeThisEducation').length) {
			$('.removeThisEducation').click(function(){
				console.log('click')
				$(this).parent().parent().remove()

				if ($('.listStudy').length < 2) {
					$('.btnAddListEducation.large').show()
				}
			})
		}
		if ($('.secondBtnEducation').length) {
			$('.secondBtnEducation').click(function(){
				$(this).remove()
				$('.btnAddListEducation.large').click();
			})
		}

		function readFileInput(input) {
			console.log(input)
			console.log(input.files)
			console.log(input.files[0])
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					var inputLabel = $(input).parent().parent().find('.file-input-label');
					inputLabel.val();
					inputLabel.val(input.files[0].name);
				};
				
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$('.uploadCertificate').change(function(e){
			e.preventDefault();
			readFileInput(this);
		});
	})
}

if ($('#formEditPersonalInformation').length) {
	function readFile(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('.photoProfileLabel').empty();
				$('.photoProfileImage').attr('src', e.target.result);
				$('.photoProfileLabel').html(input.files[0].name);
			};
			
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$("#photoProfile").change(function(){
		readFile(this);
	});

	$('input[name="birthDate"]').datetimepicker({
		format: 'DD-MM-YYYY',
	});
}

if ($("#formEditEducationInformation").length) {
	function readFileInput(input) {
		console.log(input)
		console.log(input.files)
		console.log(input.files[0])
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				var inputLabel = $(input).parent().parent().find('.file-input-label');
				inputLabel.val();
				inputLabel.val(input.files[0].name);
			};
			
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$('.uploadCertificate').change(function(e){
		e.preventDefault();
		readFileInput(this);
	});

	$('#startDateEducation').datetimepicker({
		format: 'YYYY',
	});

	$('#endDateEducation').datetimepicker({
		format: 'YYYY',
	});

	$('.btnAddListEducation').click(function(e){
		e.preventDefault()
		$('.btnAddListEducation.large').hide()
		$('.firstBtnListEducation').removeClass('margin-right-2rem')
	
		var option = '<div class="listStudy">'+
						'<hr>'+
						'<div class="row">'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">School/University<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" name="university" id="university" class="form-control" placeholder="School/University">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Degree<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<select name="degree" id="degree" class="select2 form-control">'+
												'<option value="">Choose your degree</option>'+
												'<option value="1">Diploma Degree</option>'+
												'<option value="2">Bachelor Degree</option>'+
												'<option value="3">Master Degree</option>'+
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
											'<input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Major<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<select name="major" id="major" class="select2 form-control">'+
												'<option value="">Choose your major</option>'+
												'<option value="Sistem Informasi">Sistem Informasi</option>'+
												'<option value="Akuntansi">Akuntansi</option>'+
											'</select>'+
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
											'<input type="text" class="form-control" placeholder="Choose date" id="startDateEducation" name="startDateEducation">'+
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
											'<input type="text" class="form-control" placeholder="Choose date" id="endDateEducation" name="endDateEducation">'+
											'<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row">'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">GPA<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" class="form-control" placeholder="0 - 100" id="gpa" name="gpa">'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
							'<div class="col-lg-6 col-md-12">'+
								'<div class="form-group">'+
									'<label for="">Certificate of Study<span class="required-sign">*</span></label>'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<input type="text" class="form-control file-input-label" placeholder="Format jpg/png maximum 2MB file" disabled>'+
											'<span class="btn btn-file pl-1 mb-2">'+
												'Upload File <input type="file" name="certificate[]" id="certificate" class="uploadCertificate" accept=".jpg, .png, .jpeg">'+
											'</span>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="row startSecondButtonAddListEducation">'+
							'<div class="col-lg-6 col-md-12 removeThisEducation">'+
								'<div class="form-group">'+
									'<div class="row">'+
										'<div class="col-lg-11 col-md-12">'+
											'<button type="button" class="btn btn-white btn-block btnAddListEducation">'+
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
											'<button type="button" class="btn btn-white btn-block btnAddListEducation">'+
												'<i class="fas fa-plus mr-2" style="font-size:18px"></i> Add Another Education'+
											'</button>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>';
	
		$('#listEducationCandidate').append(option)
	
		$('input[name="startDateEducation"]').datetimepicker({
			format: 'YYYY',
		});
	
		$('input[name="endDateEducation"]').datetimepicker({
			format: 'YYYY',
		});
	
		if ($('.select2').length) {
			$('.select2').select2();
		}
		if ($('.removeThisEducation').length) {
			$('.removeThisEducation').click(function(){
				console.log('click')
				$(this).parent().parent().remove()

				if ($('.listStudy').length < 2) {
					$('.btnAddListEducation.large').show()
				} else {
					var newBtn = '<div class="col-lg-6 col-md-12 secondBtnEducation">'+
									'<div class="form-group">'+
										'<div class="row">'+
											'<div class="col-lg-11 col-md-12">'+
												'<button type="button" class="btn btn-white btn-block btnAddListEducation">'+
													'<i class="fas fa-plus mr-2" style="font-size:18px"></i> Add Another Education'+
												'</button>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';

					$('.startSecondButtonAddListEducation').last().append(newBtn)
				}
			})
		}
		if ($('.secondBtnEducation').length) {
			$('.secondBtnEducation').click(function(){
				$(this).remove()
				$('.btnAddListEducation.large').click();
			})
		}

		function readFileInput(input) {
			console.log(input)
			console.log(input.files)
			console.log(input.files[0])
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					var inputLabel = $(input).parent().parent().find('.file-input-label');
					inputLabel.val();
					inputLabel.val(input.files[0].name);
				};
				
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$('.uploadCertificate').change(function(e){
			e.preventDefault();
			readFileInput(this);
		});
	})
}

$("#loadNews").click(function(e){
	e.preventDefault();
	var value = this.value;
	ajax.getData('/news-get-more', 'post', {value:value}, function(data){
		var count = parseInt(value)+5;
		$("#loadNews").val(count);
		if (data.length) {
			for (let i = 0; i < data.length; i++) {
				var id = encodeURIComponent(window.btoa(data[i]['id']));
				$("#divNews").append(
					'<a href="/news-event/detail/'+id+'" class="news-ahref">'+
						'<div class="card-list-news">'+
							'<div class="card-body-news">'+
								'<div class="row">'+
									'<div class="col-lg-4 col-md-12">'+
										'<img src="'+baseImage+'/'+data[i]['image']+'" class="img-news">'+
									'</div>'+
									'<div class="col-lg-8 col-md-12 mt-5">'+
										'<div class="div-right-news">'+
											'<div class="d-flex">'+
												'<div class="badge-news mb-3">News</div>'+
												'<p class="align-items-center p-title-news">'+data[i]["tanggal"]+'</p>'+
											'</div>'+
											'<h4 class="news-page-title">'+data[i]["title"]+'</h4>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</a>'
				)
				
			}
		}else{
			$("#loadNews").addClass('hidden');
		}
	})
	
})

$("#loadEvent").click(function(e){
	e.preventDefault();
	var value = this.value;
	ajax.getData('/event-get-more', 'post', {value:value}, function(data){
		var count = parseInt(value)+5;
		$("#loadEvent").val(count);
		if (data.length) {
			for (let i = 0; i < data.length; i++) {
				var id = encodeURIComponent(window.btoa(data[i]['id']));
				$("#divNews").append(
					'<a href="/news-event/detail/'+id+'" class="news-ahref">'+
						'<div class="card-list-news">'+
							'<div class="card-body-news">'+
								'<div class="row">'+
									'<div class="col-lg-4 col-md-12">'+
										'<img src="'+baseImage+'/'+data[i]['image']+'" class="img-news">'+
									'</div>'+
									'<div class="col-lg-8 col-md-12 mt-5">'+
										'<div class="div-right-news">'+
											'<div class="d-flex">'+
												'<div class="badge-news mb-3">Event</div>'+
												'<p class="align-items-center p-title-news">'+data[i]["tanggal"]+'</p>'+
											'</div>'+
											'<h4 class="news-page-title">'+data[i]["title"]+'</h4>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</a>'
				)
				
			}
		}else{
			$("#loadEvent").addClass('hidden');
		}
	})
	
})


if ($('#filterJobList').length) {
	$('.job-type-select').click(function(){
		if ($(this).hasClass('not-active')) {
			if ($(this).hasClass('fulltime-badge')) {
				$('#checkFilterFulltime').prop('checked', true);
			} else if ($(this).hasClass('internship-badge')) {
				$('#checkFilterInternship').prop('checked', true);
			}
			$(this).removeClass('not-active')
		} else {
			if ($(this).hasClass('fulltime-badge')) {
				$('#checkFilterFulltime').prop('checked', false);
			} else if ($(this).hasClass('internship-badge')) {
				$('#checkFilterInternship').prop('checked', false);
			}
			$(this).addClass('not-active')
		}
	})
}

var lastArray =  function(array, n) {
	if (array == null) 
	  return void 0;
	if (n == null) 
	   return array[array.length - 1];
	return array.slice(Math.max(array.length - n, 0));  
};

$('.loadMoreJob').click(function(){
	var list = $('.card-job-list').length;
	var value = list + 3;

	ajax.getData('/job-more', 'post', {value:value}, function(data){
		if (data.length >= value) {
			$('.loadMoreJob').hide();
		}

		var newData = lastArray(data, 3)
		
		for (let i = 0; i < newData.length; i++) {
			var id = encodeURIComponent(window.btoa(newData[i]['job_id']));

			if (newData[i]['type'] == 1) {
				var type = '<div class="fulltime-badge mb-3">Full-time</div>';
			} else if (newData[i]['type'] == 2) {
				var type = '<div class="internship-badge mb-3">Internship</div>'
			}

			var option = '<div class="col-lg-4 col-md-6 col-sm-12 my-3">'+
							'<div class="card card-job-list">'+
								'<a href="/job/detail/'+id+'" class="text-decoration-none">'+
									'<div class="card-body">'+
										type+
										'<label class="label-no-margin mb-1">'+newData[i]['lokasi']+', Indonesia</label>'+
										'<h4 class="candidate-page-subtitle mb-3">'+newData[i]['job_title']+'</h4>'+
										
										'<div class="d-flex align-items-center job-list-detail mb-1">'+
											'<div class="icon-wrapper">'+
												'<img src="/image/icon/homepage/icon-graduate.svg" alt="icon">'+
											'</div>'+
											'<p class="text">'+newData[i]['education_req']+'</p>'+
										'</div>'+
										'<div class="d-flex align-items-center job-list-detail">'+
											'<div class="icon-wrapper">'+
												'<img src="/image/icon/homepage/icon-book.svg" alt="icon">'+
											'</div>'+
											'<p class="text">'+newData[i]['major']+'</p>'+
										'</div>'+
									'</div>'+
								'</a>'+
							'</div>'+
						'</div>';

			$('#loadJobs').append(option)
		}
	})
})
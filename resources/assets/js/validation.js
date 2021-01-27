const formrules = {
	// contoh validasi id form
	'formRegister':{
		ignore: null,
		rules:{
			'firstNameReg': {
				required:true,
				nameCheck:true,
				maxlength:64,
			},
			'lastNameReg': {
				required:true,
				nameCheck:true,
				maxlength:64,
			},
			'emailReg': {
				required:true,
				emailType:true
			},
			'noHPReg': {
				required:true,
				digits:true,
				maxlength:13,
				minlength:11
			},
			'namaPerusahaanReg': {
				required:true,
				alphaNumeric:true,
			},
			'jenisPerusahaanReg': {
				required:true,
			},
			'alamatReg': {
				required:true,
				maxlength:255,
				addresscheck:true,
			},
			'kotaReg': {
				required:true,
				maxlength:64,
				alpha:true
			},
			'passwordReg': {
				required:true,
				maxlength:12,
				minlength:8,
				pwcheck3:true

			},
			'confPasswordReg': {
				required:true,
				maxlength:12,
				minlength:8,
				pwcheck3:true
			},
			'aggreeTerms':{
				required:true,
			}
		},
		submitHandler:false,
		messages: {
			firstNameReg: {
				required: 'Mohon isi nama depan',
			},
			lastNameReg: {
				required:'Mohon isi nama belakang'
			},
			emailReg: {
				required:'Mohon isi email',
			},
			noHPReg: {
				required:'Mohon isi nomor handphone',
				digits:'Nomor HP yang Anda masukkan salah',
				maxlength:'Nomor HP yang Anda masukkan salah',
				minlength:'Nomor HP yang Anda masukkan salah'
			},
			namaPerusahaanReg: {
				required:'Mohon isi nama perusahaan'
			},
			jenisPerusahaanReg: {
				required:'Mohon isi kolom ini'
			},
			alamatReg: {
				required:'Mohon isi alamat'
			},
			kotaReg: {
				required:'Mohon isi kota'
			},
			passwordReg: {
				required:'Mohon isi password'
			},
			confPasswordReg: {
				required:'Mohon isi sesuai password diatas'
			},
			aggreeTerms: {
				required:'Mohon centang kolom ini'
			}
		},
	},

}

var validation = {
	messages: {
		required:function() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon isi kolom ini';
		},
		minlength:function(length) {
			return '<i class="fa fa-exclamation-circle"></i> Isi dengan minimum ' + length;
		},
		maxlength:function(length) {
			return '<i class="fa fa-exclamation-circle"></i> Isi dengan maximum ' + length;
		},
		max:function(message, length) {
			return '<i class="fa fa-exclamation-circle"></i> ' + message  + length;
		},
		email:function() {
			return '<i class="fa fa-exclamation-circle"></i> Email Anda salah. Email harus terdiri dari @ dan domain';
		},
		digits:function() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon isi hanya dengan nomor';
		},
		numbers2:function() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon isi hanya dengan nomor';
		},
		nameCheck:function() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung A-Z dan \'';
		},
		numericsSlash:function() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung 0-9 dan /';
		},
		alphaNumeric:function() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung 0-9, A-Z dan spasi';
		},
		alphaNumericNS:function() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung 0-9 dan A-Z';
		},
		alpha:function() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung A-Z dan spasi';
		},
		alphaNS:function() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung A-Z';
		},
		equalTo:function() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon mengisi dengan isian yang sama';
		},
		addresscheck:function() {
			return '<i class="fa fa-exclamation-circle"></i> Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar';
		},
		pwcheck:function() {
			return '<i class="fa fa-exclamation-circle"></i> Input minimum 8 dan mengandung satu nomor, satu huruf kecil dan satu huruf besar';
		},
		pwcheck_alfanum:function() {
			return '<i class="fa fa-exclamation-circle"></i> Input antara 8-14 karakter dan harus merupakan kombinasi antara angka dan huruf';
		},
		pwcheck2:function() {
			return '<i class="fa fa-exclamation-circle"></i> Input antara 8-14 karakter dan harus mengandung nomor, huruf kecil, huruf besar dan simbol kecuali ("#<>\/\\=\')';
		},
		notEqual:function(message) {
			return '<i class="fa fa-exclamation-circle"></i> ' + message;
		},
		checkDate:function() {
			return '<i class="fa fa-exclamation-circle"></i> Format tanggal salah';
		},
		checkTime:function() {
			return '<i class="fa fa-exclamation-circle"></i> Format time (HH:mm) salah';
		},
		formatSeparator:function() {
			return '<i class="fa fa-exclamation-circle"></i> Contoh format: Ibu rumah tangga, pedagang, tukang jahit';
		},
		acceptImage:function() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon upload hanya gambar';
		},
		filesize:function(size) {
			return '<i class="fa fa-exclamation-circle"></i> Max file size: ' + size;
		},
		extension:function(format) {
			return '<i class="fa fa-exclamation-circle"></i> Format yang Anda pilih tidak sesuai';
		},
		minValue:function(minValue) {
			return '<i class="fa fa-exclamation-circle"></i> Minimal Amount: ' + minValue;
		},
		ageCheck:function(age) {
			return '<i class="fa fa-exclamation-circle"></i> Minimal Age ' + age;
		},
		checkDateyyyymmdd:function(){
			return '<i class="fa fa-exclamation-circle></i> Format tanggal YYYY-MM-DD, contoh: 2016-01-30';
		},
		checkDateddmmyyyy:function(){
			return '<i class="fa fa-exclamation-circle></i> Format tanggal DD/MM/YYYY, contoh: 17/08/1945';
		},
	},
	addMethods:function() {
		// alert('method')
		// jQuery.validator.addMethod("maxDateRange",
		jQuery.extend(jQuery.validator.messages, {
		    required: "Mohon isi kolom ini.",
		    remote: "Please fix this field.",
		    email: "Email Anda salah. Email harus terdiri dari @ dan domain.",
		    url: "Please enter a valid URL.",
		    date: "Please enter a valid date.",
		    dateISO: "Please enter a valid date (ISO).",
		    number: "Please enter a valid number.",
		    digits: "Mohon isi hanya dengan angka.",
		    creditcard: "Please enter a valid credit card number.",
		    equalTo: "Mohon isi dengan value yang sama.",
		    accept: "Format yang Anda pilih tidak sesuai.",
		    maxlength: jQuery.validator.format("Mohon isi dengan tidak melebihi {0} karakter."),
		    minlength: jQuery.validator.format("Mohon isi dengan minimal {0} karakter."),
		    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
		    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
		    max: jQuery.validator.format("Mohon isi tidak melebihi {0}."),
		    min: jQuery.validator.format("Mohon isi minimal {0}."),
		    extension: "Format yang Anda pilih tidak sesuai.",
			alphaNumeric:"Hanya boleh mengandung 0-9, A-Z dan spasi",
			// addresscheck:"Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar"
		});

		$.validator.addMethod("maxDateRange",
			function(value, element, params) {
		    	var end = new Date(value);
		    	var start = new Date($(params[0]).val());
		    	var range = (end-start)/86400000;
			    if (!/Invalid|NaN/.test(new Date(value))) {

			        return range <= params[1];
			    }

			    return isNaN(value) && isNaN($(params[0]).val())
			        || range<=params[1];
			},'Melebihi maksimal range {1} hari.');
		jQuery.validator.addMethod("greaterThan",
			function(value, element, params) {
				console.log(value, element, params)
			    if (!/Invalid|NaN/.test(new Date(value))) {
			        return new Date(value) > new Date($(params).val());
			    }

			    return isNaN(value) && isNaN($(params).val())
			        || (Number(value) > Number($(params).val()));
			},'Must be greater than {0}.');
		$.validator.addMethod("ageCheck", function(value, element, param) {
			var now = moment();
			//return now;
			function parseNewDate(date) {
				var split = date.split('-');
				var b = moment([split[2], split[1]-1, split[0]]);
				return b;
			}
			var difference = now.diff(parseNewDate(value), 'years');
			return difference >= param;
		}, "Check Umur");
		jQuery.validator.addMethod("numbers2", function(value, element) {
			return this.optional(element) || /^-?(?!0)(?:\d+|\d{1,3}(?:\.\d{3})+)$/.test(value);
		}, "Mohon isi hanya dengan nomor");

		jQuery.validator.addMethod("nameCheck", function(value, element) {
			return this.optional(element) || /^([a-zA-Z' ]+)$/.test(value);
		}, "Nama hanya boleh mengandung A-Z dan '");

		jQuery.validator.addMethod("numericsSlash", function(value, element) {
			return this.optional(element) || /^([0-9/]+)$/.test(value);
		}, "Nama hanya boleh mengandung 0-9 dan /");

		jQuery.validator.addMethod("numericDot", function(value, element) {
			return this.optional(element) || /^([0-9.]+)$/.test(value);
		}, "Nama hanya boleh mengandung 0-9 dan .");

		jQuery.validator.addMethod("numericKoma", function(value, element) {
			return this.optional(element) || /^([0-9,]+)$/.test(value);
		}, "Nama hanya boleh mengandung 0-9 dan ,");

		jQuery.validator.addMethod("alphaNumeric", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9. ]*$/.test(value);
		}, "Hanya boleh mengandung 0-9, A-Z, Titik dan spasi");

		jQuery.validator.addMethod("alphaNumericNS", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9]*$/.test(value);
		}, "Nama hanya boleh mengandung 0-9 dan A-Z");

		jQuery.validator.addMethod("alamatFormat", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9 .,-/]*$/.test(value);
		}, "Nama hanya boleh mengandung A-Z, 0-9, titik, koma, dan strip");

		jQuery.validator.addMethod("defaultText", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9 ',-.:/?!&%()+=_\n]*$/.test(value);
		}, "Inputan hanya boleh mengandung A-Z, 0-9, spasi dan simbol .,:'/?!&%()-+=_");

		jQuery.validator.addMethod("defaultName", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9 .']*$/.test(value);
		}, "Inputan hanya boleh mengandung A-Z, 0-9, spasi dan simbol .'");

		jQuery.validator.addMethod("arabic", function(value, element) {
			return this.optional(element) || /^[\u0600-\u06FF\u0750-\u077F ]*$/.test(value);
		}, "Inputan hanya boleh bahasa Arab.");

		jQuery.validator.addMethod("defaultPhone", function(value, element) {
			return this.optional(element) || /^[0-9-/']*$/.test(value);
		}, "Inputan hanya boleh mengandung 0-9, spasi, dan simbol-/'");

		jQuery.validator.addMethod("alpha", function(value, element) {
			return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
		}, "Nama hanya boleh mengandung A-Z dan spasi");

		jQuery.validator.addMethod("alphaNS", function(value, element) {
			return this.optional(element) || /^[a-zA-Z]*$/.test(value);
		}, "Nama hanya boleh mengandung A-Z");

		jQuery.validator.addMethod("addresscheck", function(value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\s).{8,}$/.test(value);
		}, "Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar");

		jQuery.validator.addMethod("pwcheck", function(value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$/.test(value);
		}, "Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar");

		jQuery.validator.addMethod("pwcheck_alfanum", function(value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*\D)(?!.*\s).{8,14}$/.test(value);
		}, "Input harus merupakan kombinasi antara angka dan huruf");

		jQuery.validator.addMethod("pwcheck2", function(value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w])(?!.*[#<>\/\\=”’"'])(?!.*\s).{8,14}$/.test(value);
		}, "Input harus mengandung satu nomor, satu huruf kecil, satu huruf besar, simbol kecuali \"#<>\/\\=\"'");

		jQuery.validator.addMethod("pwcheck3", function(value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w])(?!.*\s).{8,12}$/.test(value);
		}, "Input harus mengandung satu nomor, satu huruf kecil, satu huruf besar, simbol");

		jQuery.validator.addMethod("max", function(value, element, param) {
			var val = parseFloat(value.replace(/\./g, ""));
			return this.optional(element) || (val <= param);
		}, jQuery.validator.format("Maksimal {0}"));

		jQuery.validator.addMethod("maxDec", function(value, element, param) {
			var data = value.replace(',', '.');
			return this.optional(element) || (data <= param);
		}, jQuery.validator.format("Maksimal {0}"));

		jQuery.validator.addMethod("maxDecMargin", function(value, element, param) {
			var data = value.replace(',', '.');
			return this.optional(element) || (data <= param);
		}, jQuery.validator.format("Margin tidak valid"));

		jQuery.validator.addMethod("notEqual", function(value, element, param) {
			return this.optional(element) || value != $(param).val();
		}, "This has to be different...");

		jQuery.validator.addMethod("notZero", function(value, element, param) {
			var val = parseFloat(value.replace(/\./g, ""));
			var nol = value.substr(0,1);
			return this.optional(element) || (val != param);
		}, jQuery.validator.format("Value Tidak Boleh 0"));

		jQuery.validator.addMethod("zeroValid", function(value, element, param) {
			var nol = value.substr(0,1);
			var val = parseFloat(value.replace(/\./g, ""));
			if (value.length ==	 1) {
				return this.optional(element) || (val == nol);
			}else{
				return this.optional(element) || (nol != param);
			}
		}, jQuery.validator.format("Angka pertama tidak boleh 0"));

		jQuery.validator.addMethod("minValue", function(value, element, param) {
			return value >= param;
		}, "Min Value needed");

		jQuery.validator.addMethod("checkDate", function(value, element) {
			return this.optional(element) || /^(((0[1-9]|[12]\d|3[01])\-(0[13578]|1[02])\-((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\-(0[13456789]|1[012])\-((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\-02\-((19|[2-9]\d)\d{2}))|(29\-02\-((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/.test(value);
		}, "Format tanggal salah");

		jQuery.validator.addMethod("checkTime", function(value, element) {
			return this.optional(element) || /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/.test(value);
		}, "Format time (HH:mm) salah");

		jQuery.validator.addMethod("formatSeparator", function(value, element) {
			return this.optional(element) || /^[A-Za-z ]+(,[A-Za-z ]+){0,2}$/.test(value);
		}, "Contoh format: Ibu rumah tangga,pedagang,tukang jahit");

		jQuery.validator.addMethod("checkDateyyyymmdd",function(value,element){
			return this.optional(element) || /^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/.test(value);
		},"Format tanggal YYYY-MM-DD, contoh: 2016-01-30");

		jQuery.validator.addMethod("checkDateddmmyyyy",function(value,element){
			return this.optional(element) || /^\d{2}\/\d{2}\/\d{4}$/.test(value);
		},"Format tanggal Bulan/Tanggal/Tahun, contoh: 06/08/1945");

		jQuery.validator.addMethod("emailType",function(value,element){
			value = value.toLowerCase();
			return this.optional(element) || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value);
		},"Email Anda salah. Email harus terdiri dari @ dan domain");

		jQuery.validator.addMethod("symbol", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9!@#$%^&()]*$/.test(value);
		}, "Password hanya boleh mengandung A-Z, a-z, 0-9 dan simbol dari 0-9");
		jQuery.validator.addMethod('filesize', function(value, element, param) {
				return this.optional(element) || (element.files[0].size <= param)
			}, "Ukuran Maksimal Gambar 1 MB");


	},
	validateMe:function(id, valRules, valMessages) {

		validation.addMethods();

		$("#" + id).validate({
			rules: valRules,
			messages: valMessages,
			errorPlacement: function(error, element) {
				var ele = element.parents('.input');
				element.parents('.inputGroup').children('.alert.error').remove();
				error.insertAfter(ele);
				error.addClass('alert error');
			},
			success: function (error) {
				error.parents('span.alert.error').remove();
			},
			wrapper: 'span'
		});
	},
	/* CR17682 OTP START */
	validateMultiple:function(id, valRules, valMessages) {
		validation.addMethods();

        $("#" + id).removeData("validator");
        $("#" + id).removeData("check");
        $("#" + id).removeData("confirm");
        $("#" + id).find('input').removeClass('error');

		var validator = $("#" + id).validate({
			rules: valRules,
			messages: valMessages,
			errorPlacement: function(error, element) {
				var ele = element.parents('.input');
				element.parents('.inputGroup').children('.alert.error').remove();
				error.insertAfter(ele);
				error.addClass('alert error');
			},
			success: function (error) {
				error.parents('span.alert.error').remove();
			},
			wrapper: 'span'
		});

        validator.resetForm();
	},
	/* CR17682 OTP END*/
	submitTry:function(id) {
		if ($('.nio_select').length) {
			$('.nio_select').show();
		}
		if ($('.added_photo').length && !$('.imageAttachmentWrap.noApi').length) {
			$('.added_photo').show();
		}
		if ($('.tinymce').length) {
			$('.tinymce').show();
		}
		if ($('.stepForm').length) {
			var curr = $('.stepForm.active').index() + 1;
			$('.stepForm').addClass('active');
		}

		//after valid (have to make fn if not working)

		if ($('#' + id).valid()) {
			$('.nio_select').hide();
			$('.tinymce').hide();
			if (validation.FileApiSupported()) {
				$('.added_photo').hide();
			}
			return 'vPassed';
		}
		else {
			$('.nio_select').hide();
			$('.tinymce').hide();
			if (validation.FileApiSupported()) {
				$('.added_photo').hide();
			}
			return 'vError';
		}
	},
	FileApiSupported: function() {
		return !!(window.File && window.FileReader && window.FileList && window.Blob);
	}
}

const formrules = {
	// contoh validasi id form
	'formLoginAdmin':{
		ignore: null,
		rules:{
			'email':'required',
			'password':'required',
		},
		submitHandler:false,
		messages: {
			email: {
				required: 'Mohon isi email',
			},
			password: {
				required:'Mohon isi password'
			}
		},
    },
	
	'formAddEventNews':{
        ignore: null,
		rules:{
			'imageNewsEvent':{
                required:true
            },
			'titleNewsEvent':{
                required:true
            },
            'tipeNewsEvent':{
                required:true
            },
            'tglMulaiNewsEvent':{
                required:true
            },
			'tglSelesaiNewsEvent':{
                required:true
            },
			'descriptionNewsEvent':{
				required:true
			}
		},
		submitHandler:false,
		messages: {
			imageNewsEvent: {
				required: 'Mohon isi Image',
			},
			titleNewsEvent: {
				required:'Mohon isi Title'
            },
            tipeNewsEvent: {
				required:'Mohon pilih Tipe'
            },
            tglMulaiNewsEvent: {
				required:'Mohon isi Start Date'
            },
			tglSelesaiNewsEvent: {
				required:'Mohon isi Start Date'
            },
			descriptionNewsEvent: {
				required:'Mohon isi Description'
            }
        },
        errorPlacement: function (error, element) {
			if (element.is("#tipeNewsEvent")) {
				error.appendTo(element.parents('#tipeNewsEventDiv'));
			}
			else { // This is the default behavior
				error.insertAfter(element);
			}
		}
    },

	'formEditEventNews':{
        ignore: null,
		rules:{
			'titleNewsEvent':{
                required:true
            },
            'tipeNewsEvent':{
                required:true
            },
            'tglMulaiNewsEvent':{
                required:true
            },
			'tglSelesaiNewsEvent':{
                required:true
            },
			'descriptionNewsEvent':{
				required:true
			}
		},
		submitHandler:false,
		messages: {
			titleNewsEvent: {
				required:'Mohon isi Title'
            },
            tipeNewsEvent: {
				required:'Mohon pilih Tipe'
            },
            tglMulaiNewsEvent: {
				required:'Mohon isi Start Date'
            },
			tglSelesaiNewsEvent: {
				required:'Mohon isi Start Date'
            },
			descriptionNewsEvent: {
				required:'Mohon isi Description'
            }
        },
        errorPlacement: function (error, element) {
			if (element.is("#tipeNewsEvent")) {
				error.appendTo(element.parents('#tipeNewsEventDiv'));
			}
			else { // This is the default behavior
				error.insertAfter(element);
			}
		}
    },

	'formAddVacancy':{
        ignore: null,
		rules:{
			'titleVacancy':{
                required:true
            },
			'locationVacancy':{
                required:true
            },
            'degreeVacancy':{
                required:true
            },
            'typeVacancy':{
                required:true
            },
			'workingTimeVacancy':{
                required:true
            },
			'activatedDate':{
				required:true
			},
			'majorVacancy':{
				required:true
			},
			'descriptionVacancy':{
				required:true
			},
		},
		submitHandler:false,
		messages: {
			titleVacancy: {
				required: 'Mohon isi Title',
			},
			locationVacancy: {
				required:'Mohon Pilih Lokasi'
            },
            degreeVacancy: {
				required:'Mohon pilih Degree'
            },
            typeVacancy: {
				required:'Mohon pilih Tipe'
            },
			workingTimeVacancy: {
				required:'Mohon isi Working Time'
            },
			activatedDate: {
				required:'Mohon isi Active Date'
            },
			majorVacancy: {
				required:'Mohon pilih Major'
            },
			descriptionVacancy: {
				required:'Mohon isi Description'
            },
        },
        errorPlacement: function (error, element) {
			if (element.is("#locationVacancy")) {
				error.appendTo(element.parents('#locationVacancyDiv'));
			}else if(element.is("#degreeVacancy")) {
				error.appendTo(element.parents('#degreeVacancyDiv'));
			}else if(element.is("#typeVacancy")) {
				error.appendTo(element.parents('#typeVacancyDiv'));
			}else if(element.is("#majorVacancy")) {
				error.appendTo(element.parents('#majorVacancyDiv'));
			}else { // This is the default behavior
				error.insertAfter(element);
			}
		}
    },

	'formFirstLogin':{
        ignore: null,
		rules:{
			'photoProfile':{
                required:true
            },
            'firstName':{
                required:true,
				STD_VAL_WEB_3: true,
            },
            'lastName':{
                STD_VAL_WEB_3: true,
            },
			'birthDate':{
				required:true,
                STD_VAL_WEB_11: true,
            },
			'gender':{
				required:true
			},
			'phoneNumber':{
				required:true,
				STD_VAL_WEB_8: true,
			},
			'myLocation':{
				required:true,
			},
			'lingkedInLink':{
				STD_VAL_WEB_20: true,
			},
			'university':{
				required:true,
				STD_VAL_WEB_25: true,
			},
			'degree':{
				required:true,
			},
			'faculty':{
				required:true,
				STD_VAL_WEB_25: true,
			},
			'major':{
				required:true,
			},
			'startDateEducation':{
				required:true,
			},
			'endDateEducation':{
				required:true,
			},
			'gpa':{
				required:true,
			},
			'certificate[]':{
				required:true,
			},
			// 'coverLetter':{
			// 	STD_VAL_WEB_20:true,
			// },
			// 'resume':{
			// 	STD_VAL_WEB_20:true,
			// },
			// 'portofolio':{
			// 	STD_VAL_WEB_20:true,
			// },
			// 'skill':{
			// 	STD_VAL_WEB_20:true,
			// },
		},
		submitHandler:false,
		messages: {
			titleNewsEvent: {
				required:'Mohon isi Title'
            },
            tipeNewsEvent: {
				required:'Mohon pilih Tipe'
            },
            tglMulaiNewsEvent: {
				required:'Mohon isi Start Date'
            },
			tglSelesaiNewsEvent: {
				required:'Mohon isi Start Date'
            },
			descriptionNewsEvent: {
				required:'Mohon isi Description'
            }
        },
        errorPlacement: function (error, element) {
			if (element.is("#photoProfile")) {
				error.appendTo(element.parent().parent().parent());
			} else if (element.is("input[type=radio]") || element.is("input[type=checkbox]")) {
				error.appendTo(element.parents('.form-group'));
			} else if (element.hasClass("select2")) {
				error.appendTo(element.parents('.form-group'));
			} else if (element.is("#certificate")) {
				error.appendTo(element.parents('.form-group'));
			} else { // This is the default behavior
				error.insertAfter(element);
			}
		}
    },

	'formEditPassword':{
        ignore: null,
		rules:{
			'oldPassword':{
                required:true
            },
            'newPassword':{
                required:true
            },
            'newPasswordConfirm':{
                required:true,
				equalTo: '#newPassword'
            },
		},
		submitHandler:false,
		messages: {
			oldPassword: {
				required: 'Mohon isi password lama',
			},
			newPassword: {
				required: 'Mohon isi password baru',
			},
			newPasswordConfirm: {
				required: 'Mohon isi konfirmasi password baru',
			}
        },
        errorPlacement: function (error, element) {
			if (element.is("#tipeNewsEvent")) {
				error.appendTo(element.parents('#tipeNewsEventDiv'));
			}
			else { // This is the default behavior
				error.insertAfter(element);
			}
		}
    },

	'formEditPersonalInformation':{
        ignore: null,
		rules:{
            'firstName':{
                required:true,
				STD_VAL_WEB_3: true,
            },
            'lastName':{
                required: true,
                STD_VAL_WEB_3: true,
            },
			'birthDate':{
				required:true,
                STD_VAL_WEB_11: true,
            },
			'gender':{
				required:true
			},
			'phoneNumber':{
				required:true,
				STD_VAL_WEB_8: true,
			},
			'myLocation':{
				required:true,
			},
			'lingkedInLink':{
				required: true,
				STD_VAL_WEB_20: true,
			},
		},
		submitHandler:false,
        errorPlacement: function (error, element) {
			if (element.is("#myLocation")) {
				error.appendTo(element.parents('#myLocationDiv'));
			}else if (element.is("#gender")) {
				error.appendTo(element.parents('#genderDiv'));
			}
			else { // This is the default behavior
				error.insertAfter(element);
			}
		}
    },

	'updateStatusCandidate':{
		ignore: null,
		rules:{
            'aplicationStatus':{
                required:true
            },
            'TestId':{
                required: true
            },
		},
		submitHandler:false,
        errorPlacement: function (error, element) {
			if (element.is("#aplicationStatus")) {
				error.appendTo(element.parents('#aplicationStatusDivv'));
			}else if (element.is("#TestId")) {
				error.appendTo(element.parents('#TestIdDiv'));
			}
			else { // This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formAddQuestionBank':{
		ignore: null,
		rules:{
            'setTest':{
                required:true
            },
            'testType':{
                required: true
            },
			'subCognitive':{
                required: true
            },
		},
		submitHandler:false,
        errorPlacement: function (error, element) {
			if (element.is("#setTest")) {
				error.appendTo(element.parents('#setTestDiv'));
			}else if (element.is("#testType")) {
				error.appendTo(element.parents('#testTypeDiv'));
			}else if (element.is("#subCognitive")) {
				error.appendTo(element.parents('#subCognitiveDiv'));
			}
			else { // This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formAddTest':{
		ignore: null,
		rules:{
            'cityTest':{
                required:true
            },
            'locationTest':{
                required: true
            },
			'timeTest':{
                required: true
            },
			'dateTest':{
                required: true
            },
			'longlatTest':{
				required: true
			},
			'setTest':{
				required: true
			},
		},
		messages: {
			setTest: {
				required: 'Mohon pilih salah satu set test',
			}
        },
		submitHandler:false,
        errorPlacement: function (error, element) {
			if (element.is("input[name=setTest]")) {
				error.appendTo(element.parents('#setTestDiv'));
			}else { // This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formAddInterview':{
		ignore: null,
		rules:{
            'typeInterview':{
                required:true
            },
            'locationInterview':{
                required: true
            },
			'timeInterview':{
                required: true
            },
			'dateInterview':{
                required: true
            },
			'cityInterview':{
				required: true
			},
			'interviewer':{
				required: true
			},
		},
		messages: {
			setTest: {
				required: 'Mohon pilih salah satu set test',
			}
        },
		submitHandler:false,
        errorPlacement: function (error, element) {
			if (element.is("#typeInterview")) {
				error.appendTo(element.parents('#typeInterviewDiv'));
			}else { // This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'updateStatusInterview':{
		ignore: null,
		rules:{
            'noteInterview':{
                required:true
            }
		},
		submitHandler:false,
        errorPlacement: function (error, element) {
			error.insertAfter(element);
		}
	}

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


		jQuery.validator.addMethod("STD_VAL_WEB_1", function(value, element) {
			return this.optional(element) || /^(?=.*\d)([a-zA-Z0-9]+)(?!.*[ #<>\/\\=”’"'!@#$%^&()]).{6,10}$/.test(value);
		}, "Username yang Anda masukkan harus terdiri dari 6-10 karakter alfanumerik tanpa spasi");

		jQuery.validator.addMethod("STD_VAL_WEB_2", function(value, element) { // 3x salah blokir
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w])(?!.*\s).{8,12}$/.test(value);
		}, "Password kombinasi huruf kapital, huruf kecil, angka, dan karakter non-alphabetic");

		jQuery.validator.addMethod("STD_VAL_WEB_3", function(value, element) {
			return this.optional(element) || /^[a-zA-Z.' ]*$/.test(value);
		}, "Nama harus terdiri dari alfabet, titik (.) dan single quote (')");

		// STD_VAL_WEB_4 Jenis Kelamin (kemungkinan select option)

		jQuery.validator.addMethod("STD_VAL_WEB_5",function(value,element){
			value = value.toLowerCase();
			return this.optional(element) || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value);
		},"Email Anda salah. Email harus terdiri dari @ dan domain");

		jQuery.validator.addMethod("STD_VAL_WEB_6", function(value, element) {
			return this.optional(element) || /^\d{16}$/.test(value);
		}, "Nomor KTP yang Anda masukkan salah. Harus terdiri dari 16 karakter");

		jQuery.validator.addMethod("STD_VAL_WEB_7", function(value, element) {
			return this.optional(element) || /^\d{15}$/.test(value);
		}, "NPWP yang Anda masukkan salah. Harus terdiri dari 15 karakter tanpa spasi dan symbol");

		jQuery.validator.addMethod("STD_VAL_WEB_8", function(value, element) {
			return this.optional(element) || /^\d{11,13}$/.test(value);
		}, "Nomor HP yang Anda masukkan salah");

		jQuery.validator.addMethod("STD_VAL_WEB_9", function(value, element) { // 3x salah blokir
			return this.optional(element) || /^\d{6}$/.test(value);
		}, "Pin yang anda masukkan salah. Jika salah hingga 3x akan otomatis terblokir");

		jQuery.validator.addMethod("STD_VAL_WEB_10", function(value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\s).{6,255}$/.test(value);
		}, "Alamat yang anda masukkan salah");

		jQuery.validator.addMethod("STD_VAL_WEB_11", function(value, element) {
			return this.optional(element) || /^(((0[1-9]|[12]\d|3[01])\-(0[13578]|1[02])\-((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\-(0[13456789]|1[012])\-((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\-02\-((19|[2-9]\d)\d{2}))|(29\-02\-((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/.test(value);
		}, "Masukkan format tanggal yang sesuai");

		jQuery.validator.addMethod("STD_VAL_WEB_12", function(value, element) {
			return this.optional(element) || /^([1-9]|([012][0-9])|(3[01]))-([0]{0,1}[1-9]|1[012])-\d\d\d\d [012]{0,1}[0-9]:[0-6][0-9]:[0-6][0-9]$/.test(value);
		}, "Masukkan format tanggal yang sesuai");

		jQuery.validator.addMethod("STD_VAL_WEB_13", function(value, element) { // 3x salah blokir, expired 3 menit, 1 menit untuk retry
			return this.optional(element) || /^\d{6}$/.test(value);
		}, "OTP yang Anda masukkan salah");

		jQuery.validator.addMethod("STD_VAL_WEB_14", function(value, element) {
			return this.optional(element) || /^[a-zA-Z0-9]{8,12}$/.test(value);
		}, "MPIN yang Anda masukkan salah");

		jQuery.validator.addMethod("STD_VAL_WEB_15", function(value, element) { // setelah 4 input angka otomatis spasi (tambahkan pada masking)
			return this.optional(element) || /^[0-9 ]{19}$/.test(value);
		}, "Nomor kartu yang Anda masukkan tidak valid/salah");

		jQuery.validator.addMethod("STD_VAL_WEB_16", function(value, element) { // Saat input otomatis masking
			return this.optional(element) || /^\d{3}$/.test(value);
		}, "CVV yang Anda masukkan tidak valid/salah");

		jQuery.validator.addMethod("STD_VAL_WEB_17", function(value, element) { // Maxlength sesuai kebutuhan
			return this.optional(element) || /^[0-9]*$/.test(value);
		}, "Virtual Account Number yang anda masukkan tidak valid");

		jQuery.validator.addMethod('STD_VAL_WEB_18', function(value, element, param) {
			param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpeg|png";
			return this.optional(element) || (element.files[0].size <= 1000000 && value.match(new RegExp("\\.(" + param + ")$", "i")))
		}, "Upload gambar maksimal 1MB");

		jQuery.validator.addMethod('STD_VAL_WEB_19', function(value, element, param) {
			param = typeof param === "string" ? param.replace(/,/g, "|") : "doc|docx|xls|xlsx|csv";
			return this.optional(element) || (element.files[0].size <= 5000000 && value.match(new RegExp("\\.(" + param + ")$", "i")))
		}, "Upload file maksimal 5MB");

		jQuery.validator.addMethod("STD_VAL_WEB_20", function(value, element) {
			return this.optional(element) || /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/.test(value);
		}, "URL yang Anda masukkan tidak valid");

		// STD_VAL_WEB_21 Accepted (kemungkinan checkbox)
		// STD_VAL_WEB_22 Active_url 

		jQuery.validator.addMethod("STD_VAL_WEB_23", function (value, element) {
			return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
		}, "Input harus a-z A-Z");

		jQuery.validator.addMethod("STD_VAL_WEB_24", function (value, element) {
			return this.optional(element) || /^([0-9]+)$/.test(value);
		}, "Input harus 0-9");

		jQuery.validator.addMethod("STD_VAL_WEB_25", function (value, element) {
			return this.optional(element) || /^[a-zA-Z0-9 ]*$/.test(value);
		}, "Input harus 0-9, a-z, A-Z");

		jQuery.validator.addMethod("STD_VAL_WEB_26", function (value, element) {
			return this.optional(element) || /^[a-zA-Z0-9-_]*$/.test(value);
		}, "Input harus 0-9, a-z, A-Z, -, _");

		// STD_VAL_WEB_27 array 
		// STD_VAL_WEB_28 boolean (radio button) 

		jQuery.validator.addMethod("STD_VAL_WEB_29", function (value, element, param) {
			return this.optional(element) || value == $(param).val();
		}, "Input tidak cocok");

		jQuery.validator.addMethod("STD_VAL_WEB_30", function (value, element) {
			return this.optional(element) || /^\d+$/.test(value);
		}, "Input harus digit");

		jQuery.validator.addMethod("STD_VAL_WEB_31", function (value, element, param) {
			return this.optional(element) || (value >= param[0] && value <= param[1]);
		}, "Input harus berdasarkan range");

		// STD_VAL_WEB_32 
		// STD_VAL_WEB_33 

		jQuery.validator.addMethod("STD_VAL_WEB_34", function (value, element) {
			return this.optional(element) || /^-?\d+$/.test(value);
		}, "Input harus bilangan bulat");

		jQuery.validator.addMethod("STD_VAL_WEB_35", function (value, element) {
			return this.optional(element) || /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(value);
		}, "Input harus valid IP");

		
		jQuery.validator.addMethod("STD_VAL_WEB_36", function (value, element) {
			return this.optional(element) || /^(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)$/i.test(value);
		}, "Input harus ipv4");

		jQuery.validator.addMethod("STD_VAL_WEB_37", function (value, element) {
			return this.optional(element) || /^((([0-9A-Fa-f]{1,4}:){7}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}:[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){5}:([0-9A-Fa-f]{1,4}:)?[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){4}:([0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){3}:([0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){2}:([0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([0-9A-Fa-f]{1,4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([0-9A-Fa-f]{1,4}:){0,5}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|([0-9A-Fa-f]{1,4}::([0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})|(::([0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){1,7}:))$/i.test(value);
		}, "Input harus ipv6");

		jQuery.validator.addMethod("STD_VAL_WEB_38", function (value, element, param) {
			return this.optional(element) || /^[\],:{}\s]*$/.test(text.replace(/\\["\\\/bfnrtu]/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''));
			// function isValidJSON(param) {
			//     try {
			//         JSON.parse(param);
			//     } catch (e) {
			//         return false;
			//     }

			//     return true;
			// }
		}, "Input harus string json");
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

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

/**
 * Init Section
 */
$(document).ready(function () {
	_ajax.init();
	table.init();
	form.init();
	ui.slide.init();
	validation.addMethods();
	// if ($('#main-wrapper').length) {
	//     other.checkSession.init();
	// }
	$(document).ajaxError(function (event, jqxhr, settings, exception) {
		console.log('exception = ' + exception);
	});

	moveOnMax = function moveOnMax(field, nextFieldID) {
		if (field.value.length == 1) {
			document.getElementById(nextFieldID).focus();
		}
	};

	if ($('#notif').length) {
		var status = $('#notif').data('status');
		var message = $('#notif').data('message');
		var url = $('#notif').data('url');

		ui.popup.show(status, message, url);
	}
});

// window.onload = function () {
//     if ("performance" in window) {
//         if ("timing" in window.performance) {
//             var time = window.performance.timing.loadEventStart - window.performance.timing.domLoading;

//             var seconds = time / 1000;
//             // 2- Extract hours:
//             var hours = parseInt(seconds / 3600); // 3,600 seconds in 1 hour
//             seconds = seconds % 3600; // seconds remaining after extracting hours
//             // 3- Extract minutes:
//             var minutes = parseInt(seconds / 60); // 60 seconds in 1 minute
//             // 4- Keep only seconds not extracted to minutes:
//             seconds = seconds % 60;
//             document.getElementById("total_render_time").innerHTML = "Load Time: " + (seconds) + " seconds";
//         } else {
//             document.getElementById("result").innerHTML = "Page Timing API not supported";
//         }
//     } else {
//         document.getElementById("result").innerHTML = "Page Performance API not supported";
//     }
// }

$('.modal').on('hidden.bs.modal', function (e) {
	$(this).find('form')[0].reset();
	$('.select').val('').trigger('change');
});

var baseUrl = $('meta[name=base]').attr('content') + '/';
var baseImage = $('meta[name=baseImage]').attr('content') + '/';
var cdn = $('meta[name=cdn]').attr('content');

var other = {

	encrypt: function encrypt(formdata, callback) {
		$.ajax({
			url: baseUrl + 's',
			type: 'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function success(data) {
				var pass = data;
				if (pass.status !== "error" && pass.status !== "reload") {
					var password = pass.password;
					var salt = CryptoJS.lib.WordArray.random(128 / 8);
					var key256Bits500Iterations = CryptoJS.PBKDF2("Secret Passphrase", salt, { keySize: 256 / 32, iterations: 500 });
					var iv = CryptoJS.enc.Hex.parse(password[2]);
					if (formdata.indexOf("&captcha=")) {
						var form = formdata.split("&captcha=");
						var captcha = form[1];
						formdata = form[0];
					}
					var encrypted = CryptoJS.AES.encrypt(formdata + '&safer=', key256Bits500Iterations, { iv: iv });

					var data_base64 = encrypted.ciphertext.toString(CryptoJS.enc.Base64);
					var iv_base64 = encrypted.iv.toString(CryptoJS.enc.Base64);
					var key_base64 = encrypted.key.toString(CryptoJS.enc.Base64);

					var encData = data_base64 + password[0] + iv_base64 + password[1] + key_base64 + password[2];
					var data = { data: encData };
					if (captcha != 'undefined') {
						data["captcha"] = captcha;
					}
					callback(null, data);
				} else {
					swal({
						title: pass.messages.title,
						text: pass.messages.message,
						type: "error",
						html: true,
						showCancelButton: true,
						confirmButtonColor: "green",
						confirmButtonText: "Refresh"
					}, function () {
						location.reload();
					});
				}
			}
		});
	},

	// js untuk fitur notifikasi backoffice
	notification: {
		init: function init() {
			if ($('#buttonNotif').length) {
				$.ajax({
					url: baseUrl + "notif/check",
					type: "POST",
					cache: false,
					beforeSend: function beforeSend(jxqhr) {},
					success: function success(result) {
						var resultCount = 0;
						var i;
						for (i in result) {
							if (result.hasOwnProperty(i)) {
								resultCount++;
							}
						}

						if (resultCount > 0) {
							var link = '';
							var div_element = $('.drop-content-notif');
							div_element.empty();
							$.each(result.notif, function (index, data) {
								var li_element = null;

								if (data.status_notif == '1') {
									li_element = $('<li>');
								} else {
									li_element = $('<li>').addClass("unread");
								}
								li_element.append('<a href="' + baseUrl + 'notif/get/' + data.id_notif + '" class="aNotif">' + '<b class="font-notif">' + data.message_notif + '</b> </br>' + '<span class="font-notif">' + data.created_at + '</span>' + '</a>');
								div_element.append(li_element);
							});
						} else {
							li_element.append('<li class="dropdown-item-notif">' + '<span>Belum ada notifikasi</span>' + '</li>');
							div_element.append(li_element);
						}
						if (result.countNotif > 0) {
							$("#total-notif").show();
							$("#totalNotif").html(result.countNotif);
						} else {
							$("#total-notif").hide();
						}
					}
				});
			}
		}
	},

	checkSession: {
		stat: false,
		init: function init() {
			var time = 905;
			function timerCheck() {
				if (time == 0) {
					other.checkSession.action();
				} else {
					time--;
				}
			}

			function reset() {
				time = 905;
			}

			$(document).on('mousemove keypress', function () {
				reset();
			});

			setInterval(function () {
				timerCheck();
			}, 1000);
		},
		action: function action() {
			if (!other.checkSession.stat) {
				other.checkSession.stat = true;
				$.ajax({
					url: baseUrl + 'checkSession',
					global: false,
					type: 'get',
					beforeSend: function beforeSend(jxqhr) {},
					success: function success(data) {
						if (data == '1') {
							other.checkSession.idler = 0;
							other.checkSession.stat = false;
						} else {
							ui.popup.show('warning', 'Anda sudah tidak aktif dalam waktu 15 menit', '/logout');
						}
					}
				});
			}
		}
	}
};
function reload() {
	location.reload();
}

var _ajax = {
	init: function init() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			beforeSend: function beforeSend(jxqhr) {
				ui.popup.showLoader();
			},
			timeout: 30000,
			error: function error(event, jxqhr, status, _error) {
				ui.popup.show('error', 'Sedang Gangguan Jaringan', 'Error');
				ui.popup.hideLoader();
			},
			complete: function complete() {},
			global: true
		});
	},
	getData: function getData(url, method, params, callback) {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		if (params == null) {
			params = {};
		}
		$.ajax({
			type: method,
			url: baseUrl + url,
			data: params,
			success: function success(result) {
				ui.popup.hideLoader();
				if (result.status == 'success') {
					ui.popup.hideLoader();
					if (result.callback == 'redirect') {
						ui.popup.show(result.status, result.message, result.url);
					}
				}
				if (result.status == 'error') {
					ui.popup.show('error', result.messages.message, result.messages.title);
				} else if (result.status == 'reload') {
					ui.popup.alert(result.messages.title, result.messages.message, 'refresh');
				} else if (result.status == 'logout') {
					ui.popup.alert(result.messages.title, result.messages.message, 'logout');
				} else if (result == 401) {
					ui.popup.show('warning', 'Sesi Anda telah habis, harap login kembali', 'Session Expired');
					if ($('.toast-warning').length == 2) {
						$('.toast-warning')[1].remove();
					}
					setInterval(function () {
						window.location = '/logout';
					}, 3000);
				} else {
					if (result instanceof Array || result instanceof Object) {
						callback(result);
					} else {
						callback(JSON.parse(result));
					}
				}
			}
		});
	},
	submitData: function submitData(url, data, form_id) {
		other.encrypt(data, function (err, encData) {
			if (err) {
				callback(err);
			} else {
				$.ajax({
					url: url,
					type: 'post',
					data: encData,
					error: function error(jxqhr, status, _error2) {
						ui.popup.hideLoader();
						ui.popup.show('error', _error2, 'Error');
					},
					success: function success(result, status) {
						if (result == null) {
							ui.popup.show(result.status, 'Error');
							ui.popup.hideLoader();
						} else if (result == 401) {
							ui.popup.show('warning', 'Sesi anda habis, mohon login kembali', 'Session Expired');
							ui.popup.hideLoader();
							setInterval(function () {
								window.location = '/logout';
							}, 3000);
						} else {
							if (result.status == 'success') {
								$('.modal').modal('hide');
								ui.popup.hideLoader();
								if (result.callback == 'redirect') {
									ui.popup.show(result.status, result.message, result.url);
								} else if (result.callback == 'login') {
									// ui.toast.show();
									setInterval(function () {
										window.location = result.url;
									}, 2000);
								} else if (result.callback == 'reload') {
									setInterval(function () {
										window.location.reload();
									}, 2000);
								}
							} else if (result.status == 'info') {
								ui.popup.hideLoader();
								// bisa menggunakan if seperti diatas
							} else if (result.status == 'warning') {
								ui.popup.hideLoader();
								if (result.callback == 'redirect') {
									ui.popup.show(result.status, result.message, result.url);
								}
							} else {
								if (result.messages == '<p>Error: Validation</p>') {
									ui.popup.hideLoader();
									$("#" + form_id).validate().showErrors(result.errors);
									ui.popup.show(result.status, "Harap cek isian");
								} else {
									ui.popup.show(result.status, result.message);
									ui.popup.hideLoader();
								}
							}
						}
					}
				});
			}
		});
	},
	submitImage: function submitImage(url, form_id, path, to_id) {}
};

var form = {
	init: function init() {
		$('form').attr('autocomplete', 'off');
		if ($('.select2').length) {
			$('.select2').select2();
		}
		$('input').focus(function () {
			$(this).parents('.form-group').addClass('focused');
		});

		$('textarea').focus(function () {
			$(this).parents('.form-group').addClass('focused');
		});
		$('input').blur(function () {
			var inputValue = $(this).val();
			if (inputValue == "") {
				$(this).removeClass('filled');
				$(this).parents('.form-group').removeClass('focused');
			} else {
				$(this).addClass('filled');
			}
		});
		$('textarea').blur(function () {
			var inputValue = $(this).val();
			if (inputValue == "") {
				$(this).removeClass('filled');
				$(this).parents('.form-group').removeClass('focused');
			} else {
				$(this).addClass('filled');
			}
		});
		$.validator.addMethod("lettersonly", function (value, element) {
			return this.optional(element) || /^[a-z]+$/i.test(value);
		}, "Letters only please");

		$.validator.addMethod("regexp", function (value, element, regexpr) {
			return regexpr.test(value);
		}, "");
		$.each($('form'), function (key, val) {
			$(this).validate(formrules[$(this).attr('id')]);
		});
		$('form').submit(function (e) {
			e.preventDefault();
			console.log('masuk');
			var form_id = $(this).attr('id');
			form.validate(form_id);
		});
	},
	validate: function validate(form_id) {

		var formVal = $('#' + form_id);
		var message = formVal.attr('message');
		var agreement = formVal.attr('agreement');
		var defaultOptions = {
			errorPlacement: function errorPlacement(error, element) {
				if (element.parent().hasClass('input-group')) {
					error.appendTo(element.parent().parent());
				} else {
					var help = element.parents('.form-group').find('.help-block');
					if (help.length) {
						error.appendTo(help);
					} else {
						error.appendTo(element.parents('.form-group'));
					}
				}
			},
			highlight: function highlight(element, errorClass, validClass) {
				alert('test');
				$(element).parents('.form-group').addClass('has-error');
			},
			unhighlight: function unhighlight(element, errorClass, validClass) {

				$(element).parents('.form-group').removeClass('has-error');
			}
		};
		var ops = Object.assign(defaultOptions, formrules[form_id]);

		var myform = formVal.validate(ops);
		$('button[type=reset]').click(function () {
			myform.resetForm();
		});
		if (formVal.valid()) {
			console.log(form_id);
			if (message != null && message != '') {
				if (message.indexOf('|') > -1) {
					var m_data = message.split('|');
					var m_text = m_data[0];
					var m_val = m_data[1];

					var t_data = m_val.split(';');
					var table = '<table class="table">';
					$.each(t_data, function (key, val) {
						var c1 = val.split(':')[0];
						var c2 = form.find('input[name=' + val.split(':')[1] + '],select[name=' + val.split(':')[1] + ']').val();
						table += '<tr><td>' + c1 + '</td><td>' + c2 + '</td></tr>';
					});
					table += '</table>';

					message = m_text + table;
				}
				ui.popup.confirm('Konfirmasi', message, 'form.submit("' + form_id + '")');
			} else if (agreement != null && agreement != '') {
				message = $("#" + agreement).html();
				ui.popup.agreement('Persetujuan Agen Baru', message, 'form.submit("' + form_id + '")');
			} else {
				form.submit(form_id);
			}
		} else {
			ui.popup.show('error', 'Harap cek isian', 'Form Tidak Valid');
		}
	},
	submit: function submit(form_id) {
		var form = $('#' + form_id);
		var url = form.attr('action');
		var ops = formrules[form_id];
		if (ops == null) {
			ops = {};
		}
		var i = 1;
		var input = $('.form-control');
		var data = form.serialize();
		var isajax = form.attr('ajax');
		var isFilter = form.attr('filter');
		if (isajax == 'true') {
			if (form_id == 'payform') {
				form_id = $('#' + form_id).attr('for');
			}
			_ajax.submitData(url, data, form_id);
		} else if (isFilter == 'true') {
			table.filter(form_id, data);
		} else {
			other.encrypt(data, function (err, encData) {
				if (err) {
					callback(err);
				} else {
					var encryptedElement = $('<input type="hidden" name="data" />');
					$(encryptedElement).val(encData['data']);
					form.find('select,input:not("input[type=file],input[type=hidden][name=_token],input[name=captcha]")').attr('disabled', 'true').end().append(encryptedElement).unbind('submit').submit();
				}
			});
		}
	}

	// Fungsi Format rupiah untuk form
};function formatRupiahRp(angka) {
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
	return 'Rp ' + rupiah;
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
	return rupiah;
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
	return rupiah;
}

if ($("#formAddEventNews").length) {
	$('#tglMulaiNewsEvent').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$('#tglSelesaiNewsEvent').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$('#descriptionNewsEvent').summernote({
		height: 200 //set editable area's height
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
		format: 'DD-MM-YYYY'
	});

	$('#tglSelesaiNewsEvent').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$('#descriptionNewsEvent').summernote({
		height: 200 //set editable area's height
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
		format: 'DD-MM-YYYY'
	});

	$('#descriptionVacancy').summernote({
		height: 200 //set editable area's height
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
	$(".add-more-syarat").click(function (e) {
		e.preventDefault();
		var childDivs = document.querySelectorAll('#fieldMajorDiv' + next2 + ' span');
		console.log(childDivs);
		var addto = "#field-syarat" + next2;
		var addRemove = "#field-syarat" + next2;
		next2 = next2 + 1;
		// var newIn = '<label>Syarat</label><input autocomplete="off" class="form-input bg-input form-control" id="field-syarat' + next2 + '" name="syarat[]" type="text" style="width: 93%; float: left;">';
		var newIn = '<select class="select2 min-width" id="field-syarat' + next2 + '" name="majorVacancy">' + '<option value="">-- Pilih Major --</option>' + '<option value="Sistem Informasi">Sistem Informasi</option>' + '<option value="Akuntansi">Akuntansi</option>' + '</select>';
		$("#field-syarat" + next2).select2();
		var newInput = $(newIn);
		var removeBtn = '<button id="remove-syarat' + (next2 - 1) + '" class="btn remove-me-syarat btn-min">-</button></><div id="field-syarat">';
		var removeButton = $(removeBtn);
		$(addto).after(newInput);
		$(addRemove).after(removeButton);

		$("#field-syarat" + next2).attr('data-source', $(addto).attr('data-source'));
		$("#count").val(next2);
		$('.remove-me-syarat').click(function (e) {
			e.preventDefault();
			var fieldNum = 'field' + this.id.toString().replace('remove', '');
			console.log(fieldNum);
			$('#' + fieldNum).remove();
			$(this).prev().remove();
			$(this).remove();
		});

		$('select[name="majorVacancy"]').select2();
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
		format: 'DD-MM-YYYY'
	});

	$('#descriptionVacancy').summernote({
		height: 200 //set editable area's height
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

	$(".add-more-syarat").click(function (e) {
		e.preventDefault();
		this.remove();
		var btnAdd = this;
		var jml = $('#fieldMajorDiv1 select').length;
		var next = jml + 1;

		//change btn to minus
		var removeBtn = '<button type="button" id="remove-syarat' + jml + '" class="btn remove-me-syarat btn-min">-</button>';
		var after = $('#field-syarat' + jml).next();
		after.after(removeBtn);

		var newIn = '<select class="select2 min-width" id="field-syarat' + next + '" name="majorVacancy">' + '<option value="">-- Pilih Major --</option>' + '<option value="Sistem Informasi">Sistem Informasi</option>' + '<option value="Akuntansi">Akuntansi</option>' + '</select>';
		$('#fieldMajorDiv1').append(newIn);
		$('#fieldMajorDiv1').append(btnAdd);

		$('select[name="majorVacancy"]').select2();
	});

	$('.remove-me-syarat').click(function (e) {
		e.preventDefault();
		var fieldNum = 'field' + this.id.toString().replace('remove', '');
		console.log(fieldNum);
		$('#' + fieldNum).remove();
		$(this).prev().remove();
		$(this).remove();
	});
}

function readFile(input) {
	console.log(input.files, input.files[0]);
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			var htmlPreview = '<img src="' + e.target.result + '" style="width:100%;height:auto" />';
			var wrapperZone = $(input).parent();
			var previewZone = $(input).parent().parent().find('.preview-zone');
			var boxZone = $(input).parent().find('.dropzone-desc');
			var top = Math.floor(150 / 2);

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

$(".dropzone").change(function () {
	readFile(this);
});
$('.dropzone-wrapper').on('dragover', function (e) {
	e.preventDefault();
	e.stopPropagation();
	$(this).addClass('dragover');
});
$('.dropzone-wrapper').on('dragleave', function (e) {
	e.preventDefault();
	e.stopPropagation();
	$(this).removeClass('dragover');
});
$('.remove-preview').on('click', function () {
	var boxZone = $(this).parents('.preview-zone').find('.box-body');
	var previewZone = $(this).parents('.preview-zone');
	var dropzone = $(this).parents('.form-group').find('.dropzone');
	boxZone.empty();
	previewZone.addClass('hidden');
	reset(dropzone);
});

$("#tipeNewsEvent").change(function () {
	var valueTipe = $("#tipeNewsEvent").val();

	if (valueTipe == "1") {
		$("#divDateNewsEvent").addClass('hidden');
		$(".dateNewsEvent").attr('disabled', true);
	} else {
		$("#divDateNewsEvent").removeClass('hidden');
		$(".dateNewsEvent").attr('disabled', false);
	}
});

if ($("#formFirstLogin").length) {
	$('#startDateEdication').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$('#endDateEdication').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$('.btnAddListEdication').click(function (e) {
		e.preventDefault();
		$('.btnAddListEdication.large').hide();
		$('.firstBtnListEducation').removeClass('margin-right-2rem');

		var option = '<div class="listStudy">' + '<hr>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">School/University<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="School/University">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Degree<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<select name="" id="" class="select2 form-control">' + '<option value="">Choose your degree</option>' + '<option value="">Opt 1</option>' + '<option value="">Opt 1</option>' + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Faculty<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="Faculty">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Major<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="Major">' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Start Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="startDateEdication" name="startDateEdication">' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">End Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="endDateEdication" name="endDateEdication">' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Certificate of Study<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="Format jpg/png maximum 2MB file">' + '<p id="filenameCertificateStudy" class="m-1"></p>' + '<span class="btn btn-file pl-1 mb-2">' + 'Upload File <input type="file">' + '</span>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12 removeThisEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEdication">' + '<i class="fas fa-trash mr-2" style="font-size:18px"></i> Delete the Education Data Above' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12 secondBtnEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEdication">' + '<i class="fas fa-plus mr-2" style="font-size:18px"></i> Add Another Education' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>';

		$('#listEducationCandidate').append(option);

		$('input[name="startDateEdication"]').datetimepicker({
			format: 'DD-MM-YYYY'
		});

		$('input[name="endDateEdication"]').datetimepicker({
			format: 'DD-MM-YYYY'
		});

		if ($('.select2').length) {
			$('.select2').select2();
		}
		if ($('.removeThisEducation').length) {
			$('.removeThisEducation').click(function () {
				console.log('click');
				$(this).parent().parent().remove();

				if ($('.listStudy').length < 2) {
					$('.btnAddListEdication.large').show();
				}
			});
		}
		if ($('.secondBtnEducation').length) {
			$('.secondBtnEducation').click(function () {
				$(this).remove();
				$('.btnAddListEdication.large').click();
			});
		}
	});
}

if ($("#formEditEducationInformation").length) {
	$('.btnAddListEdication').click(function (e) {
		e.preventDefault();
		$('.btnAddListEdication.large').hide();
		$('.firstBtnListEducation').removeClass('margin-right-2rem');

		var option = '<div class="listStudy">' + '<hr>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">School/University<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="School/University">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Degree<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<select name="" id="" class="select2 form-control">' + '<option value="">Choose your degree</option>' + '<option value="">Opt 1</option>' + '<option value="">Opt 1</option>' + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Faculty<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="Faculty">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Major<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="Major">' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Start Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="startDateEdication" name="startDateEdication">' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">End Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="endDateEdication" name="endDateEdication">' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Certificate of Study<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="Format jpg/png maximum 2MB file">' + '<p id="filenameCertificateStudy" class="m-1"></p>' + '<span class="btn btn-file pl-1 mb-2">' + 'Upload File <input type="file">' + '</span>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12 removeThisEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEdication">' + '<i class="fas fa-trash mr-2" style="font-size:18px"></i> Delete the Education Data Above' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12 secondBtnEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEdication">' + '<i class="fas fa-plus mr-2" style="font-size:18px"></i> Add Another Education' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>';

		$('#listEducationCandidate').append(option);

		$('input[name="startDateEdication"]').datetimepicker({
			format: 'DD-MM-YYYY'
		});

		$('input[name="endDateEdication"]').datetimepicker({
			format: 'DD-MM-YYYY'
		});

		if ($('.select2').length) {
			$('.select2').select2();
		}
		if ($('.removeThisEducation').length) {
			$('.removeThisEducation').click(function () {
				console.log('click');
				$(this).parent().parent().remove();

				if ($('.listStudy').length < 2) {
					$('.btnAddListEdication.large').show();
				}
			});
		}
		if ($('.secondBtnEducation').length) {
			$('.secondBtnEducation').click(function () {
				$(this).remove();
				$('.btnAddListEdication.large').click();
			});
		}
	});
}
var table = {
	init: function init() {

		if ($('#tableNewsEvent').length) {
			var column = [{ 'data': 'created_at' }, { 'data': 'title' }, { 'data': 'start_date' }, { 'data': 'end_date' }];

			columnDefs = [{
				"targets": 2,
				"data": "type",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.type == 1) {
						data = '-';
					} else {
						data = full.start_date;
					}
					return data;
				}
			}, {
				"targets": 3,
				"data": "type",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.type == 1) {
						data = '-';
					} else {
						data = full.end_date;
					}
					return data;
				}
			}, {
				"targets": 4,
				"data": "type",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.type == 1) {
						data = 'News';
					} else {
						data = 'Event';
					}
					return data;
				}
			}, {
				"targets": 5,
				"data": "status",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status == 1) {
						data = '<span class="status status-success">Aktif</span>';
					} else {
						data = '<span class="status status-delete">Deaktif</span>';
					}
					return data;
				}
			}, {
				"targets": 6,
				"data": "id",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					var konfirm = '';
					var data = '<button type="button" class="btn btn-table btn-transparent"><a href="/HR/news_event/detail-news-event/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/lingkarEdit_icon.svg" title="Edit News/Event"></a></button>';
					if (full.status == '1') {
						konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/lingkarHapus_icon.svg" title="Deaktif News/Event"></button>';
					} else {
						konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmNewsEvent"><img style="margin-right: 1px;" src="/image/icon/main/lingkarAktif_icon.svg" title="Aktifkan News/Event"></button>';
					}
					return data + konfirm;
				}
			}];

			table.serverSide('tableNewsEvent', column, '/HR/news_event/list-news-event', null, columnDefs);
		}

		if ($('#tableVacancy').length) {
			var column = [{
				'data': null
			}, {
				'data': null
			}, {
				'data': null
			}];

			columnDefs = [{
				"targets": 0,
				"orderable": false,
				"className": "img-poster-news",
				"data": "job_poster",
				"render": function render(data, type, full, meta) {
					var data = '<img src="/image/icon/main/logo-astra.svg" alt="img" style="width:75%;height:auto" />';

					return data;
				}
			}, {
				"targets": 1,
				"data": "job_title",
				"className": "title-poster-news",
				"render": function render(data, type, full, meta) {
					// var data = full.job_title;
					var degree = '';
					if (full.degree == "1") {
						degree = "D3";
					} else if (full.degree == "2") {
						degree = "S1";
					} else if (full.degree == "3") {
						degree = "S2";
					}
					var data = '<h5 style="font-style: normal;font-weight: bold;font-size: 20px;line-height: 130%;letter-spacing: -0.02em;color: #282A2C;margin-bottom: 1px;">' + full.job_title + '</h5>' + '<p style="font-style: normal;font-weight: 200;font-size: 16px;line-height: 130%;letter-spacing: -0.02em;color: #282A2C;">' + full.lokasi + ', Indonesia</p>' + '<p style="font-style: normal;font-weight: 500;font-size: 14px;line-height: 130%;letter-spacing: -0.02em;color: #333333;">' + degree + ', Bachelors Degree in ' + full.job_title + '</p>' + '<p style="font-style: normal;font-weight: 400;font-size: 14px;line-height: 130%;letter-spacing: -0.02em;color: #333333;">' + full.major + '</p>';

					return data;
				}
			}, {
				"targets": 2,
				"data": "id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.job_id));
					var konfirm = '';
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a href="/HR/vacancy/detail-vacancy/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Vacancy"></a></button>';
					if (full.status == '1') {
						konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy"><img style="margin-right: 1px;" src="/image/icon/main/delete.svg" title="Deaktif Vacancy"></button>';
					} else {
						konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy"><img style="margin-right: 1px;" src="/image/icon/main/delete.svg" title="Aktifkan Vacancy"></button>';
					}
					var hasil = '<div style="position:absolute;top:20px;right:5px">' + data + konfirm + '</div>';

					return hasil;
				}
			}];

			table.serverSide('tableVacancy', column, 'HR/vacancy/list-vacancy', null, columnDefs);
		}
	},
	filter: function filter(id, value) {
		var imageDetail = '../image/icon/main/eye-solid.png';
		var imageEdit = '../image/icon/main/pen-square-solid.png';
		var imageDeactive = '../image/icon/main/deactive.png';
		var imageActive = '../image/icon/main/activae.png';

		$('.modal').modal('hide'); // ketika fitur filternya menggunakan modal
		if (id == 'filterCabang') {
			var column = [{ 'data': 'kode_cabang' }, { 'data': 'nama_cabang' }, { 'data': 'alamat' }, { 'data': 'kota' }, { 'data': 'provinsi' }, { 'data': 'no_telp' }, { 'data': null }];

			columnDefs = [{
				"targets": 6,
				"data": "status",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status == 'Deactive') {
						data = '<span class="badge-table badge-grey">Deactive</span>';
					} else if (full.status == 'Active') {
						data = '<span class="badge-table badge-blue">Active</span>';
					}
					return data;
				}
			}, {
				"targets": 7,
				"data": "id",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					if (full.status == "Active") {
						var link_item = '<a class="dropdown-item deactiveCabang" href="#">' + '<div class="icon-dropdown-menu d-inline-block">' + '<img src="' + imageDeactive + '" />' + '</div>' + '<span class="ml-2 d-inline-block">Deactive</span>' + '</a>';
					} else {
						var link_item = '<a class="dropdown-item activeCabang" href="#">' + '<div class="icon-dropdown-menu d-inline-block">' + '<img src="' + imageActive + '" />' + '</div>' + '<span class="ml-2 d-inline-block">Active</span>' + '</a>';
					}
					var data = '<div class="dropleft">' + '<button type="button" class="dropdown-toggle table-dropdown-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' + '<i class="fa fa-ellipsis-v"></i>' + '</button>' + '<div class="dropdown-menu dropdown-menu-table py-2">' + '<a class="dropdown-item detailCabang" href="#" type="button">' + '<div class="icon-dropdown-menu d-inline-block">' + '<img src="' + imageDetail + '" />' + '</div>' + '<span class="ml-2 d-inline-block">Detail</span>' + '</a>' + '<a class="dropdown-item" href="/cabang/edit-cabang/' + id + '">' + '<div class="icon-dropdown-menu d-inline-block">' + '<img src="' + imageEdit + '" />' + '</div>' + '<span class="ml-2 d-inline-block">Edit</span>' + '</a>' + link_item + '</div>' + '</div>';
					return data;
				}
			}];

			table.serverSide('tableCabang', column, 'cabang/get-cabang', value, columnDefs);
		}
	},
	getData: function getData(url, params, callback) {
		$.ajax({
			url: url,
			type: 'post',
			data: params,
			success: function success(result) {
				if (!result.error) {
					callback(null, result.data);
				} else {
					callback(data);
				}
			}
		});
	},
	clear: function clear(id) {
		var tbody = $('#' + id).find('tbody');
		tbody.html('');
	},
	serverSide: function serverSide(id, columns, url) {
		var custParam = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : null;
		var columnDefs = arguments.length > 4 && arguments[4] !== undefined ? arguments[4] : null;

		var urutan = [0, 'desc'];
		var ordering = true;

		if (id == "tableVacancy") {
			urutan = false;
			ordering = false;
		}

		var search = true;

		var svrTable = $("#" + id).DataTable({
			"drawCallback": function drawCallback(settings) {
				if (id == "tableVacancy") {
					$('.dataTables_scrollHead').remove();
					$('.dataTables_scrollBody table thead').hide();
				}
			},
			// processing:true,
			serverSide: true,
			columnDefs: columnDefs,
			columns: columns,
			// responsive: true,
			scrollX: true,
			// scrollY: true,
			ajax: function ajax(data, callback, settings) {
				data.param = custParam;
				_ajax.getData(url, 'post', data, function (result) {
					console.log(result);
					if (result.status == 'reload') {
						ui.popup.show('confirm', result.messages.title, result.messages.message, 'refresh');
					} else if (result.status == 'logout') {
						ui.popup.alert(result.messages.title, result.messages.message, 'logout');
					} else {
						// if untuk menampilkan respon summary ketika servicenya jadi 1
						if (id == 'tableReport') {
							$('#summary_unpaid').html(result.summary.unpaid);
							$('#summary_paid').html(result.summary.paid);
							$('#summary_expired').html(result.summary.expired);
						}
						callback(result);
					}
				});
			},
			bDestroy: true,
			searching: search,
			order: urutan,
			ordering: ordering
		});

		$('div.dataTables_filter input').unbind();
		$('div.dataTables_filter input').bind('keyup', function (e) {
			if (e.keyCode == 13) {
				svrTable.search(this.value).draw();
			}
		});
	},
	setAndPopulate: function setAndPopulate(id, columns, data, columnDefs, ops, order) {
		var _option;

		var orderby = order ? order : [0, "asc"];
		var option = (_option = {
			"data": data,
			"drawCallback": function drawCallback(settings) {},
			tableTools: {
				"sSwfPath": "assets/plugins/datatables/TableTools/swf/copy_csv_xls_pdf.swf",
				"aButtons": ["xls", "csv", "pdf"]
			},
			"columns": columns,
			"pageLength": 10,
			"order": [orderby],
			"bDestroy": true,
			"lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"aoColumnDefs": columnDefs,
			"scrollX": true,
			"scrollY": true
		}, _defineProperty(_option, 'lengthMenu', [[10, 25, 50, -1], [10, 25, 50, "All"]]), _defineProperty(_option, "buttons", ['csv', 'pdf']), _defineProperty(_option, "rowCallback", function rowCallback(row, data) {
			if (id == "tbl_notification") {
				if (data.read == "1") {
					$(row).css('background-color', '#D4D4D4');
				}
			}
			if (id == "tbl_mitra" || id == "tbl_user" || id == "tbl_agent_approved") {
				if (data.status == "0") {
					$(row).css('background-color', '#FF7A7A');
				}
			}
		}), _option);
		if (ops != null) {
			$.extend(option, ops);
		}
		var tbody = $('#' + id).find('tbody');

		var t = $('#' + id).DataTable(option);
		t.on('order.dt search.dt', function () {
			if (id == 'tableFitur') {} else {
				t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
					cell.innerHTML = i + 1;
				});
			}
		}).draw();
	}
};

$('#tableNewsEvent tbody').on('click', 'button.konfirmNewsEvent', function (e) {
	var table = $('#tableNewsEvent').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();

	if (dataRow.status == '1') {
		$('#titleKonfirmasiEventNews').html('Apakah Anda yakin akan menonaktifkan News/Event "' + dataRow.title + '" ?');
		$('#tipeDeleteNewsEvent').val('0');
		$('#titleModalKonfirmEventNews').html('Nonaktifkan News/Event');
		$('#btnKonfirmasiNewsEvent').html('Nonaktifkan');
		document.getElementById("btnKonfirmasiNewsEvent").classList.remove('btn-submit-modal');
		document.getElementById("btnKonfirmasiNewsEvent").classList.add('btn-hapus-modal');
	} else if (dataRow.status == '0') {
		$('#titleKonfirmasiEventNews').html('Apakah Anda yakin akan mengaktifkan News/Event "' + dataRow.title + '" ?');
		$('#tipeDeleteNewsEvent').val('1');
		$('#titleModalKonfirmEventNews').html('Aktifkan News/Event');
		$('#btnKonfirmasiNewsEvent').html('Aktifkan');
		document.getElementById("btnKonfirmasiNewsEvent").classList.remove('btn-hapus-modal');
		document.getElementById("btnKonfirmasiNewsEvent").classList.add('btn-submit-modal');
	}

	$('#idDeleteNewsEvent').val(dataRow.id);

	$('#modalKonfirmEventNews').modal('show');
});

$('#tableVacancy tbody').on('click', 'button.konfirmVacancy', function (e) {
	var table = $('#tableVacancy').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();

	if (dataRow.status == '1') {
		$('#titleKonfirmasiVacancy').html('Apakah Anda yakin akan menonaktifkan Vacancy "' + dataRow.job_title + '" ?');
		$('#tipeDeleteVacancy').val('0');
		$('#titleModalKonfirmVacancy').html('Nonaktifkan Vacancy');
		$('#btnKonfirmasiVacancy').html('Nonaktifkan');
		document.getElementById("btnKonfirmasiVacancy").classList.remove('btn-submit-modal');
		document.getElementById("btnKonfirmasiVacancy").classList.add('btn-hapus-modal');
	} else if (dataRow.status == '0') {
		$('#titleKonfirmasiVacancy').html('Apakah Anda yakin akan mengaktifkan Vacancy "' + dataRow.job_title + '" ?');
		$('#tipeDeleteVacancy').val('1');
		$('#titleModalKonfirmVacancy').html('Aktifkan Vacancy');
		$('#btnKonfirmasiVacancy').html('Aktifkan');
		document.getElementById("btnKonfirmasiVacancy").classList.remove('btn-hapus-modal');
		document.getElementById("btnKonfirmasiVacancy").classList.add('btn-submit-modal');
	}

	$('#idDeleteVacancy').val(dataRow.job_id);

	$('#modalKonfirmVacancy').modal('show');
});

var ui = {
	popup: {
		show: function show(type, message, url) {
			if (type == 'error') {
				Swal.fire({
					title: message,
					type: type,
					confirmButtonText: 'OK',
					allowOutsideClick: false
				});
			} else if (type == 'success') {
				if (url == 'close') {
					Swal.fire({
						title: message,
						type: type,
						confirmButtonText: 'OK',
						allowOutsideClick: false
					});
				} else {
					Swal.fire({
						title: message,
						type: type,
						confirmButtonText: 'OK',
						allowOutsideClick: false
					}).then(function () {
						window.location = url;
					});
				}
			} else if (type == 'initActivation') {
				Swal.fire({
					html: message,
					showConfirmButton: true,
					confirmButtonText: 'Submit',
					showCancelButton: true,
					cancelButtonText: 'Tutup',
					allowOutsideClick: false
				});
			} else if (type == 'warning') {
				if (url == 'close') {
					Swal.fire({
						title: message,
						type: type,
						confirmButtonText: 'OK',
						allowOutsideClick: false
					});
				} else {
					Swal.fire({
						title: message,
						type: type,
						confirmButtonText: 'OK',
						allowOutsideClick: false
					}).then(function () {
						window.location = url;
					});
				}
			} else {
				Swal.fire({
					title: message,
					type: type,
					confirmButtonText: 'OK',
					allowOutsideClick: false
				});
			}
		},
		showLoader: function showLoader() {
			$("#loading-overlay").addClass("active");
			$("body").addClass("modal-open");
		},
		hideLoader: function hideLoader() {
			$("#loading-overlay").removeClass("active");
			$("body").removeClass("modal-open");
		},
		hide: function hide(id) {
			$('.' + id).toggleClass('submitted');
		}

	},
	slide: {
		init: function init() {
			$('.carousel-control').on('click', function (e) {
				e.preventDefault();
				var control = $(this);

				var item = control.parent();

				if (control.hasClass('right')) {
					ui.slide.next(item);
				} else {
					ui.slide.prev(item);
				}
			});
			$('.slideBtn').on('click', function (e) {
				e.preventDefault();
				var control = $(this);
				var item = $("#" + control.attr('for'));

				if (item[0].id === 'page-1') {
					$('.tracking-line div').removeClass();
					$('.education-information img').attr('src', '/image/icon/homepage/track-toga-red.svg');
					$('.tracking-line div:first-child').addClass('red-line');
					$('.tracking-line div:last-child').addClass('gray-line');
				} else if (item[0].id === 'page-2') {
					$('.tracking-line div').removeClass();
					$('.other-information img').attr('src', '/image/icon/homepage/track-pin-red.svg');
					$('.tracking-line div:first-child').addClass('red-line');
					$('.tracking-line div:last-child').addClass('red-line');
				} else {
					$('.tracking-line div').removeClass();
					$('.tracking-line div:first-child').addClass('red-line');
					$('.tracking-line div:last-child').addClass('red-line');
				}

				if (control.hasClass('btn-next')) {
					ui.slide.next(item);
				} else {
					ui.slide.prev(item);
				}
			});
		},
		next: function next(item) {
			var nextItem = item.next();
			item.toggle({ 'slide': {
					direction: 'left'
				} });
			nextItem.toggle({ 'slide': {
					direction: 'right'
				} });
		},
		prev: function prev(item) {
			var prevItem = item.prev();
			item.toggle({ 'slide': {
					direction: 'right'
				} });
			prevItem.toggle({ 'slide': {
					direction: 'left'
				} });
		}
	}
};

var formrules = {
	// contoh validasi id form
	'formLoginAdmin': {
		ignore: null,
		rules: {
			'email': 'required',
			'password': 'required'
		},
		submitHandler: false,
		messages: {
			email: {
				required: 'Mohon isi email'
			},
			password: {
				required: 'Mohon isi password'
			}
		}
	},

	'formAddEventNews': {
		ignore: null,
		rules: {
			'imageNewsEvent': {
				required: true
			},
			'titleNewsEvent': {
				required: true
			},
			'tipeNewsEvent': {
				required: true
			},
			'tglMulaiNewsEvent': {
				required: true
			},
			'tglSelesaiNewsEvent': {
				required: true
			},
			'descriptionNewsEvent': {
				required: true
			}
		},
		submitHandler: false,
		messages: {
			imageNewsEvent: {
				required: 'Mohon isi Image'
			},
			titleNewsEvent: {
				required: 'Mohon isi Title'
			},
			tipeNewsEvent: {
				required: 'Mohon pilih Tipe'
			},
			tglMulaiNewsEvent: {
				required: 'Mohon isi Start Date'
			},
			tglSelesaiNewsEvent: {
				required: 'Mohon isi Start Date'
			},
			descriptionNewsEvent: {
				required: 'Mohon isi Description'
			}
		},
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#tipeNewsEvent")) {
				error.appendTo(element.parents('#tipeNewsEventDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formEditEventNews': {
		ignore: null,
		rules: {
			'titleNewsEvent': {
				required: true
			},
			'tipeNewsEvent': {
				required: true
			},
			'tglMulaiNewsEvent': {
				required: true
			},
			'tglSelesaiNewsEvent': {
				required: true
			},
			'descriptionNewsEvent': {
				required: true
			}
		},
		submitHandler: false,
		messages: {
			titleNewsEvent: {
				required: 'Mohon isi Title'
			},
			tipeNewsEvent: {
				required: 'Mohon pilih Tipe'
			},
			tglMulaiNewsEvent: {
				required: 'Mohon isi Start Date'
			},
			tglSelesaiNewsEvent: {
				required: 'Mohon isi Start Date'
			},
			descriptionNewsEvent: {
				required: 'Mohon isi Description'
			}
		},
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#tipeNewsEvent")) {
				error.appendTo(element.parents('#tipeNewsEventDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formAddVacancy': {
		ignore: null,
		rules: {
			'titleVacancy': {
				required: true
			},
			'locationVacancy': {
				required: true
			},
			'degreeVacancy': {
				required: true
			},
			'typeVacancy': {
				required: true
			},
			'workingTimeVacancy': {
				required: true
			},
			'activatedDate': {
				required: true
			},
			'majorVacancy': {
				required: true
			},
			'descriptionVacancy': {
				required: true
			}
		},
		submitHandler: false,
		messages: {
			titleVacancy: {
				required: 'Mohon isi Title'
			},
			locationVacancy: {
				required: 'Mohon Pilih Lokasi'
			},
			degreeVacancy: {
				required: 'Mohon pilih Degree'
			},
			typeVacancy: {
				required: 'Mohon pilih Tipe'
			},
			workingTimeVacancy: {
				required: 'Mohon isi Working Time'
			},
			activatedDate: {
				required: 'Mohon isi Active Date'
			},
			majorVacancy: {
				required: 'Mohon pilih Major'
			},
			descriptionVacancy: {
				required: 'Mohon isi Description'
			}
		},
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#locationVacancy")) {
				error.appendTo(element.parents('#locationVacancyDiv'));
			} else if (element.is("#degreeVacancy")) {
				error.appendTo(element.parents('#degreeVacancyDiv'));
			} else if (element.is("#typeVacancy")) {
				error.appendTo(element.parents('#typeVacancyDiv'));
			} else if (element.is("#majorVacancy")) {
				error.appendTo(element.parents('#majorVacancyDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	}

};

var validation = {
	messages: {
		required: function required() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon isi kolom ini';
		},
		minlength: function minlength(length) {
			return '<i class="fa fa-exclamation-circle"></i> Isi dengan minimum ' + length;
		},
		maxlength: function maxlength(length) {
			return '<i class="fa fa-exclamation-circle"></i> Isi dengan maximum ' + length;
		},
		max: function max(message, length) {
			return '<i class="fa fa-exclamation-circle"></i> ' + message + length;
		},
		email: function email() {
			return '<i class="fa fa-exclamation-circle"></i> Email Anda salah. Email harus terdiri dari @ dan domain';
		},
		digits: function digits() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon isi hanya dengan nomor';
		},
		numbers2: function numbers2() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon isi hanya dengan nomor';
		},
		nameCheck: function nameCheck() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung A-Z dan \'';
		},
		numericsSlash: function numericsSlash() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung 0-9 dan /';
		},
		alphaNumeric: function alphaNumeric() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung 0-9, A-Z dan spasi';
		},
		alphaNumericNS: function alphaNumericNS() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung 0-9 dan A-Z';
		},
		alpha: function alpha() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung A-Z dan spasi';
		},
		alphaNS: function alphaNS() {
			return '<i class="fa fa-exclamation-circle"></i> Nama hanya boleh mengandung A-Z';
		},
		equalTo: function equalTo() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon mengisi dengan isian yang sama';
		},
		addresscheck: function addresscheck() {
			return '<i class="fa fa-exclamation-circle"></i> Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar';
		},
		pwcheck: function pwcheck() {
			return '<i class="fa fa-exclamation-circle"></i> Input minimum 8 dan mengandung satu nomor, satu huruf kecil dan satu huruf besar';
		},
		pwcheck_alfanum: function pwcheck_alfanum() {
			return '<i class="fa fa-exclamation-circle"></i> Input antara 8-14 karakter dan harus merupakan kombinasi antara angka dan huruf';
		},
		pwcheck2: function pwcheck2() {
			return '<i class="fa fa-exclamation-circle"></i> Input antara 8-14 karakter dan harus mengandung nomor, huruf kecil, huruf besar dan simbol kecuali ("#<>\/\\=\')';
		},
		notEqual: function notEqual(message) {
			return '<i class="fa fa-exclamation-circle"></i> ' + message;
		},
		checkDate: function checkDate() {
			return '<i class="fa fa-exclamation-circle"></i> Format tanggal salah';
		},
		checkTime: function checkTime() {
			return '<i class="fa fa-exclamation-circle"></i> Format time (HH:mm) salah';
		},
		formatSeparator: function formatSeparator() {
			return '<i class="fa fa-exclamation-circle"></i> Contoh format: Ibu rumah tangga, pedagang, tukang jahit';
		},
		acceptImage: function acceptImage() {
			return '<i class="fa fa-exclamation-circle"></i> Mohon upload hanya gambar';
		},
		filesize: function filesize(size) {
			return '<i class="fa fa-exclamation-circle"></i> Max file size: ' + size;
		},
		extension: function extension(format) {
			return '<i class="fa fa-exclamation-circle"></i> Format yang Anda pilih tidak sesuai';
		},
		minValue: function minValue(_minValue) {
			return '<i class="fa fa-exclamation-circle"></i> Minimal Amount: ' + _minValue;
		},
		ageCheck: function ageCheck(age) {
			return '<i class="fa fa-exclamation-circle"></i> Minimal Age ' + age;
		},
		checkDateyyyymmdd: function checkDateyyyymmdd() {
			return '<i class="fa fa-exclamation-circle></i> Format tanggal YYYY-MM-DD, contoh: 2016-01-30';
		},
		checkDateddmmyyyy: function checkDateddmmyyyy() {
			return '<i class="fa fa-exclamation-circle></i> Format tanggal DD/MM/YYYY, contoh: 17/08/1945';
		}
	},
	addMethods: function addMethods() {
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
			alphaNumeric: "Hanya boleh mengandung 0-9, A-Z dan spasi"
			// addresscheck:"Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar"
		});

		$.validator.addMethod("maxDateRange", function (value, element, params) {
			var end = new Date(value);
			var start = new Date($(params[0]).val());
			var range = (end - start) / 86400000;
			if (!/Invalid|NaN/.test(new Date(value))) {

				return range <= params[1];
			}

			return isNaN(value) && isNaN($(params[0]).val()) || range <= params[1];
		}, 'Melebihi maksimal range {1} hari.');
		jQuery.validator.addMethod("greaterThan", function (value, element, params) {
			console.log(value, element, params);
			if (!/Invalid|NaN/.test(new Date(value))) {
				return new Date(value) > new Date($(params).val());
			}

			return isNaN(value) && isNaN($(params).val()) || Number(value) > Number($(params).val());
		}, 'Must be greater than {0}.');
		$.validator.addMethod("ageCheck", function (value, element, param) {
			var now = moment();
			//return now;
			function parseNewDate(date) {
				var split = date.split('-');
				var b = moment([split[2], split[1] - 1, split[0]]);
				return b;
			}
			var difference = now.diff(parseNewDate(value), 'years');
			return difference >= param;
		}, "Check Umur");
		jQuery.validator.addMethod("numbers2", function (value, element) {
			return this.optional(element) || /^-?(?!0)(?:\d+|\d{1,3}(?:\.\d{3})+)$/.test(value);
		}, "Mohon isi hanya dengan nomor");

		jQuery.validator.addMethod("nameCheck", function (value, element) {
			return this.optional(element) || /^([a-zA-Z' ]+)$/.test(value);
		}, "Nama hanya boleh mengandung A-Z dan '");

		jQuery.validator.addMethod("numericsSlash", function (value, element) {
			return this.optional(element) || /^([0-9/]+)$/.test(value);
		}, "Nama hanya boleh mengandung 0-9 dan /");

		jQuery.validator.addMethod("numericDot", function (value, element) {
			return this.optional(element) || /^([0-9.]+)$/.test(value);
		}, "Nama hanya boleh mengandung 0-9 dan .");

		jQuery.validator.addMethod("numericKoma", function (value, element) {
			return this.optional(element) || /^([0-9,]+)$/.test(value);
		}, "Nama hanya boleh mengandung 0-9 dan ,");

		jQuery.validator.addMethod("alphaNumeric", function (value, element) {
			return this.optional(element) || /^[a-zA-Z0-9. ]*$/.test(value);
		}, "Hanya boleh mengandung 0-9, A-Z, Titik dan spasi");

		jQuery.validator.addMethod("alphaNumericNS", function (value, element) {
			return this.optional(element) || /^[a-zA-Z0-9]*$/.test(value);
		}, "Nama hanya boleh mengandung 0-9 dan A-Z");

		jQuery.validator.addMethod("alamatFormat", function (value, element) {
			return this.optional(element) || /^[a-zA-Z0-9 .,-/]*$/.test(value);
		}, "Nama hanya boleh mengandung A-Z, 0-9, titik, koma, dan strip");

		jQuery.validator.addMethod("defaultText", function (value, element) {
			return this.optional(element) || /^[a-zA-Z0-9 ',-.:/?!&%()+=_\n]*$/.test(value);
		}, "Inputan hanya boleh mengandung A-Z, 0-9, spasi dan simbol .,:'/?!&%()-+=_");

		jQuery.validator.addMethod("defaultName", function (value, element) {
			return this.optional(element) || /^[a-zA-Z0-9 .']*$/.test(value);
		}, "Inputan hanya boleh mengandung A-Z, 0-9, spasi dan simbol .'");

		jQuery.validator.addMethod("arabic", function (value, element) {
			return this.optional(element) || /^[\u0600-\u06FF\u0750-\u077F ]*$/.test(value);
		}, "Inputan hanya boleh bahasa Arab.");

		jQuery.validator.addMethod("defaultPhone", function (value, element) {
			return this.optional(element) || /^[0-9-/']*$/.test(value);
		}, "Inputan hanya boleh mengandung 0-9, spasi, dan simbol-/'");

		jQuery.validator.addMethod("alpha", function (value, element) {
			return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
		}, "Nama hanya boleh mengandung A-Z dan spasi");

		jQuery.validator.addMethod("alphaNS", function (value, element) {
			return this.optional(element) || /^[a-zA-Z]*$/.test(value);
		}, "Nama hanya boleh mengandung A-Z");

		jQuery.validator.addMethod("addresscheck", function (value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\s).{8,}$/.test(value);
		}, "Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar");

		jQuery.validator.addMethod("pwcheck", function (value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{8,}$/.test(value);
		}, "Input harus mengandung satu nomor, satu huruf kecil dan satu huruf besar");

		jQuery.validator.addMethod("pwcheck_alfanum", function (value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*\D)(?!.*\s).{8,14}$/.test(value);
		}, "Input harus merupakan kombinasi antara angka dan huruf");

		jQuery.validator.addMethod("pwcheck2", function (value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w])(?!.*[#<>\/\\=”’"'])(?!.*\s).{8,14}$/.test(value);
		}, "Input harus mengandung satu nomor, satu huruf kecil, satu huruf besar, simbol kecuali \"#<>\/\\=\"'");

		jQuery.validator.addMethod("pwcheck3", function (value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w])(?!.*\s).{8,12}$/.test(value);
		}, "Input harus mengandung satu nomor, satu huruf kecil, satu huruf besar, simbol");

		jQuery.validator.addMethod("max", function (value, element, param) {
			var val = parseFloat(value.replace(/\./g, ""));
			return this.optional(element) || val <= param;
		}, jQuery.validator.format("Maksimal {0}"));

		jQuery.validator.addMethod("maxDec", function (value, element, param) {
			var data = value.replace(',', '.');
			return this.optional(element) || data <= param;
		}, jQuery.validator.format("Maksimal {0}"));

		jQuery.validator.addMethod("maxDecMargin", function (value, element, param) {
			var data = value.replace(',', '.');
			return this.optional(element) || data <= param;
		}, jQuery.validator.format("Margin tidak valid"));

		jQuery.validator.addMethod("notEqual", function (value, element, param) {
			return this.optional(element) || value != $(param).val();
		}, "This has to be different...");

		jQuery.validator.addMethod("notZero", function (value, element, param) {
			var val = parseFloat(value.replace(/\./g, ""));
			var nol = value.substr(0, 1);
			return this.optional(element) || val != param;
		}, jQuery.validator.format("Value Tidak Boleh 0"));

		jQuery.validator.addMethod("zeroValid", function (value, element, param) {
			var nol = value.substr(0, 1);
			var val = parseFloat(value.replace(/\./g, ""));
			if (value.length == 1) {
				return this.optional(element) || val == nol;
			} else {
				return this.optional(element) || nol != param;
			}
		}, jQuery.validator.format("Angka pertama tidak boleh 0"));

		jQuery.validator.addMethod("minValue", function (value, element, param) {
			return value >= param;
		}, "Min Value needed");

		jQuery.validator.addMethod("checkDate", function (value, element) {
			return this.optional(element) || /^(((0[1-9]|[12]\d|3[01])\-(0[13578]|1[02])\-((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\-(0[13456789]|1[012])\-((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\-02\-((19|[2-9]\d)\d{2}))|(29\-02\-((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/.test(value);
		}, "Format tanggal salah");

		jQuery.validator.addMethod("checkTime", function (value, element) {
			return this.optional(element) || /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/.test(value);
		}, "Format time (HH:mm) salah");

		jQuery.validator.addMethod("formatSeparator", function (value, element) {
			return this.optional(element) || /^[A-Za-z ]+(,[A-Za-z ]+){0,2}$/.test(value);
		}, "Contoh format: Ibu rumah tangga,pedagang,tukang jahit");

		jQuery.validator.addMethod("checkDateyyyymmdd", function (value, element) {
			return this.optional(element) || /^\d{4}-((0\d)|(1[012]))-(([012]\d)|3[01])$/.test(value);
		}, "Format tanggal YYYY-MM-DD, contoh: 2016-01-30");

		jQuery.validator.addMethod("checkDateddmmyyyy", function (value, element) {
			return this.optional(element) || /^\d{2}\/\d{2}\/\d{4}$/.test(value);
		}, "Format tanggal Bulan/Tanggal/Tahun, contoh: 06/08/1945");

		jQuery.validator.addMethod("emailType", function (value, element) {
			value = value.toLowerCase();
			return this.optional(element) || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value);
		}, "Email Anda salah. Email harus terdiri dari @ dan domain");

		jQuery.validator.addMethod("symbol", function (value, element) {
			return this.optional(element) || /^[a-zA-Z0-9!@#$%^&()]*$/.test(value);
		}, "Password hanya boleh mengandung A-Z, a-z, 0-9 dan simbol dari 0-9");
		jQuery.validator.addMethod('filesize', function (value, element, param) {
			return this.optional(element) || element.files[0].size <= param;
		}, "Ukuran Maksimal Gambar 1 MB");
	},
	validateMe: function validateMe(id, valRules, valMessages) {

		validation.addMethods();

		$("#" + id).validate({
			rules: valRules,
			messages: valMessages,
			errorPlacement: function errorPlacement(error, element) {
				var ele = element.parents('.input');
				element.parents('.inputGroup').children('.alert.error').remove();
				error.insertAfter(ele);
				error.addClass('alert error');
			},
			success: function success(error) {
				error.parents('span.alert.error').remove();
			},
			wrapper: 'span'
		});
	},
	/* CR17682 OTP START */
	validateMultiple: function validateMultiple(id, valRules, valMessages) {
		validation.addMethods();

		$("#" + id).removeData("validator");
		$("#" + id).removeData("check");
		$("#" + id).removeData("confirm");
		$("#" + id).find('input').removeClass('error');

		var validator = $("#" + id).validate({
			rules: valRules,
			messages: valMessages,
			errorPlacement: function errorPlacement(error, element) {
				var ele = element.parents('.input');
				element.parents('.inputGroup').children('.alert.error').remove();
				error.insertAfter(ele);
				error.addClass('alert error');
			},
			success: function success(error) {
				error.parents('span.alert.error').remove();
			},
			wrapper: 'span'
		});

		validator.resetForm();
	},
	/* CR17682 OTP END*/
	submitTry: function submitTry(id) {
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
		} else {
			$('.nio_select').hide();
			$('.tinymce').hide();
			if (validation.FileApiSupported()) {
				$('.added_photo').hide();
			}
			return 'vError';
		}
	},
	FileApiSupported: function FileApiSupported() {
		return !!(window.File && window.FileReader && window.FileList && window.Blob);
	}
};

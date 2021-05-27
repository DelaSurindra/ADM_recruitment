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
	grafik.init();
	ui.slide.init();
	validation.addMethods();
	// if ($('#main-wrapper').length) {
	//     other.checkSession.init();
	// }

	if ($("#bodyCandidate").length) {
		if ($('.btn-home-color').length) {
			_ajax.getData('/get-color', 'post', null, function (result) {
				$(".btn-home-color").addClass(result.value);
			});
		}
	}

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
		var id = $('#notif').data('id');
		var value = $('#notif').data('value');
		console.log(value);
		if (id == 'formAddQuestionBank') {
			$("#setTest").val(value.setTest).trigger('change');
			var testType = value.testType;
			$("#testType").val(testType).trigger('change');

			if (testType == "1") {
				var cognitive = value.subTest;
				$("#subCognitive").val(cognitive).trigger('change');
				if (cognitive == "1" || cognitive == "3" || cognitive == "4" || cognitive == "7") {
					$("#QA1").removeClass("hidden");
					$(".class-QA1").attr('disabled', false);
				} else if (cognitive == "5") {
					$("#QA2").removeClass("hidden");
					$(".class-QA2").attr('disabled', false);
				} else if (cognitive == "8") {
					$("#QA3").removeClass("hidden");
					$(".class-QA3").attr('disabled', false);
				} else if (cognitive == "2") {
					$("#QA4").removeClass("hidden");
					$(".class-QA4").attr('disabled', false);
				} else if (cognitive == "6") {
					$("#QA5").removeClass("hidden");
					$(".class-QA5").attr('disabled', false);
				} else if (cognitive == "9" || cognitive == "10" || cognitive == "12") {
					$("#QA6").removeClass("hidden");
					$(".class-QA6").attr('disabled', false);
				} else if (cognitive == "11") {
					$("#QA7").removeClass("hidden");
					$(".class-QA7").attr('disabled', false);
				}
			} else if (testType == "2") {
				$("#QA8").removeClass("hidden");
				$(".class-QA8").attr('disabled', false);
			}
		}

		ui.popup.show(status, message, url);
	}
	if ($('#notifModal').length) {
		var _status = $('#notifModal').data('status');
		var _message = $('#notifModal').data('message');
		var _url = $('#notifModal').data('url');

		if (_status == 'success') {
			$('#titleSuccessNotif').html(_message);
			$('#modalNotifForSuccess').modal('show');
		} else {
			$('#titleErrorNotif').html(_message);
			$('#modalNotifForError').modal('show');
		}
	}
	if ($('#mustLogin').length) {
		$('.modal').modal('hide');
		ui.popup.hideLoader();

		$('#modalNotifForLogin').modal('show');
	}
	if ($('#profileSaved').length) {
		$('.modal').modal('hide');
		ui.popup.hideLoader();

		$('#modalNotifProfileSaved').modal('show');
	}

	if ($('#addTest').length) {
		ui.popup.hideLoader();
		$('.modal').modal('hide');
		var _url2 = $('#addTest').data('url');
		$("#urlTest").attr('href', _url2);
		$('#modalSuccessAddTest').modal('show');
	}
});

// $('.modal').on('hidden.bs.modal', function (e) {
//     $(this).find('form')[0].reset();
//     $('.select').val('').trigger('change');

// })

//FAQ
if ($("#divFaq").length) {
	var openContent = function openContent(event, id) {
		var content = document.getElementsByClassName("content");
		for (var i = 0; i < content.length; i++) {
			content[i].style.display = "none";
		}

		var tabLinks = document.getElementsByClassName("tab-links");
		for (var _i = 0; _i < tabLinks.length; _i++) {
			tabLinks[_i].className = tabLinks[_i].className.replace(" active", "");
		}

		document.getElementById(id).style.display = "block";
		event.currentTarget.className += " active";
	};

	document.getElementById("defaultOpen").click();
}

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
								} else if (result.callback == 'applySuccess') {
									var id = result.idApply;
									$('#idApply').val(id);

									var option = [];
									var rawData = result.options;
									console.log(rawData);
									for (var i = 0; i < rawData.length; i++) {
										var item = '<option value="' + rawData[i].id + '">' + rawData[i].source + '</option>';
										option.push(item);
									}

									console.log(rawData);
									$('#modalNotifApplySuccess').modal('show');
									if ($('#tellMe').length) {
										$('#tellMe').append(option);
									}
								} else if (result.callback == 'applySuccessTellMe') {
									setInterval(function () {
										window.location = '/profile';
									}, 2000);
								} else if (result.callback == 'modal') {
									if (result.url) {
										$('#changeBtnNotif button').hide();
										$('#changeBtnNotif a').removeClass('d-none');
										$('#changeBtnNotif a').attr('href', result.url);
										$('#titleSuccessNotif').html(result.message);
										$('#modalNotifForSuccess').modal('show');
									} else {
										$('#titleSuccessNotif').html(result.message);
										$('#modalNotifForSuccess').modal('show');
									}
								}
							} else if (result.status == 'info') {
								ui.popup.hideLoader();
								// bisa menggunakan if seperti diatas
							} else if (result.status == 'warning') {
								$('.modal').modal('hide');
								ui.popup.hideLoader();
								if (result.callback == 'redirect') {
									ui.popup.show(result.status, result.message, result.url);
								} else if (result.callback == 'mustLogin') {
									$('#modalNotifForLogin').modal('show');
								} else {
									$('#titleErrorNotif').html(result.message);
									$('#modalNotifForError').modal('show');
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
		if ($('.select2-custom').length) {
			$('.select2-custom').select2({
				tags: true,
				placeholder: 'Pilih atau Input'
			});
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

		$('.goToLogin').click(function () {
			$('.modal').modal('hide');
			$('#modalLoginCandidate').modal('show');
		});

		$('.goToRegister').click(function () {
			$('.modal').modal('hide');
			$('#modalSignUpCandidate').modal('show');
		});

		$('.goToForget').click(function () {
			$('.modal').modal('hide');
			$('#modalForgetPassword').modal('show');
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
			if (form_id == 'filterSearchList' || form_id == 'filterJobList') {
				var filterSearch = $('#filterSearchList').serialize();
				var filterJob = $('#filterJobList').serialize();
				data = filterSearch + '&' + filterJob;
			}
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
};

$('.thisIconEye').click(function () {
	var item = $(this).parent().find('.form-control');
	var attr = item.attr('type');
	console.log(attr);
	if (attr == 'password') {
		item.attr('type', 'text');
	} else {
		item.attr('type', 'password');
	}
});

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
	var readFile = function readFile(input) {
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
	};

	var reset = function reset(e) {
		e.wrap('<form>').closest('form').get(0).reset();
		e.unwrap();
	};

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
}

if ($("#formEditEventNews").length) {
	var _readFile = function _readFile(input) {
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
	};

	var _reset = function _reset(e) {
		e.wrap('<form>').closest('form').get(0).reset();
		e.unwrap();
	};

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

	$(".dropzone").change(function () {
		_readFile(this);
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
		_reset(dropzone);
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
		_ajax.getData('/HR/vacancy/get-major', 'post', null, function (data) {

			e.preventDefault();
			var childDivs = document.querySelectorAll('#fieldMajorDiv' + next2 + ' span');
			// console.log(childDivs);
			var addto = "#field-syarat" + next2;
			var addRemove = "#field-syarat" + next2;
			next2 = next2 + 1;

			var dataMajor = [];

			for (var i = 0; i < data.length; i++) {
				// var option = new Option(data[i].propinsi);
				var option = '<option value="' + data[i].major + '">' + data[i].major + '</option>';
				dataMajor.push(option);
			}
			// var newIn = '<label>Syarat</label><input autocomplete="off" class="form-input bg-input form-control" id="field-syarat' + next2 + '" name="syarat[]" type="text" style="width: 93%; float: left;">';
			var newIn = '<select class="select2 min-width" id="field-syarat' + next2 + '" name="majorVacancy">' + '<option value="">-- Pilih Major --</option>' + '<option value="all">ALL</option>' + dataMajor + '</select>';
			$("#field-syarat" + next2).select2();
			var newInput = $(newIn);
			var removeBtn = '<button id="remove-syarat' + (next2 - 1) + '" class="remove-me-syarat btn-min">-</button></><div id="field-syarat">';
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
		var removeBtn = '<button type="button" id="remove-syarat' + jml + '" class="remove-me-syarat btn-min">-</button>';
		var after = $('#field-syarat' + jml).next();
		after.after(removeBtn);
		_ajax.getData('/HR/vacancy/get-major', 'post', null, function (data) {
			var dataMajor = [];

			for (var i = 0; i < data.length; i++) {
				// var option = new Option(data[i].propinsi);
				var option = '<option value="' + data[i].major + '">' + data[i].major + '</option>';
				dataMajor.push(option);
			}
			var newIn = '<select class="select2 min-width" id="field-syarat' + next + '" name="majorVacancy">' + '<option value="">-- Pilih Major --</option>' + '<option value="all">ALL</option>' + dataMajor + '</select>';
			$('#fieldMajorDiv1').append(newIn);
			$('#fieldMajorDiv1').append(btnAdd);

			$('select[name="majorVacancy"]').select2();
		});
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

if ($("#formFirstLogin").length) {
	var _readFile2 = function _readFile2(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('.photoProfileLabel').empty();
				$('.photoProfileImage').attr('src', e.target.result);
				$('.photoProfileLabel').html(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);
		}
	};

	var readFileInput = function readFileInput(input) {
		console.log(input);
		console.log(input.files);
		console.log(input.files[0]);
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				var inputLabel = $(input).parent().parent().find('.file-input-label');
				inputLabel.val();
				inputLabel.val(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);
		}
	};

	$("#gpa").mask('0.00');
	$("#photoProfile").change(function () {
		_readFile2(this);
	});

	$('.uploadCertificate').change(function (e) {
		e.preventDefault();
		readFileInput(this);
	});

	$('input[name="birthDate"]').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$('#startDateEducation').datetimepicker({
		format: 'YYYY'
	});

	$('#endDateEducation').datetimepicker({
		format: 'YYYY'
	});

	$('.btnAddListEducation').click(function (e) {
		e.preventDefault();
		$('.btnAddListEducation.large').hide();
		$('.firstBtnListEducation').removeClass('margin-right-2rem');

		_ajax.getData('master-education', 'post', null, function (data) {
			var dataUniv = [];
			var rowUniv = data.universitas;
			for (var i = 0; i < rowUniv.length; i++) {
				var option = '<option value="' + rowUniv[i].universitas + '">' + rowUniv[i].universitas + '</option>';
				dataUniv.push(option);
			}

			var dataMajor = [];
			var rowMajor = data.major;
			for (var _i2 = 0; _i2 < rowMajor.length; _i2++) {
				var option = '<option value="' + rowMajor[_i2].major + '">' + rowMajor[_i2].major + '</option>';
				dataMajor.push(option);
			}

			var option = '<div class="listStudy">' + '<hr>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">School/University<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<select name="university" class="select2-custom form-control">' + '<option selected disabled>Choose or input your university</option>' + dataUniv + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Degree<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<select name="degree" id="degree" class="select2 form-control">' + '<option value="">Choose your degree</option>' + '<option value="1">Diploma Degree</option>' + '<option value="2">Bachelor Degree</option>' + '<option value="3">Master Degree</option>' + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Faculty<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Major<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<select name="major" id="major" class="select2-custom form-control">' + '<option selected disabled>Choose or input your major</option>' + dataMajor + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Start Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="startDateEducation" name="startDateEducation">' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">End Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="endDateEducation" name="endDateEducation">' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">GPA<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="0 - 4" id="gpa" name="gpa">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Certificate of Study<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control file-input-label" placeholder="Format jpg/png maximum 2MB file" disabled>' + '<span class="btn btn-file pl-1 mb-2">' + 'Upload File <input type="file" name="certificate[]" id="certificate" class="uploadCertificate" accept=".jpg, .png, .jpeg">' + '</span>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12 removeThisEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEducation">' + '<i class="fas fa-trash mr-2" style="font-size:18px"></i> Delete the Education Data Above' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12 secondBtnEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEducation">' + '<i class="fas fa-plus mr-2" style="font-size:18px"></i> Add Another Education' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>';

			$('#listEducationCandidate').append(option);

			$('input[name="startDateEducation"]').datetimepicker({
				format: 'YYYY'
			});

			$('input[name="endDateEducation"]').datetimepicker({
				format: 'YYYY'
			});
			$("#gpa").mask('0.00');
			if ($('.select2-custom').length) {
				$('.select2-custom').select2({
					tags: true
				});
			}
			if ($('.removeThisEducation').length) {
				$('.removeThisEducation').click(function () {
					console.log('click');
					$(this).parent().parent().remove();

					if ($('.listStudy').length < 2) {
						$('.btnAddListEducation.large').show();
					}
				});
			}
			if ($('.secondBtnEducation').length) {
				$('.secondBtnEducation').click(function () {
					$(this).remove();
					$('.btnAddListEducation.large').click();
				});
			}

			function readFileInput(input) {
				console.log(input);
				console.log(input.files);
				console.log(input.files[0]);
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

			$('.uploadCertificate').change(function (e) {
				e.preventDefault();
				readFileInput(this);
			});
		});
	});
}

if ($('#formEditPersonalInformation').length) {
	var _readFile3 = function _readFile3(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('.photoProfileLabel').empty();
				$('.photoProfileImage').attr('src', e.target.result);
				$('.photoProfileLabel').html(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);
		}
	};

	$("#photoProfile").change(function () {
		_readFile3(this);
	});

	$('input[name="birthDate"]').datetimepicker({
		format: 'DD-MM-YYYY'
	});
}

if ($("#formEditEducationInformation").length) {
	var _readFileInput = function _readFileInput(input) {
		console.log(input);
		console.log(input.files);
		console.log(input.files[0]);
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				var inputLabel = $(input).parent().parent().find('.file-input-label');
				inputLabel.val();
				inputLabel.val(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);
		}
	};

	$('.uploadCertificate').change(function (e) {
		e.preventDefault();
		_readFileInput(this);
	});

	$('#startDateEducation').datetimepicker({
		format: 'YYYY'
	});

	$('#endDateEducation').datetimepicker({
		format: 'YYYY'
	});

	$('.btnAddListEducation').click(function (e) {
		e.preventDefault();
		$('.btnAddListEducation.large').hide();
		$('.firstBtnListEducation').removeClass('margin-right-2rem');

		_ajax.getData('master-education', 'post', null, function (data) {
			var dataUniv = [];
			var rowUniv = data.universitas;
			for (var i = 0; i < rowUniv.length; i++) {
				var option = '<option value="' + rowUniv[i].universitas + '">' + rowUniv[i].universitas + '</option>';
				dataUniv.push(option);
			}

			var dataMajor = [];
			var rowMajor = data.major;
			for (var _i3 = 0; _i3 < rowMajor.length; _i3++) {
				var option = '<option value="' + rowMajor[_i3].major + '">' + rowMajor[_i3].major + '</option>';
				dataMajor.push(option);
			}

			var option = '<div class="listStudy">' + '<hr>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">School/University<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<select name="university" class="select2-custom form-control">' + '<option selected disabled>Choose or input your university</option>' + dataUniv + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Degree<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<select name="degree" id="degree" class="select2 form-control">' + '<option value="">Choose your degree</option>' + '<option value="1">Diploma Degree</option>' + '<option value="2">Bachelor Degree</option>' + '<option value="3">Master Degree</option>' + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Faculty<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Major<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<select name="major" id="major" class="select2-custom form-control">' + '<option selected disabled>Choose or input your major</option>' + dataMajor + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Start Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="startDateEducation" name="startDateEducation">' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">End Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="endDateEducation" name="endDateEducation">' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">GPA<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control" placeholder="0 - 4" id="gpa" name="gpa">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12">' + '<div class="form-group">' + '<label for="">Certificate of Study<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<input type="text" class="form-control file-input-label" placeholder="Format jpg/png maximum 2MB file" disabled>' + '<span class="btn btn-file pl-1 mb-2">' + 'Upload File <input type="file" name="certificate[]" id="certificate" class="uploadCertificate" accept=".jpg, .png, .jpeg">' + '</span>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-6 col-md-12 removeThisEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEducation">' + '<i class="fas fa-trash mr-2" style="font-size:18px"></i> Delete the Education Data Above' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-6 col-md-12 secondBtnEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-11 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEducation">' + '<i class="fas fa-plus mr-2" style="font-size:18px"></i> Add Another Education' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>';

			$('#listEducationCandidate').append(option);

			$('input[name="startDateEducation"]').datetimepicker({
				format: 'YYYY'
			});
			$("#gpa").mask('0.00');
			$('input[name="endDateEducation"]').datetimepicker({
				format: 'YYYY'
			});

			if ($('.select2-custom').length) {
				$('.select2-custom').select2({
					tags: true

				});
			}
			if ($('.removeThisEducation').length) {
				$('.removeThisEducation').click(function () {
					console.log('click');
					$(this).parent().parent().remove();

					if ($('.listStudy').length < 2) {
						$('.btnAddListEducation.large').show();
					}
				});
			}
			if ($('.secondBtnEducation').length) {
				$('.secondBtnEducation').click(function () {
					$(this).remove();
					$('.btnAddListEducation.large').click();
				});
			}

			function readFileInput(input) {
				console.log(input);
				console.log(input.files);
				console.log(input.files[0]);
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

			$('.uploadCertificate').change(function (e) {
				e.preventDefault();
				readFileInput(this);
			});
		});
	});
}

if ($("#formEditOtherInformation").length) {
	var _readFileInput2 = function _readFileInput2(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				var inputLabel = $(input).parent().parent().find('.file-input-label');
				inputLabel.val();
				inputLabel.val(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);
		}
	};

	$('#coverLetter').change(function (e) {
		e.preventDefault();
		_readFileInput2(this);
	});

	$('#resume').change(function (e) {
		e.preventDefault();
		_readFileInput2(this);
	});

	$('#portofolio').change(function (e) {
		e.preventDefault();
		_readFileInput2(this);
	});

	$("#deleteCoverLetter").click(function () {
		$("#coverLetterLink").val('');
	});

	$("#deleteResume").click(function () {
		$("#resumeLink").val('');
	});

	$("#deletePortofolio").click(function () {
		$("#portofolioLink").val('');
	});
}

$("#loadNews").click(function (e) {
	e.preventDefault();
	var value = this.value;
	_ajax.getData('/news-get-more', 'post', { value: value }, function (data) {
		var count = parseInt(value) + 5;
		$("#loadNews").val(count);
		if (data.length) {
			for (var i = 0; i < data.length; i++) {
				var id = encodeURIComponent(window.btoa(data[i]['id']));
				$("#divNews").append('<a href="/news-event/detail/' + id + '" class="news-ahref">' + '<div class="card-list-news">' + '<div class="card-body-news">' + '<div class="row">' + '<div class="col-lg-4 col-md-12">' + '<img src="' + baseImage + '/' + data[i]['image'] + '" class="img-news">' + '</div>' + '<div class="col-lg-8 col-md-12 mt-5">' + '<div class="div-right-news">' + '<div class="d-flex">' + '<div class="badge-news mb-3">News</div>' + '<p class="align-items-center p-title-news">' + data[i]["tanggal"] + '</p>' + '</div>' + '<h4 class="news-page-title">' + data[i]["title"] + '</h4>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '</a>');
			}
		} else {
			$("#loadNews").addClass('hidden');
		}
	});
});

$("#loadEvent").click(function (e) {
	e.preventDefault();
	var value = this.value;
	_ajax.getData('/event-get-more', 'post', { value: value }, function (data) {
		var count = parseInt(value) + 5;
		$("#loadEvent").val(count);
		if (data.length) {
			for (var i = 0; i < data.length; i++) {
				var id = encodeURIComponent(window.btoa(data[i]['id']));
				$("#divNews").append('<a href="/news-event/detail/' + id + '" class="news-ahref">' + '<div class="card-list-news">' + '<div class="card-body-news">' + '<div class="row">' + '<div class="col-lg-4 col-md-12">' + '<img src="' + baseImage + '/' + data[i]['image'] + '" class="img-news">' + '</div>' + '<div class="col-lg-8 col-md-12 mt-5">' + '<div class="div-right-news">' + '<div class="d-flex">' + '<div class="badge-news mb-3">Event</div>' + '<p class="align-items-center p-title-news">' + data[i]["tanggal"] + '</p>' + '</div>' + '<h4 class="news-page-title">' + data[i]["title"] + '</h4>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '</a>');
			}
		} else {
			$("#loadEvent").addClass('hidden');
		}
	});
});

if ($('#filterJobList').length) {
	$('.job-type-select').click(function () {
		if ($(this).hasClass('not-active')) {
			if ($(this).hasClass('fulltime-badge')) {
				$('#checkFilterFulltime').prop('checked', true);
			} else if ($(this).hasClass('internship-badge')) {
				$('#checkFilterInternship').prop('checked', true);
			}
			$(this).removeClass('not-active');
		} else {
			if ($(this).hasClass('fulltime-badge')) {
				$('#checkFilterFulltime').prop('checked', false);
			} else if ($(this).hasClass('internship-badge')) {
				$('#checkFilterInternship').prop('checked', false);
			}
			$(this).addClass('not-active');
		}
	});
}

var lastArray = function lastArray(array, n) {
	if (array == null) return void 0;
	if (n == null) return array[array.length - 1];
	return array.slice(Math.max(array.length - n, 0));
};

$('.loadMoreJob').click(function () {
	var list = $('.card-job-list').length;
	var value = list + 3;

	_ajax.getData('/job-more', 'post', { value: value }, function (data) {
		if (data.length >= value) {
			$('.loadMoreJob').hide();
		}

		var newData = lastArray(data, 3);

		for (var i = 0; i < newData.length; i++) {
			var id = encodeURIComponent(window.btoa(newData[i]['job_id']));

			if (newData[i]['type'] == 1) {
				var type = '<div class="fulltime-badge mb-3">Full-time</div>';
			} else if (newData[i]['type'] == 2) {
				var type = '<div class="internship-badge mb-3">Internship</div>';
			}

			var option = '<div class="col-lg-4 col-md-6 col-sm-12 my-3">' + '<div class="card card-job-list">' + '<a href="/job/detail/' + id + '" class="text-decoration-none">' + '<div class="card-body">' + type + '<label class="label-no-margin mb-1">' + newData[i]['lokasi'] + ', Indonesia</label>' + '<h4 class="candidate-page-subtitle mb-3">' + newData[i]['job_title'] + '</h4>' + '<div class="d-flex align-items-center job-list-detail mb-1">' + '<div class="icon-wrapper">' + '<img src="/image/icon/homepage/icon-graduate.svg" alt="icon">' + '</div>' + '<p class="text">' + newData[i]['education_req'] + '</p>' + '</div>' + '<div class="d-flex align-items-center job-list-detail">' + '<div class="icon-wrapper">' + '<img src="/image/icon/homepage/icon-book.svg" alt="icon">' + '</div>' + '<p class="text">' + newData[i]['major'] + '</p>' + '</div>' + '</div>' + '</a>' + '</div>' + '</div>';

			$('#loadJobs').append(option);
		}
	});
});

if ($('#filterCandidate').length) {

	$('#usia').mask('0000', {
		reverse: true
	});

	$('#tahunLulus').mask('0000', {
		reverse: true
	});

	$('#ipkMinimum').mask('0.00', {
		reverse: true
	});
}

if ($("#formEditCandidate").length) {
	$(".year_date").datetimepicker({
		format: 'YYYY'
	});
}

if ($("#detailCandidate1").length) {
	$("#copyLinkedin").click(function () {
		var copyText = document.getElementById("linkedin");
		copyText.select();
		copyText.setSelectionRange(0, 99999);
		document.execCommand("copy");
	});
}

if ($("#formAddQuestionBank").length) {
	var _readFile4 = function _readFile4(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				// $('.photoProfileLabel').empty();
				// $('.photoProfileImage').attr('src', e.target.result);
				// $('.photoProfileLabel').html(input.files[0].name);
				var idSpan = $(input).parent().parent().find('.btn-file');
				$("#" + idSpan.attr('id')).addClass('btn-file-right');
				var inputLabel = $(input).parent().parent().find('.img-preview');
				// console.log(idSpan.attr('id'), inputLabel);
				inputLabel.val();
				inputLabel.removeClass('hidden');
				inputLabel.attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	};

	$("#testType").change(function () {
		$(".btn-answer").removeClass('btn-answer-active');
		$("textarea").val("");
		$('#testType').select2('close');
		$(".class-all").attr('disabled', true);
		$(".div-all").addClass('hidden');
		var data = $("#testType").val();
		if (data == "1") {
			$("#subCognitiveDiv").removeClass('hidden');
			$("#subCognitiveDiv").addClass('d-flex');
			$("#subCognitiveDiv").addClass('flex-column');
			$("#subCognitive").attr('disabled', false);
			$("#subInventory").attr('disabled', true);
		} else {
			$("#subCognitive").val("").trigger('change');
			$("#QA8").removeClass("hidden");
			$(".class-QA8").attr('disabled', false);
			$("#subCognitiveDiv").removeClass('d-flex');
			$("#subCognitiveDiv").removeClass('flex-column');
			$("#subCognitiveDiv").addClass('hidden');
			$("#subCognitive").attr('disabled', true);
			$("#subInventory").attr('disabled', false);
		}
	});

	// function dropdown sub test
	$("#subCognitive").change(function (e) {
		$("textarea").val("");
		$(".btn-answer").removeClass('btn-answer-active');
		e.preventDefault;
		var value = this.value;
		$(".class-all").attr('disabled', true);
		$(".div-all").addClass('hidden');

		if (value == "1" || value == "3" || value == "4" || value == "7") {
			$("#QA1").removeClass("hidden");
			$(".class-QA1").attr('disabled', false);
		} else if (value == "5") {
			$("#QA2").removeClass("hidden");
			$(".class-QA2").attr('disabled', false);
		} else if (value == "8") {
			$("#QA3").removeClass("hidden");
			$(".class-QA3").attr('disabled', false);
		} else if (value == "2") {
			$("#QA4").removeClass("hidden");
			$(".class-QA4").attr('disabled', false);
		} else if (value == "6") {
			$("#QA5").removeClass("hidden");
			$(".class-QA5").attr('disabled', false);
		} else if (value == "9" || value == "10" || value == "12") {
			$("#QA6").removeClass("hidden");
			$(".class-QA6").attr('disabled', false);
		} else if (value == "11") {
			$("#QA7").removeClass("hidden");
			$(".class-QA7").attr('disabled', false);
		}
	});

	$(".btn-QA1").click(function (e) {
		$(".btn-QA1").removeClass('btn-answer-active');
		e.preventDefault;
		$("#" + this.id).addClass("btn-answer-active");
		$("#chooseQA1").val(this.value);
	});

	$(".btn-QA2").click(function (e) {
		$(".btn-QA2").removeClass('btn-answer-active');
		e.preventDefault;
		$("#" + this.id).addClass("btn-answer-active");
		$("#chooseQA2").val(this.value);
	});

	$(".btn-QA3").click(function (e) {
		$(".btn-QA3").removeClass('btn-answer-active');
		e.preventDefault;
		$("#" + this.id).addClass("btn-answer-active");
		$("#chooseQA3").val(this.value);
	});

	$(".btn-QA4").click(function (e) {
		$(".btn-QA4").removeClass('btn-answer-active');
		e.preventDefault;
		$("#" + this.id).addClass("btn-answer-active");
		$("#chooseQA4").val(this.value);
	});

	$(".btn-QA5").click(function (e) {
		$(".btn-QA5").removeClass('btn-answer-active');
		e.preventDefault;
		$("#" + this.id).addClass("btn-answer-active");
		$("#chooseQA5").val(this.value);
	});

	$(".btn-QA6").click(function (e) {
		$(".btn-QA6").removeClass('btn-answer-active');
		e.preventDefault;
		$("#" + this.id).addClass("btn-answer-active");
		$("#chooseQA6").val(this.value);
	});

	$(".btn-QA7").click(function (e) {
		$(".btn-QA7").removeClass('btn-answer-active');
		e.preventDefault;
		$("#" + this.id).addClass("btn-answer-active");
		$("#chooseQA7").val(this.value);
	});

	$(".upload-image").change(function () {
		// alert(this.id);
		if (this.id == "imgNumeric1") {
			$("#questionQA2").attr('required', false);
		}
		_readFile4(this);
	});

	$('#questionQA2').bind('keyup', function (e) {
		// console.log(this.value)
		if (this.value == "") {
			$("#imgNumeric1").attr('required', true);
		} else {
			$("#imgNumeric1").attr('required', false);
		}
	});

	$("#save").click(function (e) {
		$("#btnValue").val(this.value);
	});

	$("#continue").click(function (e) {
		$("#btnValue").val(this.value);
	});
}

$(".btn-delete-question").click(function () {
	var value = this.value;
	// alert(value)
	var number = $("#numberQuestion" + value).val();
	var id = $("#idQuestion" + value).val();
	var url = $("#urlQuestion" + value).val();

	$("#titleKonfirmasiQuestion").html('Are you sure for delete Question Bank number ' + number);
	$("#idDeleteQuestion").val(id);
	$("#urlDeleteQuestion").val(url);

	$("#modalKonfirmQuestion").modal('show');
});

if ($("#formAddTest").length) {
	$('#dateTest').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$("#addAlternative").click(function () {
		$("#btnAddAlternative").addClass('hidden');
		$("#modalAlternativeTest").modal('show');
		for (var i = 0; i < $(".id-check").length; i++) {
			var check = $(".id-check")[i];
			$("#alternative_" + check.value).prop('checked', true);
			$("#alternative_" + check.value).addClass("checkActive");
		}
		$("#btnAddAlternative").click(function () {
			for (var index = 0; index < $('.title-date').length; index++) {
				var x = $('.title-date')[index];
				var count = parseInt(index) + 1;
				$(x).html('Date Test Alternative ' + count);
			}
			$(".div-alternatif").removeClass("hidden");
			$(".id-alternatif-test").attr('disabled', false);
			$("#modalAlternativeTest").modal('hide');
			var count = $("#countTest").val();
			if (count == "3") {
				$("#addAlternative").addClass("hidden");
			} else {
				$("#addAlternative").removeClass("hidden");
			}
		});
	});

	$(".btn-delete-alternatif").click(function () {
		$("#alternative_" + this.value).prop('checked', false);
		$("#setAlternatif" + this.value).remove();
		var count = $("#countTest").val();
		jumlah = parseInt(count) - 1;
		$("#countTest").val(jumlah);
		$("#addAlternative").removeClass("hidden");
		$("#alternative_" + this.value).removeClass("checkActive");
		$('.check').attr('disabled', false);
	});
}

if ($("#btnInfoLatlong").length) {
	var title = "<div class='row'>" + "<div class='col-md-12'>" + "<h4 class='title-popover'>How to find latitude and longitude:</h4>" + "</div>" + "</div>";
	var content = "<div class='row mb-4'>" + "<div class='col-md-12'>" + "<p class='content-popover mb-0'>1. On your computer, open " + "<a href='https://www.google.com/maps/'>Google Maps.&nbsp <img src='/image/icon/main/icon_google_map.svg'></a>" + "</p>" + "<p class='content-popover mb-0'>2. Right-click the place or area on the map.</p>" + "<p class='content-popover mb-0'>3.  Select the latitude and longitude, this will automatically copy the coordinates.</p>" + "</div>" + "</div>" + "<div class='row'>" + "<div class='col-md-12'>" + "<p class='content-popover mb-0'><span class='span-popover'>ex: </span>-6.376030911994399, 106.89830424039924</p>" + "</div>" + "</div>";
	$('#btnInfoLatlong').popover({
		html: true,
		title: title,
		content: content,
		placement: "top"
	});
}

if ($('.choose-candidate').length) {
	$(".choose-candidate").click(function () {
		var column = [{ 'data': null }, { 'data': 'submit_date' }, { 'data': 'name' }, { 'data': 'age' }, { 'data': 'gelar' }, { 'data': 'universitas' }, { 'data': 'fakultas' }, { 'data': 'jurusan' }, { 'data': 'gpa' }, { 'data': 'graduate_year' }, { 'data': 'job_position' }, { 'data': 'area' }];

		columnDefs = [{
			"targets": 0,
			"orderable": false,
			"data": "job_application_id",
			"render": function render(data, type, full, meta) {
				var data = '<input class="choose" type="checkbox" id="candidate_' + full.kandidat_id + '">';
				return data;
			}
		}, {
			"targets": 2,
			"data": "name",
			"render": function render(data, type, full, meta) {
				var id = encodeURIComponent(window.btoa(full.kandidat_id));
				var image = '';
				if (full.foto_profil == null || full.foto_profil == "") {
					image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
				} else {
					image = baseImage + '/' + full.foto_profil;
				}
				var data = '<a href="/HR/candidate/detail-candidate/' + id + '" class="name-candidate"><img class="img-candidate" src="' + image + '" />' + '&nbsp' + full.name + '</a';
				return data;
			}
		}, {
			"targets": 4,
			"data": "gelar",
			"render": function render(data, type, full, meta) {
				var data = '';
				if (full.gelar == "1") {
					data = "D3";
				} else if (full.gelar == "2") {
					data = "S1";
				} else {
					data = "S2";
				}
				return data;
			}
		}];

		table.serverSide('tableChooseCandidate', column, 'HR/test/list-candidate-pick', null, columnDefs);

		$("#tableChooseCandidate tbody").on('click', 'input', function (e) {
			var table = $('#tableChooseCandidate').DataTable();
			var dataRow = table.row($(this).closest('tr')).data();
			var count = $("#countChoose").val();
			var jumlah = "";
			if ($("#candidate_" + dataRow.kandidat_id).is(":checked")) {
				jumlah = parseInt(count) + 1;
				$("#countChoose").val(jumlah);
				$("#divChooseCandidate").append('<input type="hidden" class="choose-candidate-list" id="input_' + dataRow.kandidat_id + '" name="idCandidate[]" value="' + dataRow.kandidat_id + "_" + dataRow.job_application_id + '">');
			} else {
				jumlah = parseInt(count) - 1;
				$("#countChoose").val(jumlah);
				$("#input_" + dataRow.kandidat_id).remove();
			}
			$("#textItem").html(jumlah + " item selected");
			if (jumlah == 0) {
				$("#btnAddCandidateTest").addClass('hidden');
			} else {
				$("#btnAddCandidateTest").removeClass('hidden');
			}
		});

		$("#modalChooseCandidate").modal('show');
	});
}

if ($("#modalSetTest").length) {

	$(".btn-set-test").click(function (e) {
		e.preventDefault();
		$(".btn-set-test").removeClass('btn-set-active');
		var btn = $("#" + this.id);
		var value = btn.val();
		$(btn).addClass("btn-set-active");
		$("#valueSet").val(value);
	});
}

if ($(".btn-reschedule").length) {
	$(".btn-reschedule").click(function (e) {
		e.preventDefault();
		$(".btn-reschedule").removeClass('btn-reschedule-active');
		var btn = $("#" + this.id);
		var value = btn.val();
		$(btn).addClass("btn-reschedule-active");
		$("#idReschedule").val(value);
	});
}

if ($(".btn-confirm").length) {
	$(".btn-confirm").click(function () {
		$("#valueBtn").val(this.value);
	});
}

if ($("#formAddInterview").length) {
	$("#typeInterview").change(function () {
		var value = $("#typeInterview").val();
		if (value == "5" || value == "6") {
			$("#lastInterviewDiv").addClass("hidden");
		} else {
			$("#lastInterviewDiv").removeClass("hidden");
		}
		$("#lastInterview").prop('checked', false);
	});
	$('#dateInterview').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$("#btnAddCandidateInterview").click(function () {
		$("#modalChooseInterview").modal('hide');
		$("#cardAddCandidate").addClass("hidden");
		$("#cardListCandidate").removeClass("hidden");
	});
}

if ($("#updateStatusInterview").length) {
	$("#statusInterview").change(function () {
		var status = $("#statusInterview").val();
		if (status == "2") {
			$("#divFail").addClass("hidden");
		} else {
			$("#divFail").removeClass("hidden");
		}
	});
}

if ($("#formRescheduleInterview").length) {
	$('#dateStart').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$('#dateEnd').datetimepicker({
		format: 'DD-MM-YYYY'
	});
}

if ($("#btnAccInterview").length) {
	var maxDate = $("#maxDate").val();
	var minDate = $("#minDate").val();
	$('#dateAccInterview').datetimepicker({
		format: 'DD-MM-YYYY',
		maxDate: maxDate,
		minDate: minDate
	});
	$('#dateAccInterview').datetimepicker('show');
}

if ($("#formAddMaster").length) {
	$("#typeMaster").change(function () {
		var type = $("#typeMaster").val();
		if (type == "1") {
			$("#divMajor").addClass("hidden");
			$("#nameMajor").attr('disabled', true);

			$("#divUniv").removeClass("hidden");
			$("#nameUniv").attr('disabled', false);
			$("#nameUniv").val('');
		} else {
			$("#divMajor").removeClass("hidden");
			$("#nameMajor").attr('disabled', false);
			$("#nameMajor").val('');

			$("#divUniv").addClass("hidden");
			$("#nameUniv").attr('disabled', true);
		}
	});
}

if ($("#formAddCandidate").length) {
	var _readFile5 = function _readFile5(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('.photoProfileLabel').empty();
				$('.photoProfileImage').attr('src', e.target.result);
				$('.photoProfileLabel').html(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);
		}
	};

	var _readFileInput3 = function _readFileInput3(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				var inputLabel = $(input).parent().parent().find('.file-input-label');
				inputLabel.val();
				inputLabel.val(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);
		}
	};

	$("#photoProfile").change(function () {
		_readFile5(this);
	});

	$('.uploadCertificate').change(function (e) {
		e.preventDefault();
		_readFileInput3(this);
	});

	$('#birthDate').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$('#startDateEducation').datetimepicker({
		format: 'YYYY'
	});

	$('#endDateEducation').datetimepicker({
		format: 'YYYY'
	});

	$('.btnAddListEducation').click(function (e) {
		_ajax.getData('/HR/candidate/get-master', 'post', null, function (data) {

			e.preventDefault();
			$('.btnAddListEducation.large').hide();
			$('.firstBtnListEducation').removeClass('margin-right-2rem');

			var dataMajor = [];

			for (var i = 0; i < data.major.length; i++) {
				// var option = new Option(data[i].propinsi);
				var opt = '<option value="' + data.major[i].major + '">' + data.major[i].major + '</option>';
				dataMajor.push(opt);
			}

			var dataUniv = [];

			for (var i = 0; i < data.universitas.length; i++) {
				// var option = new Option(data[i].propinsi);
				var opt = '<option value="' + data.universitas[i].universitas + '">' + data.universitas[i].universitas + '</option>';
				dataUniv.push(opt);
			}

			var option = '<div class="listStudy">' + '<hr>' + '<div class="row">' + '<div class="col-lg-5 col-md-12">' + '<div class="form-group">' + '<label for="">School/University<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-12 col-md-12">' + '<select name="university" class="select2-custom form-control">' + '<option selected disabled>Choose or input your university</option>' + dataUniv + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-5 col-md-12">' + '<div class="form-group">' + '<label for="">Degree<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-12 col-md-12">' + '<select name="degree" id="degree" class="select2 form-control" required>' + '<option value="">Choose your degree</option>' + '<option value="1">Diploma Degree</option>' + '<option value="2">Bachelor Degree</option>' + '<option value="3">Master Degree</option>' + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-5 col-md-12">' + '<div class="form-group">' + '<label for="">Faculty<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-12 col-md-12">' + '<input type="text" name="faculty" id="faculty" class="form-control" placeholder="Faculty" required>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-5 col-md-12">' + '<div class="form-group">' + '<label for="">Major<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-12 col-md-12">' + '<select name="major" id="major" class="select2-custom form-control">' + '<option selected disabled>Choose or input your major</option>' + dataMajor + '</select>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-5 col-md-12">' + '<div class="form-group">' + '<label for="">Start Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-12 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="startDateEducation" name="startDateEducation" required>' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-5 col-md-12">' + '<div class="form-group">' + '<label for="">End Date<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-12 col-md-12 with-icon">' + '<input type="text" class="form-control" placeholder="Choose date" id="endDateEducation" name="endDateEducation" required>' + '<img src="/image/icon/homepage/icon-calender-input.svg" class="this-icon" alt="icon">' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-5 col-md-12">' + '<div class="form-group">' + '<label for="">GPA<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-12 col-md-12">' + '<input type="text" class="form-control" placeholder="0 - 4" id="gpa" name="gpa" required>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-5 col-md-12">' + '<div class="form-group">' + '<label for="">Certificate of Study<span class="required-sign">*</span></label>' + '<div class="row">' + '<div class="col-lg-12 col-md-12">' + '<input type="text" class="form-control file-input-label" placeholder="Format jpg/png maximum 2MB file" disabled>' + '<span class="btn btn-file pl-1 mb-2">' + 'Upload File <input type="file" name="certificate[]" id="certificate" class="uploadCertificate" accept=".jpg, .png, .jpeg">' + '</span>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="row">' + '<div class="col-lg-5 col-md-12 removeThisEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-12 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEducation">' + '<i class="fas fa-trash mr-2" style="font-size:18px"></i> Delete the Education Data Above' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '<div class="col-lg-5 col-md-12 secondBtnEducation">' + '<div class="form-group">' + '<div class="row">' + '<div class="col-lg-12 col-md-12">' + '<button type="button" class="btn btn-white btn-block btnAddListEducation">' + '<i class="fas fa-plus mr-2" style="font-size:18px"></i> Add Another Education' + '</button>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>' + '</div>';

			$('#listEducationCandidate').append(option);
			$("#gpa").mask('0.00');
			if ($('.select2-custom').length) {
				$('.select2-custom').select2({
					tags: true,
					placeholder: 'Pilih atau Input'
				});
			}

			$('input[name="startDateEducation"]').datetimepicker({
				format: 'YYYY'
			});

			$('input[name="endDateEducation"]').datetimepicker({
				format: 'YYYY'
			});

			if ($('.removeThisEducation').length) {
				$('.removeThisEducation').click(function () {
					console.log('click');
					$(this).parent().parent().remove();

					if ($('.listStudy').length < 2) {
						$('.btnAddListEducation.large').show();
					}
				});
			}
			if ($('.secondBtnEducation').length) {
				$('.secondBtnEducation').click(function () {
					$(this).remove();
					$('.btnAddListEducation.large').click();
				});
			}

			function readFileInput(input) {
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

			$('.uploadCertificate').change(function (e) {
				e.preventDefault();
				readFileInput(this);
			});
		});
	});
}

if ($("#addBulkCandidate").length) {
	var _readFileInput4 = function _readFileInput4(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				var inputLabel = $(input).parent().parent().find('.file-input-label');
				inputLabel.html("");
				inputLabel.html(input.files[0].name);
			};

			reader.readAsDataURL(input.files[0]);
		}
	};

	$('#fileBulk').change(function (e) {
		e.preventDefault();
		_readFileInput4(this);
	});
}

if ($("#filterReport").length) {

	$('#dateStartReport').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$('#dateEndReport').datetimepicker({
		format: 'DD-MM-YYYY'
	});

	$("#categoryReport").change(function () {
		var tipe = $("#categoryReport").val();

		if (tipe == "5" || tipe == "7") {
			$(".row-date").addClass("hidden");
		} else {
			$(".row-date").removeClass("hidden");
		}

		if (tipe == "8") {
			$(".row-kota-univ").removeClass('hidden');
		} else {
			$(".row-kota-univ").addClass('hidden');
		}
	});
}

if ($("#formAddBanner").length) {
	var _readFileInput5 = function _readFileInput5(input) {
		if (input.files && input.files[0]) {
			$("#btnAddBanner").attr('disabled', false);
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
	};

	$('#fileBanner').change(function (e) {
		e.preventDefault();
		_readFileInput5(this);
	});
}

if ($("#formEditBanner").length) {
	var _readFileInput6 = function _readFileInput6(input) {
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
	};

	$('#fileBannerEdit').change(function (e) {
		e.preventDefault();
		_readFileInput6(this);
	});
}

if ($(".btn-banner").length) {
	$(".edit-banner").click(function (e) {
		var id = this.value;
		var image = $("#valueBanner" + id).val();
		$("#idBanner").val(id);
		$("#oldBanner").val(image);
		$("#imageBanner").attr('src', baseImage + image);
		$("#modalEditBanner").modal('show');
	});

	$(".delete-banner").click(function (e) {
		var id = this.value;
		var image = $("#valueBanner" + id).val();
		$("#idDeleteBanner").val(id);
		$("#imageDelete").attr('src', baseImage + image);
		$("#modalDeleteBanner").modal('show');
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
			var column = [{ 'data': 'created_at' }, { 'data': 'job_title' }, { 'data': 'type' }, { 'data': 'degree' }, { 'data': 'major' }, { 'data': 'work_time' }, { 'data': 'active_date' }, { 'data': 'status' }];

			columnDefs = [{
				"targets": 2,
				"data": "type",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.type == 1) {
						data = 'Full Time';
					} else {
						data = 'Intership';
					}
					return data;
				}
			}, {
				"targets": 3,
				"data": "degree",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.degree == 1) {
						data = 'D3';
					} else if (full.degree == 2) {
						data = 'S1';
					} else {
						data = "S2";
					}
					return data;
				}
			}, {
				"targets": 7,
				"data": "status",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status == 1) {
						data = '<strong>Publised</strong>';
					} else {
						data = "<p>Deaktif</p>";
					}
					return data;
				}
			}, {
				"targets": 8,
				"data": "id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.job_id));
					var konfirm = '';
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/vacancy/detail-vacancy/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Vacancy"> Edit&nbsp</a></button>';
					if (full.status == '1') {
						konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/deactive.svg" title="Deaktif Vacancy">Deactive</button>';
					} else {
						konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/active.svg" title="Aktifkan Vacancy">Active</button>';
					}
					var hasil = data + konfirm;
					return hasil;
				}
			}];

			table.serverSide('tableVacancy', column, 'HR/vacancy/list-vacancy', null, columnDefs);
		}

		if ($('#tableTest').length) {
			// $("#modalSuccessAddTest").modal('show')
			var column = [{ 'data': 'created_at' }, { 'data': 'event_id' }, { 'data': 'date_test' }, { 'data': 'time' }, { 'data': 'city' }, { 'data': 'location' }, { 'data': 'set_test' }, { 'data': 'status_test' }];

			columnDefs = [{
				"targets": 1,
				"data": "event_id",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					var data = '<a href="/HR/test/detail-test/' + id + '" class="name-candidate">' + full.event_id + '</a';
					return data;
				}
			}, {
				"targets": 7,
				"data": "status_test",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status_test == 1 || full.status_test == 0) {
						data = '<strong>New</strong>';
					} else if (full.status_test == 2) {
						data = '<strong>In Progress</strong>';
					} else {
						data = "<p>Closed</p>";
					}
					return data;
				}
			}, {
				"targets": 8,
				"data": "id",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					var konfirm = '';
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/test/edit-test/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Test">&nbsp Edit</a></button>';
					return data;
				}
			}];

			table.serverSide('tableTest', column, 'HR/test/list-test', null, columnDefs);
		}

		if ($('#tableAlternatifTest').length) {
			var column = [{ 'data': 'created_at' }, { 'data': 'event_id' }, { 'data': 'date_test' }, { 'data': 'time' }, { 'data': 'city' }, { 'data': 'location' }, { 'data': 'set_test' }, { 'data': 'status_test' }];

			columnDefs = [{
				"targets": 0,
				"data": "id",
				"render": function render(data, type, full, meta) {
					var data = '<input class="check" type="checkbox" id="alternative_' + full.id + '">';
					return data;
				}
			}, {
				"targets": 8,
				"data": "status_test",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status_test == 1 || full.status_test == 0) {
						data = '<strong>New</strong>';
					} else if (full.status_test == 2) {
						data = '<strong>In Progress</strong>';
					} else {
						data = "<p>Closed</p>";
					}
					return data;
				}
			}];

			table.serverSide('tableAlternatifTest', column, 'HR/test/list-test', null, columnDefs);
		}

		if ($('#tableCandidate').length) {
			var column = [{ 'data': 'created_at' }, { 'data': 'first_name' }, { 'data': 'email' }, { 'data': 'tanggal_lahir' }, { 'data': 'gender' }, { 'data': 'telp' }, { 'data': 'kota' }];

			columnDefs = [{
				"targets": 1,
				"data": "first_name",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.kandidat_id));
					var image = '';
					if (full.foto_profil == null || full.foto_profil == "") {
						image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
					} else {
						image = baseImage + '/' + full.foto_profil;
					}
					var data = '<img class="img-candidate" src="' + image + '" />' + '&nbsp' + full.first_name + ' ' + full.last_name;
					return data;
				}
			}, {
				"targets": 4,
				"data": "gender",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.gender == "1") {
						data = "Male";
					} else if (full.gender == "2") {
						data = "Female";
					}
					return data;
				}
			}, {
				"targets": 7,
				"data": "id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/candidate/edit-candidate/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Detail Job Application"> Edit&nbsp</a></button>';
					return data;
				}
			}];

			table.serverSide('tableCandidate', column, 'HR/candidate/list-candidate', null, columnDefs);
		}

		if ($('#tableJob').length) {
			var value = $('#filterJob').serialize();
			var column = [{ 'data': null }, { 'data': 'submit_date' }, { 'data': 'name' }, { 'data': 'age' }, { 'data': 'gelar' }, { 'data': 'universitas' }, { 'data': 'fakultas' }, { 'data': 'jurusan' }, { 'data': 'gpa' }, { 'data': 'graduate_year' }, { 'data': 'job_position' }, { 'data': 'area' }, { 'data': 'status' }];

			columnDefs = [{
				"targets": 0,
				"orderable": false,
				"data": "job_application_id",
				"render": function render(data, type, full, meta) {
					var data = '<input class="check box' + full.status + '" type="checkbox" id="job_' + full.job_application_id + '_' + full.kandidat_id + '">';
					return data;
				}
			}, {
				"targets": 2,
				"data": "name",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.kandidat_id));
					var image = '';
					if (full.foto_profil == null || full.foto_profil == "") {
						image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
					} else {
						image = baseImage + '/' + full.foto_profil;
					}
					var data = '<img class="img-candidate" src="' + image + '" />' + '&nbsp' + full.name;
					return data;
				}
			}, {
				"targets": 4,
				"data": "gelar",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.gelar == "1") {
						data = "D3";
					} else if (full.gelar == "2") {
						data = "S1";
					} else {
						data = "S2";
					}
					return data;
				}
			}, {
				"targets": 12,
				"data": "status",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status == 0) {
						data = "Application Resume";
					} else if (full.status == 1) {
						data = "Proses to Written Test";
					} else if (full.status == 2) {
						data = "Scheduled to Written Test";
					} else if (full.status == 3) {
						data = "Written Test Pass";
					} else if (full.status == 4) {
						data = "Written Test failed";
					} else if (full.status == 5) {
						data = "Process to HR interview";
					} else if (full.status == 6) {
						data = "Process to User Interview 1";
					} else if (full.status == 7) {
						data = "Process to User Interview 2";
					} else if (full.status == 8) {
						data = "Process to User Interview 3";
					} else if (full.status == 9) {
						data = "Process to MCU";
					} else if (full.status == 10) {
						data = "Process to Doc Sign";
					} else if (full.status == 11) {
						data = "Failed";
					} else if (full.status == 13) {
						data = "HR interview Pass";
					} else if (full.status == 14) {
						data = "HR interview Fail";
					} else if (full.status == 15) {
						data = "User Interview 1 Pass";
					} else if (full.status == 16) {
						data = "User Interview 1 Fail";
					} else if (full.status == 17) {
						data = "User Interview 2 Pass";
					} else if (full.status == 18) {
						data = "User Interview 2 Fail";
					} else if (full.status == 19) {
						data = "User Interview 3 Pass";
					} else if (full.status == 20) {
						data = "User Interview 3 Fail";
					} else if (full.status == 21) {
						data = "MCU Pass";
					} else if (full.status == 22) {
						data = "MCU Fail";
					} else {
						data = "Hired";
					}
					return data;
				}
			}, {
				"targets": 13,
				"data": "kandidat_id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.job_application_id));
					// var konfirm = '';
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/job/edit-job/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Detail Job Application"> Detail&nbsp</a></button>';
					// if (full.status == '1') {
					// 	konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/deactive.svg" title="Deaktif Vacancy">Deactive</button>';
					// } else {
					// 	konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/active.svg" title="Aktifkan Vacancy">Active</button>';
					// }
					// var hasil = data+konfirm
					return data;
				}
			}];

			table.serverSide('tableJob', column, 'HR/job/list-job', value, columnDefs);
		}

		if ($('#tableParticipantTest').length) {
			var value = $("#idData").val();
			var column = [{ 'data': null }, { 'data': 'name' }, { 'data': 'universitas' }, { 'data': 'jurusan' }, { 'data': 'job_position' }, { 'data': 'type' }, { 'data': 'set_test' }, { 'data': 'area' }, { 'data': 'status_participant' }];

			columnDefs = [{
				"targets": 0,
				"orderable": false,
				"data": "test_participant_id",
				"render": function render(data, type, full, meta) {
					var data = '<input type="checkbox" id="participant_' + full.test_participant_id + '">';
					return data;
				}
			}, {
				"targets": 1,
				"data": "name",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.kandidat_id));
					var image = '';
					if (full.foto_profil == null || full.foto_profil == "") {
						image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
					} else {
						image = baseImage + '/' + full.foto_profil;
					}
					var data = '<a href="/HR/candidate/detail-candidate/' + id + '" class="name-candidate"><img class="img-candidate" src="' + image + '" />' + '&nbsp' + full.name + '</a';
					return data;
				}
			}, {
				"targets": 5,
				"data": "type",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.type == 1) {
						data = 'Full Time';
					} else {
						data = 'Intership';
					}
					return data;
				}
			}, {
				"targets": 6,
				"data": "set_test",
				"render": function render(data, type, full, meta) {
					var data = "";
					if (full.set_test == null) {
						data = "<span class='test-status-notset'>Not Set</span>";
					} else {
						data = "<span class='test-status-attend'>" + full.set_test + "</span>";
					}
					return data;
				}
			}, {
				"targets": 8,
				"data": "status_participant",
				"render": function render(data, type, full, meta) {
					var data = "";
					if (full.status_participant == "0") {
						data = "<span class='test-status-notset'>Not Set</span>";
					} else if (full.status_participant == "2") {
						data = '<button type="button" class="btn btn-acc-reschedule">Request Reschedule</button>';
					} else if (full.status_participant == "7") {
						data = "<span class='test-status-notset'>Reschedule Decline</span>";
					} else {
						data = "<span class='test-status-attend'>Confirmed</span>";
					}
					return data;
				}
			}];

			table.serverSide('tableParticipantTest', column, 'HR/test/list-candidate', value, columnDefs);
		}

		if ($('#tableParticipantTestTheDay').length) {
			var value = $("#idData").val();
			var column = [{ 'data': null }, { 'data': 'name' }, { 'data': 'universitas' }, { 'data': 'jurusan' }, { 'data': 'job_position' }, { 'data': 'type' }, { 'data': 'set_test' }, { 'data': 'area' }, { 'data': 'status_participant' }, { 'data': 'location_start_radius' }];

			columnDefs = [{
				"targets": 0,
				"orderable": false,
				"data": "test_participant_id",
				"render": function render(data, type, full, meta) {
					var data = '<input type="checkbox" id="participant_' + full.test_participant_id + '">';
					return data;
				}
			}, {
				"targets": 1,
				"data": "name",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.kandidat_id));
					var image = '';
					if (full.foto_profil == null || full.foto_profil == "") {
						image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
					} else {
						image = baseImage + '/' + full.foto_profil;
					}
					var data = '<a href="/HR/candidate/detail-candidate/' + id + '" class="name-candidate"><img class="img-candidate" src="' + image + '" />' + '&nbsp' + full.name + '</a';
					return data;
				}
			}, {
				"targets": 5,
				"data": "type",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.type == 1) {
						data = 'Full Time';
					} else {
						data = 'Intership';
					}
					return data;
				}
			}, {
				"targets": 6,
				"data": "set_test",
				"render": function render(data, type, full, meta) {
					var data = "<span class='test-status-attend'>" + full.set_test + "</span>";
					return data;
				}
			}, {
				"targets": 8,
				"data": "status_participant",
				"render": function render(data, type, full, meta) {
					var data = "";
					if (full.status_participant == "3") {
						data = "<span class='test-status-attend'>Attend</span>";
					} else if (full.status_participant == "4") {
						data = "<span class='test-status-absen'>Absence</span>";
					} else if (full.status_participant == "5") {
						data = "<span class='test-status-attend'>End Test</span>";
					} else if (full.status_participant == "6") {
						data = "<span class='test-status-absen'>Block</span>";
					} else {
						data = "<span class='test-status-notset'>Not Set</span>";
					}
					return data;
				}
			}, {
				"targets": 10,
				"data": "test_participant_id",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.test_participant_id));
					// var konfirm = '';
					var data = '<button type="button" class="btn btn-table btn-transparent edit-table"><img style="margin-right: 1px;" src="/image/icon/main/icon_send_otp.svg" title="Send OTP">&nbsp Send OTP</button>';
					return data;
				}
			}];

			table.serverSide('tableParticipantTestTheDay', column, 'HR/test/list-candidate', value, columnDefs);
		}

		if ($('#tableParticipantFinish').length) {
			var value = $("#idData").val();
			var column = [{ 'data': 'name' }, { 'data': 'universitas' }, { 'data': 'jurusan' }, { 'data': 'job_position' }, { 'data': 'type' }, { 'data': 'set_test' }, { 'data': 'area' }, { 'data': 'status_participant' }, { 'data': 'location_start_radius' }, { 'data': 'location_end_radius' }, { 'data': 'skor' }];

			columnDefs = [{
				"targets": 0,
				"data": "name",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.kandidat_id));
					var image = '';
					if (full.foto_profil == null || full.foto_profil == "") {
						image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
					} else {
						image = baseImage + '/' + full.foto_profil;
					}
					var data = '<a href="/HR/candidate/detail-candidate/' + id + '" class="name-candidate"><img class="img-candidate" src="' + image + '" />' + '&nbsp' + full.name + '</a';
					return data;
				}
			}, {
				"targets": 4,
				"data": "type",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.type == 1) {
						data = 'Full Time';
					} else {
						data = 'Intership';
					}
					return data;
				}
			}, {
				"targets": 5,
				"data": "set_test",
				"render": function render(data, type, full, meta) {
					var data = "<span class='test-status-attend'>" + full.set_test + "</span>";
					return data;
				}
			}, {
				"targets": 7,
				"data": "status_participant",
				"render": function render(data, type, full, meta) {
					var data = "";
					if (full.status_participant == "3") {
						data = "<span class='test-status-attend'>Attend</span>";
					} else if (full.status_participant == "4") {
						data = "<span class='test-status-absen'>Absence</span>";
					} else if (full.status_participant == "5") {
						data = "<span class='test-status-attend'>End Test</span>";
					} else if (full.status_participant == "6") {
						data = "<span class='test-status-absen'>Block</span>";
					} else {
						data = "<span class='test-status-notset'>Not Set</span>";
					}
					return data;
				}
			}, {
				"targets": 11,
				"data": "test_participant_id",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.test_participant_id));
					// var konfirm = '';
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/test/view-result-test/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/icon_view.svg" title="View Result">&nbsp View</a></button>';
					return data;
				}
			}];

			table.serverSide('tableParticipantFinish', column, 'HR/test/list-candidate-finish', value, columnDefs);
		}

		$(".setTest").click(function () {
			var row = $("#" + this.id).data('value');
			// console.log($("#"+this.id).data('value'))
			_ajax.getData('/HR/question_bank/list-question', 'post', { set: row }, function (data) {
				// console.log(data);
				var verbal = '';
				var numeric = '';
				var abstrak = '';
				var inventory = '';

				if (data.verbal.length) {
					var dataVerbal = '';
					for (var i = 0; i < data.verbal.length; i++) {
						var id = encodeURIComponent(window.btoa(data.verbal[i].master_subtest_id + '_' + data.verbal[i].set + '_' + data.verbal[i].test_type + '_' + data.verbal[i].id));
						dataVerbal = dataVerbal + '<div class="col-lg-3 col-md-4 col-sm-12">' + '<a href="/HR/question_bank/detail-question-bank/' + id + '">' + '<div class="card-question-inside">' + '<div class="d-flex justify-content-between align-items-center">' + '<h5 class="mb-0">Verbal</h5>' + '</div>' + '<div class="content-question">' + '<p><b>' + data.verbal[i].sub_type + '</b>: ' + data.verbal[i].name + '</p>' + '</div>' + '</div>' + '</a>' + '</div>';
					}
					verbal = '<div class="card-accordion">' + '<div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">' + '<h4 class="subtitle mb-0">Verbal</h4>' + '</div>' + '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">' + '<div class="card-accordion-body">' + '<div class="row">' + dataVerbal + '</div>' + '</div>' + '</div>' + '</div>';
				}

				if (data.numeric.length) {
					var dataNumeric = '';
					for (var i = 0; i < data.numeric.length; i++) {
						var id = encodeURIComponent(window.btoa(data.numeric[i].master_subtest_id + '_' + data.numeric[i].set + '_' + data.numeric[i].test_type + '_' + data.numeric[i].id));
						dataNumeric = dataNumeric + '<div class="col-lg-3 col-md-4 col-sm-12">' + '<a href="/HR/question_bank/detail-question-bank/' + id + '">' + '<div class="card-question-inside">' + '<div class="d-flex justify-content-between align-items-center">' + '<h5 class="mb-0">Numeric</h5>' + '</div>' + '<div class="content-question">' + '<p><b>' + data.numeric[i].sub_type + '</b>: ' + data.numeric[i].name + '</p>' + '</div>' + '</div>' + '</a>' + '</div>';
					}
					numeric = '<div class="card-accordion">' + '<div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">' + '<h4 class="subtitle mb-0">Numeric</h4>' + '</div>' + '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">' + '<div class="card-accordion-body">' + '<div class="row">' + dataNumeric + '</div>' + '</div>' + '</div>' + '</div>';
				}

				if (data.abstrak.length) {
					var dataAbstrak = '';
					for (var i = 0; i < data.abstrak.length; i++) {
						var id = encodeURIComponent(window.btoa(data.abstrak[i].master_subtest_id + '_' + data.abstrak[i].set + '_' + data.abstrak[i].test_type + '_' + data.abstrak[i].id));
						dataAbstrak = dataAbstrak + '<div class="col-lg-3 col-md-4 col-sm-12">' + '<a href="/HR/question_bank/detail-question-bank/' + id + '">' + '<div class="card-question-inside">' + '<div class="d-flex justify-content-between align-items-center">' + '<h5 class="mb-0">Abstrak</h5>' + '</div>' + '<div class="content-question">' + '<p><b>' + data.abstrak[i].sub_type + '</b>: ' + data.abstrak[i].name + '</p>' + '</div>' + '</div>' + '</a>' + '</div>';
					}
					abstrak = '<div class="card-accordion">' + '<div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">' + '<h4 class="subtitle mb-0">Abstrak</h4>' + '</div>' + '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">' + '<div class="card-accordion-body">' + '<div class="row">' + dataAbstrak + '</div>' + '</div>' + '</div>' + '</div>';
				}

				if (data.inventory.length) {
					var dataInventory = '';
					for (var i = 0; i < data.inventory.length; i++) {
						var id = encodeURIComponent(window.btoa(data.inventory[i].master_subtest_id + '_' + data.inventory[i].set + '_' + data.inventory[i].test_type + '_' + data.inventory[i].id));
						dataInventory = dataInventory + '<div class="col-lg-3 col-md-4 col-sm-12">' + '<a href="/HR/question_bank/detail-question-bank/' + id + '">' + '<div class="card-question-inside">' + '<div class="d-flex justify-content-between align-items-center">' + '<h5 class="mb-0">Inventory</h5>' + '</div>' + '<div class="content-question">' + '<p><b>' + data.inventory[i].sub_type + '</b></p>' + '</div>' + '</div>' + '</a>' + '</div>';
					}
					inventory = '<div class="card-accordion">' + '<div class="card-accordion-head" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">' + '<h4 class="subtitle mb-0">Inventory</h4>' + '</div>' + '<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">' + '<div class="card-accordion-body">' + '<div class="row">' + dataInventory + '</div>' + '</div>' + '</div>' + '</div>';
				}

				var head = '<div class="accordion accordion-question-bank">' + verbal + numeric + abstrak + inventory + '</div>';

				$("#bodyTest" + row).empty();
				$("#bodyTest" + row).append(head);
			});
		});

		if ($('#tableInterview').length) {
			var column = [{ 'data': 'interview_date' }, { 'data': 'first_name' }, { 'data': 'job_title' }, { 'data': 'area_vacancy' }, { 'data': 'type_name' }, { 'data': 'interviewer' }, { 'data': 'time' }, { 'data': 'city' }, { 'data': 'location' }, { 'data': 'status' }, { 'data': 'note' }];

			columnDefs = [{
				"targets": 1,
				"data": "first_name",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.kandidat_id));
					var image = '';
					if (full.foto_profil == null || full.foto_profil == "") {
						image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
					} else {
						image = baseImage + '/' + full.foto_profil;
					}
					var data = '<img class="img-candidate" src="' + image + '" />' + '&nbsp' + full.first_name + ' ' + full.last_name;
					return data;
				}
			}, {
				"targets": 9,
				"data": "status",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status == 1) {
						data = "<span class='test-status-attend'>New</span>";
					} else if (full.status == 2) {
						data = "<span class='test-status-attend'>Pass</span>";
					} else if (full.status == 3) {
						data = "<span class='test-status-absen'>Fail</span>";
					} else if (full.status == 4) {
						data = "<span class='test-status-notset'>Reschedule</span>";
					} else if (full.status == 5) {
						data = "<span class='test-status-absen'>Reschedule Decline</span>";
					} else {
						data = "<span class='test-status-attend'>Confirm</span>";
					}
					return data;
				}
			}, {
				"targets": 11,
				"data": "id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					var konfirm = "";
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/interview/edit-interview/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Interview"> Edit&nbsp</a></button>';
					if (full.status == "1" || full.status == "6") {
						konfirm = '<button type="button" class="btn btn-table btn-transparent btn-update-status edit-table"><img style="margin-right: 1px;" src="/image/icon/main/icon_update_status.svg" title="Update Status">Update Status</button>';
					}
					var hasil = data + konfirm;
					return hasil;
				}
			}];

			table.serverSide('tableInterview', column, 'HR/interview/list-interview', null, columnDefs);
		}

		if ($("#tableChooseInterview").length) {
			var column = [{ 'data': null }, { 'data': 'first_name' }, { 'data': 'gender' }, { 'data': 'telp' }, { 'data': 'kota' }, { 'data': 'job_title' }, { 'data': 'status' }];

			columnDefs = [{
				"targets": 0,
				"orderable": false,
				"data": "job_application_id",
				"render": function render(data, type, full, meta) {
					var data = '<input class="choose" type="checkbox" id="interview_' + full.job_application_id + '">';
					return data;
				}
			}, {
				"targets": 1,
				"data": "name",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.kandidat_id));
					var image = '';
					if (full.foto_profil == null || full.foto_profil == "") {
						image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
					} else {
						image = baseImage + '/' + full.foto_profil;
					}
					var data = '<img class="img-candidate" src="' + image + '" />' + '&nbsp' + full.first_name + ' ' + full.last_name;
					return data;
				}
			}, {
				"targets": 2,
				"data": "gender",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.gender == "1") {
						data = "Laki-Laki";
					} else if (full.gender == "2") {
						data = "Perempuan";
					}
					return data;
				}
			}, {
				"targets": 6,
				"data": "status",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status == 0) {
						data = "Application Resume";
					} else if (full.status == 1) {
						data = "Proses to Written Test";
					} else if (full.status == 2) {
						data = "Scheduled to Written Test";
					} else if (full.status == 3) {
						data = "Written Test Pass";
					} else if (full.status == 4) {
						data = "Written Test failed";
					} else if (full.status == 5) {
						data = "Process to HR interview";
					} else if (full.status == 6) {
						data = "Process to User Interview 1";
					} else if (full.status == 7) {
						data = "Process to User Interview 2";
					} else if (full.status == 8) {
						data = "Process to User Interview 3";
					} else if (full.status == 9) {
						data = "Process to MCU";
					} else if (full.status == 10) {
						data = "Process to Doc Sign";
					} else if (full.status == 11) {
						data = "Failed";
					} else if (full.status == 13) {
						data = "HR interview Pass";
					} else if (full.status == 14) {
						data = "HR interview Fail";
					} else if (full.status == 15) {
						data = "User Interview 1 Pass";
					} else if (full.status == 16) {
						data = "User Interview 1 Fail";
					} else if (full.status == 17) {
						data = "User Interview 2 Pass";
					} else if (full.status == 18) {
						data = "User Interview 2 Fail";
					} else if (full.status == 19) {
						data = "User Interview 3 Pass";
					} else if (full.status == 20) {
						data = "User Interview 3 Fail";
					} else if (full.status == 21) {
						data = "MCU Pass";
					} else if (full.status == 22) {
						data = "MCU Fail";
					} else {
						data = "Hired";
					}
					return data;
				}
			}];

			table.serverSide('tableChooseInterview', column, 'HR/interview/list-candidate-pick', null, columnDefs);
		}

		if ($('#tableUniv').length) {
			var column = [{ 'data': 'universitas' }];

			columnDefs = [{
				"targets": 1,
				"data": "id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2 edit-table edit-master"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Data Master">&nbsp Edit&nbsp</button>';
					var konfirm = '<button type="button" class="btn btn-table btn-transparent edit-table delete-master"><img style="margin-right: 1px;" src="/image/icon/main/delete_red.svg" title="Delete Data Master">&nbspDelete</button>';
					var hasil = data + konfirm;
					return hasil;
				}
			}];

			table.serverSide('tableUniv', column, 'HR/master/list-universitas', null, columnDefs);
		}

		$("#tabMajor").click(function () {
			var column = [{ 'data': 'major' }];

			columnDefs = [{
				"targets": 1,
				"data": "id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2 edit-table edit-master"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Data Master">&nbsp Edit&nbsp</button>';
					konfirm = '<button type="button" class="btn btn-table btn-transparent edit-table delete-master"><img style="margin-right: 1px;" src="/image/icon/main/delete_red.svg" title="Delete Data Master">&nbspDelete</button>';
					var hasil = data + konfirm;
					return hasil;
				}
			}];

			table.serverSide('tableMajor', column, 'HR/master/list-major', null, columnDefs);
		});

		$("#tabUniv").click(function () {
			var column = [{ 'data': 'universitas' }];

			columnDefs = [{
				"targets": 1,
				"data": "id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2 edit-table edit-master"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit Data Master">&nbsp Edit&nbsp</button>';
					konfirm = '<button type="button" class="btn btn-table btn-transparent edit-table delete-master"><img style="margin-right: 1px;" src="/image/icon/main/delete_red.svg" title="Delete Data Master">&nbspDelete</button>';
					var hasil = data + konfirm;
					return hasil;
				}
			}];

			table.serverSide('tableUniv', column, 'HR/master/list-universitas', null, columnDefs);
		});

		if ($("#formFilterDashboard").length) {
			$('#dateStart').datetimepicker({
				format: 'DD-MM-YYYY'
			});

			$('#dateEnd').datetimepicker({
				format: 'DD-MM-YYYY'
			});

			var dateStart = $("#dateStart").val();
			var dateEnd = $("#dateEnd").val();
			var dateTopScore = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_1'));
			var dateCandidatePass = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_2'));
			var dateAverage = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_3'));
			var dateUniversitas = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_4'));
			var dateMajor = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_5'));

			$("#downloadTopScore").attr('href', '/HR/download-dashboard/' + dateTopScore);
			$("#downloadCandidatePass").attr('href', '/HR/download-dashboard/' + dateCandidatePass);
			$("#downloadAverage").attr('href', '/HR/download-dashboard/' + dateAverage);
			$("#downloadUniversitas").attr('href', '/HR/download-dashboard/' + dateUniversitas);
			$("#downloadMajor").attr('href', '/HR/download-dashboard/' + dateMajor);

			var value = $("#formFilterDashboard").serialize();
			// console.log(value);
			_ajax.getData('/HR/top-score', 'post', value, function (data) {
				if (data.length) {
					for (var i = 0; i < data.length; i++) {
						if (data[i].foto_profil == null || data[i].foto_profil == "") {
							var image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
						} else {
							var image = baseImage + '/' + data[i].foto_profil;
						}
						var dataTopScore = '<div class="row">' + '<div class="col-md-10">' + '<p class="text-name"><img class="img-candidate" src="' + image + '" alt="">&nbsp' + data[i].first_name + '&nbsp' + data[i].last_name + '</p>' + '</div>' + '<div class="col-md-2">' + '<p class="text-nilai">' + parseInt(data[i].skor) + '</p>' + '</div>' + '</div>';
						$("#dataTopScore").append(dataTopScore);
					}
				}
			});

			_ajax.getData('/HR/candidate-pass', 'post', value, function (data) {

				var bar = new ProgressBar.Circle(progressCandidate, {
					color: '#DF0E2C',
					// This has to be the same size as the maximum width to
					// prevent clipping
					strokeWidth: 4,
					trailWidth: 1,
					easing: 'easeInOut',
					duration: 1400,
					text: {
						autoStyleContainer: false
					},
					from: { color: '#DF0E2C', width: 4 },
					to: { color: '#DF0E2C', width: 4 },
					// Set default step function for all animate calls
					step: function step(state, circle) {
						circle.path.setAttribute('stroke', state.color);
						circle.path.setAttribute('stroke-width', state.width);
						var value = Math.round(data.persentase * 100);
						circle.setText(value + '%');
					}
				});
				bar.text.style.fontFamily = '"inter_bold", sans-serif';
				bar.text.style.fontSize = '16px';
				bar.animate(data.persentase);

				$("#candidatePass").html(data.pass);
				$("#candidateAll").html(data.total);
			});

			_ajax.getData('/HR/average-score', 'post', value, function (data) {
				$("#averageVerbal").html(data.verbal);
				$("#averageNumeric").html(data.numeric);
				$("#averageAbstrak").html(data.abstrak);
			});

			_ajax.getData('/HR/application-university', 'post', value, function (univ) {
				var color = [];
				function dynamicColors() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);

					return "rgb(" + r + "," + g + "," + b + ")";
				};
				if (univ.label.length) {
					for (var i = 0; i < univ.label.length; i++) {
						color.push(dynamicColors());
					}
				}
				var data = {
					labels: univ.label,
					datasets: [{
						backgroundColor: color,
						pointBackgroundColor: color,
						data: univ.result
					}]
				};

				var ctx = document.getElementById("chartApplicantUniversity");

				var myRadarChart = new Chart(ctx, {
					type: 'doughnut',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: false
							},
							title: {
								display: false
							}
						}
					}
				});
			});

			_ajax.getData('/HR/application-major', 'post', value, function (major) {
				var color = [];
				function dynamicColors() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);

					return "rgb(" + r + "," + g + "," + b + ")";
				};
				if (major.label.length) {
					for (var i = 0; i < major.label.length; i++) {
						color.push(dynamicColors());
					}
				}
				var data = {
					labels: major.label,
					datasets: [{
						backgroundColor: color,
						pointBackgroundColor: color,
						data: major.result
					}]
				};

				var ctx = document.getElementById("chartApplicantMajor");

				var majorChart = new Chart(ctx, {
					type: 'doughnut',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: false
							},
							title: {
								display: false
							}
						}
					}
				});
			});
		}

		if ($('#tableUser').length) {
			var column = [{ 'data': 'created_at' }, { 'data': 'first_name' }, { 'data': 'last_name' }, { 'data': 'email' }, { 'data': 'gender' }, { 'data': 'telp' }, { 'data': 'role_name' }, { 'data': 'status' }];

			columnDefs = [{
				"targets": 4,
				"data": "id",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.gender == "1") {
						data = "Male";
					} else {
						data = "Female";
					}
					return data;
				}
			}, {
				"targets": 7,
				"data": "id",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status == "1") {
						data = "<span class='test-status-attend'>Active</span>";
					} else {
						data = "<span class='test-status-absen'>Deactive</span>";
					}
					return data;
				}
			}, {
				"targets": 8,
				"data": "id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.id));
					var konfirm = '';
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/user/edit-user/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Edit User"> Edit&nbsp</a></button>';
					if (full.status == '1') {
						konfirm = '<button type="button" class="btn btn-table btn-transparent delete-user edit-table"><img style="margin-right: 1px;" src="/image/icon/main/deactive.svg" title="Deaktif User">Deactive</button>';
					} else {
						konfirm = '<button type="button" class="btn btn-table btn-transparent delete-user edit-table"><img style="margin-right: 1px;" src="/image/icon/main/active.svg" title="Aktifkan User">Active</button>';
					}
					var hasil = data + konfirm;
					return hasil;
				}
			}];

			table.serverSide('tableUser', column, 'HR/user/list-user', null, columnDefs);
		}
	},
	filter: function filter(id, value) {
		if (id == 'filterSearchList' || id == 'filterJobList') {
			$('.loadMoreJob').hide();
			_ajax.getData('/job-more', 'post', { value: value }, function (data) {
				$('#loadJobs').empty();
				if (data.length > 0) {
					for (var i = 0; i < data.length; i++) {
						var id = encodeURIComponent(window.btoa(data[i]['job_id']));

						if (data[i]['type'] == 1) {
							var type = '<div class="fulltime-badge mb-3">Full-time</div>';
						} else if (data[i]['type'] == 2) {
							var type = '<div class="internship-badge mb-3">Internship</div>';
						}

						var option = '<div class="col-lg-4 col-md-6 col-sm-12 my-3">' + '<div class="card card-job-list">' + '<a href="/job/detail/' + id + '" class="text-decoration-none">' + '<div class="card-body">' + type + '<label class="label-no-margin mb-1">' + data[i]['lokasi'] + ', Indonesia</label>' + '<h4 class="candidate-page-subtitle mb-3">' + data[i]['job_title'] + '</h4>' + '<div class="d-flex align-items-center job-list-detail mb-1">' + '<div class="icon-wrapper">' + '<img src="/image/icon/homepage/icon-graduate.svg" alt="icon">' + '</div>' + '<p class="text">' + data[i]['education_req'] + '</p>' + '</div>' + '<div class="d-flex align-items-center job-list-detail">' + '<div class="icon-wrapper">' + '<img src="/image/icon/homepage/icon-book.svg" alt="icon">' + '</div>' + '<p class="text">' + data[i]['major'] + '</p>' + '</div>' + '</div>' + '</a>' + '</div>' + '</div>';

						$('#loadJobs').append(option);
					}
				} else {
					var option = '<div class="col-12 my-3">' + '<div class="card card-job-list">' + '<p style="font-size: 23px;margin: 2rem 0px;text-align: center;">Data Not Found</p>' + '</div>' + '</div>';

					$('#loadJobs').append(option);
				}
			});
		}

		if (id == 'filterJob') {
			var column = [{ 'data': null }, { 'data': 'submit_date' }, { 'data': 'name' }, { 'data': 'age' }, { 'data': 'gelar' }, { 'data': 'universitas' }, { 'data': 'fakultas' }, { 'data': 'jurusan' }, { 'data': 'gpa' }, { 'data': 'graduate_year' }, { 'data': 'job_position' }, { 'data': 'area' }, { 'data': 'status' }];

			columnDefs = [{
				"targets": 0,
				"orderable": false,
				"data": "job_application_id",
				"render": function render(data, type, full, meta) {
					var data = '<input type="checkbox">';
					return data;
				}
			}, {
				"targets": 2,
				"data": "name",
				"render": function render(data, type, full, meta) {
					var image = '';
					if (full.foto_profil == null || full.foto_profil == "") {
						image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
					} else {
						image = baseImage + '/' + full.foto_profil;
					}
					var data = '<img class="img-candidate" src="' + image + '" />' + ' ' + full.name;
					return data;
				}
			}, {
				"targets": 4,
				"data": "gelar",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.gelar == "1") {
						data = "D3";
					} else if (full.gelar == "2") {
						data = "S1";
					} else {
						data = "S2";
					}
					return data;
				}
			}, {
				"targets": 12,
				"data": "status",
				"render": function render(data, type, full, meta) {
					var data = '';
					if (full.status == 0) {
						data = "Application Resume";
					} else if (full.status == 1) {
						data = "Proses to Written Test";
					} else if (full.status == 2) {
						data = "Scheduled to Written Test";
					} else if (full.status == 3) {
						data = "Written Test Pass";
					} else if (full.status == 4) {
						data = "Written Test failed";
					} else if (full.status == 5) {
						data = "Process to HR interview";
					} else if (full.status == 6) {
						data = "Process to User Interview 1";
					} else if (full.status == 7) {
						data = "Process to User Interview 2";
					} else if (full.status == 8) {
						data = "Process to User Interview 3";
					} else if (full.status == 9) {
						data = "Process to MCU";
					} else if (full.status == 10) {
						data = "Process to Doc Sign";
					} else if (full.status == 11) {
						data = "Failed";
					} else if (full.status == 13) {
						data = "HR interview Pass";
					} else if (full.status == 14) {
						data = "HR interview Fail";
					} else if (full.status == 15) {
						data = "User Interview 1 Pass";
					} else if (full.status == 16) {
						data = "User Interview 1 Fail";
					} else if (full.status == 17) {
						data = "User Interview 2 Pass";
					} else if (full.status == 18) {
						data = "User Interview 2 Fail";
					} else if (full.status == 19) {
						data = "User Interview 3 Pass";
					} else if (full.status == 20) {
						data = "User Interview 3 Fail";
					} else if (full.status == 21) {
						data = "MCU Pass";
					} else if (full.status == 22) {
						data = "MCU Fail";
					} else {
						data = "Hired";
					}
					return data;
				}
			}, {
				"targets": 13,
				"data": "kandidat_id",
				"className": "action-poster-news",
				"render": function render(data, type, full, meta) {
					var id = encodeURIComponent(window.btoa(full.kandidat_id));
					// var konfirm = '';
					var data = '<button type="button" class="btn btn-table btn-transparent mr-2"><a class="edit-table" href="/HR/job/edit-job/' + id + '"><img style="margin-right: 1px;" src="/image/icon/main/edit.svg" title="Detail Job Application"> Detail&nbsp</a></button>';
					// if (full.status == '1') {
					// 	konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/deactive.svg" title="Deaktif Vacancy">Deactive</button>';
					// } else {
					// 	konfirm = '<button type="button" class="btn btn-table btn-transparent konfirmVacancy edit-table"><img style="margin-right: 1px;" src="/image/icon/main/active.svg" title="Aktifkan Vacancy">Active</button>';
					// }
					// var hasil = data+konfirm
					return data;
				}
			}];

			table.serverSide('tableJob', column, 'HR/job/list-job', value, columnDefs);
		}

		if (id == 'formFilterDashboard') {
			var dateStart = $("#dateStart").val();
			var dateEnd = $("#dateEnd").val();
			var dateTopScore = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_1'));
			var dateCandidatePass = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_2'));
			var dateAverage = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_3'));
			var dateUniversitas = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_4'));
			var dateMajor = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_5'));

			$("#downloadTopScore").attr('href', '/HR/download-dashboard/' + dateTopScore);
			$("#downloadCandidatePass").attr('href', '/HR/download-dashboard/' + dateCandidatePass);
			$("#downloadAverage").attr('href', '/HR/download-dashboard/' + dateAverage);
			$("#downloadUniversitas").attr('href', '/HR/download-dashboard/' + dateUniversitas);
			$("#downloadMajor").attr('href', '/HR/download-dashboard/' + dateMajor);

			$("#dataTopScore").empty();
			$("#divChartUniv").empty();
			$("#divProgressCandidate").empty();
			$("#divProgressCandidate").append('<div id="progressCandidate" class="progress-bar-dashboard"></div>');
			$("#divChartUniv").append('<canvas class="chart-dashboard" id="chartApplicantUniversity" width="50" height="50"></canvas>');
			$("#divChartMajor").empty();
			$("#divChartMajor").append('<canvas class="chart-dashboard" id="chartApplicantMajor" width="50" height="50"></canvas>');
			_ajax.getData('/HR/top-score', 'post', value, function (data) {
				if (data.length) {
					for (var i = 0; i < data.length; i++) {
						if (data[i].foto_profil == null || data[i].foto_profil == "") {
							var image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
						} else {
							var image = baseImage + '/' + data[i].foto_profil;
						}
						var dataTopScore = '<div class="row">' + '<div class="col-md-10">' + '<p class="text-name"><img class="img-candidate" src="' + image + '" alt="">&nbsp' + data[i].first_name + '&nbsp' + data[i].last_name + '</p>' + '</div>' + '<div class="col-md-2">' + '<p class="text-nilai">' + parseInt(data[i].skor) + '</p>' + '</div>' + '</div>';
						$("#dataTopScore").append(dataTopScore);
					}
				}
			});

			_ajax.getData('/HR/candidate-pass', 'post', value, function (data) {

				var bar = new ProgressBar.Circle(progressCandidate, {
					color: '#DF0E2C',
					// This has to be the same size as the maximum width to
					// prevent clipping
					strokeWidth: 4,
					trailWidth: 1,
					easing: 'easeInOut',
					duration: 1400,
					text: {
						autoStyleContainer: false
					},
					from: { color: '#DF0E2C', width: 4 },
					to: { color: '#DF0E2C', width: 4 },
					// Set default step function for all animate calls
					step: function step(state, circle) {
						circle.path.setAttribute('stroke', state.color);
						circle.path.setAttribute('stroke-width', state.width);
						var value = Math.round(data.persentase * 100);
						circle.setText(value + '%');
					}
				});
				bar.text.style.fontFamily = '"inter_bold", sans-serif';
				bar.text.style.fontSize = '16px';
				bar.animate(data.persentase);

				$("#candidatePass").html(data.pass);
				$("#candidateAll").html(data.total);
			});

			_ajax.getData('/HR/average-score', 'post', value, function (data) {
				$("#averageVerbal").html(data.verbal);
				$("#averageNumeric").html(data.numeric);
				$("#averageAbstrak").html(data.abstrak);
			});

			_ajax.getData('/HR/application-university', 'post', value, function (univ) {
				var color = [];
				function dynamicColors() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);

					return "rgb(" + r + "," + g + "," + b + ")";
				};
				if (univ.label.length) {
					for (var i = 0; i < univ.label.length; i++) {
						color.push(dynamicColors());
					}
				}
				var data = {
					labels: univ.label,
					datasets: [{
						backgroundColor: color,
						pointBackgroundColor: color,
						data: univ.result
					}]
				};

				var ctx = document.getElementById("chartApplicantUniversity");

				var myRadarChart = new Chart(ctx, {
					type: 'doughnut',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: false
							},
							title: {
								display: false
							}
						}
					}
				});
			});

			_ajax.getData('/HR/application-major', 'post', value, function (major) {
				var color = [];
				function dynamicColors() {
					var r = Math.floor(Math.random() * 255);
					var g = Math.floor(Math.random() * 255);
					var b = Math.floor(Math.random() * 255);

					return "rgb(" + r + "," + g + "," + b + ")";
				};
				if (major.label.length) {
					for (var i = 0; i < major.label.length; i++) {
						color.push(dynamicColors());
					}
				}
				var data = {
					labels: major.label,
					datasets: [{
						backgroundColor: color,
						pointBackgroundColor: color,
						data: major.result
					}]
				};

				var ctx = document.getElementById("chartApplicantMajor");

				var majorChart = new Chart(ctx, {
					type: 'doughnut',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								display: false
							},
							title: {
								display: false
							}
						}
					}
				});
			});
		}

		if (id == "filterReport") {
			var type = $("#categoryReport").val();
			var dateStart = $("#dateStartReport").val();
			var dateEnd = $("#dateEndReport").val();
			var kota = $("#kotaReport").val();
			var univ = $("#universitasReport").val();
			var linkDonwload = encodeURIComponent(window.btoa(dateStart + '_' + dateEnd + '_' + type + '_' + kota + '_' + univ));
			$(".btn-download-report").attr('href', '/HR/report/download-report/' + linkDonwload);
			$(".div-report").addClass('hidden');
			$(".tbody-data").empty();
			// $("#modalFilterReport").modal('hide');
			if (type == "1") {
				_ajax.getData('/HR/report/get-report', 'post', value, function (report) {
					$("#divTrenKelulusan").removeClass('hidden');
					if (report.length) {
						var data = '';
						for (var i = 0; i < report.length; i++) {
							data = '<tr>' + '<td>' + report[i].date_test + '</td>' + '<td>' + report[i].event_id + '</td>' + '<td>' + report[i].city + '</td>' + '<td>' + report[i].total_peserta + '</td>' + '<td>' + report[i].verbal + '</td>' + '<td>' + report[i].abstrak + '</td>' + '<td>' + report[i].numerical + '</td>' + '<td>' + report[i].jumlah_lulus + '</td>' + '</tr>';
							$("#tableTrenKelulusan").append(data);
						}
					}
				});
			} else if (type == "2") {
				_ajax.getData('/HR/report/get-report', 'post', value, function (report) {
					$("#divAverageScore").removeClass('hidden');
					if (report.length) {
						var data = '';
						for (var i = 0; i < report.length; i++) {
							data = '<tr>' + '<td>' + report[i].jurusan + '</td>' + '<td>' + report[i].verbal + '</td>' + '<td>' + report[i].abstrak + '</td>' + '<td>' + report[i].numerical + '</td>' + '</tr>';
							$("#tableAverageScore").append(data);
						}
					}
				});
			} else if (type == "3") {
				_ajax.getData('/HR/report/get-report', 'post', value, function (report) {
					$("#divTingkatUniv").removeClass('hidden');
					if (report.length) {
						var data = '';
						for (var i = 0; i < report.length; i++) {
							data = '<tr>' + '<td>' + report[i].universitas + '</td>' + '<td>' + report[i].total_peserta + '</td>' + '<td>' + report[i].jumlah_lulus + '</td>' + '<td>' + report[i].jumlah_gagal + '</td>' + '<td>' + report[i].persentase_lulus + '%</td>' + '</tr>';
							$("#tableTingkatUniv").append(data);
						}
					}
				});
			} else if (type == "4") {
				_ajax.getData('/HR/report/get-report', 'post', value, function (report) {
					$("#divTingkatJurusan").removeClass('hidden');
					if (report.length) {
						var data = '';
						for (var i = 0; i < report.length; i++) {
							data = '<tr>' + '<td>' + report[i].jurusan + '</td>' + '<td>' + report[i].total_peserta + '</td>' + '<td>' + report[i].jumlah_lulus + '</td>' + '<td>' + report[i].jumlah_gagal + '</td>' + '<td>' + report[i].persentase_lulus + '%</td>' + '</tr>';
							$("#tableTingkatJurusan").append(data);
						}
					}
				});
			} else if (type == "5") {
				_ajax.getData('/HR/report/get-report', 'post', value, function (report) {
					$("#divTrenAverage").removeClass('hidden');
					if (report.length) {
						var data = '';
						for (var i = 0; i < report.length; i++) {
							data = '<tr>' + '<td>' + report[i].periode + '</td>' + '<td>' + report[i].verbal + '</td>' + '<td>' + report[i].abstrak + '</td>' + '<td>' + report[i].numerical + '</td>' + '</tr>';
							$("#tableTrenAverage").append(data);
						}
					}
				});
			} else if (type == "6") {
				_ajax.getData('/HR/report/get-report', 'post', value, function (report) {
					$("#divAverageFull").removeClass('hidden');
					if (report.length) {
						var data = '';
						for (var i = 0; i < report.length; i++) {
							data = '<tr>' + '<td>' + report[i].job_title + '</td>' + '<td>' + report[i].average_wirrten_test + '</td>' + '<td>' + report[i].average_hr_review + '</td>' + '<td>' + report[i].average_final_review + '</td>' + '<td>' + report[i].average_user_review + '</td>' + '<td>' + report[i].average_mcu + '</td>' + '<td>' + report[i].average_hired + '</td>' + '<td>' + report[i].total_time + '</td>' + '</tr>';
							$("#tableAverageFull").append(data);
						}
					}
				});
			} else if (type == "7") {
				_ajax.getData('/HR/report/get-report', 'post', value, function (report) {
					$("#divTrenApplicant").removeClass('hidden');
					if (report.length) {
						var data = '';
						for (var i = 0; i < report.length; i++) {
							data = '<tr>' + '<td>' + report[i].periode + '</td>' + '<td>' + report[i].d3 + '</td>' + '<td>' + report[i].s1 + '</td>' + '<td>' + report[i].s2 + '</td>' + '</tr>';
							$("#tableTrenApplicant").append(data);
						}
					}
				});
			} else if (type == "8") {
				_ajax.getData('/HR/report/get-report', 'post', value, function (report) {
					$("#divApply").removeClass('hidden');
					if (report.length) {
						var data = '';
						for (var i = 0; i < report.length; i++) {
							data = '<tr>' + '<td>' + report[i].kota + '</td>' + '<td>' + report[i].universitas + '</td>' + '<td>' + report[i].jurusan + '</td>' + '<td>' + report[i].gender + '</td>' + '<td>' + report[i].total_kandidat + '</td>' + '</tr>';
							$("#tableApply").append(data);
						}
					}
				});
			}
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

		if (id == "tableJob" || id == "tableChooseCandidate" || id == "tableParticipantTest" || id == "tableParticipantTestTheDay" || id == "tableChooseInterview") {
			urutan = [1, 'desc'];
		}

		var search = true;

		var svrTable = $("#" + id).DataTable({
			// "drawCallback": function( settings ) {
			// 	if (id == "tableVacancy") {
			// 		$('.dataTables_scrollHead').remove()
			// 		$('.dataTables_scrollBody table thead').hide()
			// 	}
			// },
			// processing:true,
			scrollY: "325px",
			scrollCollapse: true,
			serverSide: true,
			columnDefs: columnDefs,
			columns: columns,
			responsive: false,
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

$("#tableJob tbody").on('click', 'input', function (e) {
	var table = $('#tableJob').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countCheck").val();
	var jumlah = "";
	$('.check').attr('disabled', true);
	$('.box' + dataRow.status).attr('disabled', false);
	if ($("#job_" + dataRow.job_application_id + "_" + dataRow.kandidat_id).is(":checked")) {
		jumlah = parseInt(count) + 1;
		$("#countCheck").val(jumlah);
		$("#inputID").append('<input type="hidden" id="input_' + dataRow.job_application_id + '_' + dataRow.kandidat_id + '" name="idJob[]" value="' + dataRow.job_application_id + '_' + dataRow.kandidat_id + '">');
	} else {
		jumlah = parseInt(count) - 1;
		$("#countCheck").val(jumlah);
		$("#input_" + dataRow.job_application_id + "_" + dataRow.kandidat_id).remove();
	}
	$("#textItem").html(jumlah + " item selected");
	if (jumlah > 1) {
		$(".btn-bulk-candidate").removeClass('hidden');
	} else {
		if (jumlah == 0) {
			$('.check').attr('disabled', false);
		}
		$(".btn-bulk-candidate").addClass('hidden');
	}
	// alert(jumlah);
	// console.log(this.className, this.id);
});

$("#tableAlternatifTest tbody").on('click', 'input', function (e) {
	var table = $('#tableAlternatifTest').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countTest").val();
	var jumlah = "";
	if ($("#alternative_" + dataRow.id).is(":checked")) {
		jumlah = parseInt(count) + 1;
		$("#alternative_" + dataRow.id).addClass("checkActive");
		$("#countTest").val(jumlah);
		$("#divAlternatif").append('<div class="div-alternatif hidden" id="setAlternatif' + dataRow.id + '">' + '<input type="hidden" name="alternatifTest" class="id-alternatif-test" value="' + dataRow.id + '" disabled>' + '<input type="hidden" name="alternatifTestDate" class="id-alternatif-test" value="' + dataRow.date_test + '" disabled>' + '<div class="dropdown-divider mb-4"></div>' + '<div class="row">' + '<div class="col-md-5">' + '<p class="title-alternatif title-id">Test Alternative 1 ID</p>' + '<p class="content-alternatif">' + dataRow.event_id + '</p>' + '</div>' + '<div class="col-md-5">' + '<p class="title-alternatif title-date">Date Test Alternative 1</p>' + '<p class="content-alternatif">' + dataRow.date_test + '</p>' + '</div>' + '<div class="col-md-2 pt-2">' + '<button id="delete' + dataRow.id + '" value="' + dataRow.id + '" type="button" class="btn btn-delete-alternatif btn-transparent"><img style="margin-right: 1px;" src="/image/icon/main/delete_red.svg" title="Delete Alternative Test">&nbspDelete</button>' + '</div>' + '</div>' + '<div class="dropdown-divider mt-4 mb-4"></div>' + '</div>');
	} else {
		jumlah = parseInt(count) - 1;
		$("#alternative_" + dataRow.id).removeClass("checkActive");
		$("#countTest").val(jumlah);
		$("#setAlternatif" + dataRow.id).remove();
	}
	$("#textItem").html(jumlah + " item selected");
	if (jumlah == 0) {
		$("#btnAddAlternative").addClass("hidden");
	} else {
		$("#btnAddAlternative").removeClass("hidden");
		if (jumlah == 3) {
			$('.check').attr('disabled', true);
			$('.checkActive').attr('disabled', false);
		} else {
			$('.check').attr('disabled', false);
		}
	}

	$("#delete" + dataRow.id).click(function () {
		$("#alternative_" + this.value).prop('checked', false);
		var count = $("#countTest").val();
		$("#setAlternatif" + this.value).remove();
		jumlah = parseInt(count) - 1;
		$("#countTest").val(jumlah);
		$("#addAlternative").removeClass("hidden");
		$("#alternative_" + this.value).removeClass("checkActive");
		$('.check').attr('disabled', false);
	});
});

$("#tableParticipantTest tbody").on('click', 'input', function (e) {
	var table = $('#tableParticipantTest').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countParticipant").val();
	var jumlah = "";
	if ($("#participant_" + dataRow.test_participant_id).is(":checked")) {
		jumlah = parseInt(count) + 1;
		$("#countParticipant").val(jumlah);
		$("#listPart").append('<input type="hidden" id="input_' + dataRow.test_participant_id + '" name="idPart[]" value="' + dataRow.test_participant_id + '">');
	} else {
		jumlah = parseInt(count) - 1;
		$("#countParticipant").val(jumlah);
		$("#input_" + dataRow.test_participant_id).remove();
	}
	$(".textItem").html(jumlah + " item selected");
	if (jumlah == 0) {
		$("#btnUpdateSet").addClass('hidden');
	} else {
		$("#btnUpdateSet").removeClass('hidden');
	}
});

$("#tableParticipantTestTheDay tbody").on('click', 'input', function (e) {
	var table = $('#tableParticipantTestTheDay').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countParticipant").val();
	var jumlah = "";
	if ($("#participant_" + dataRow.test_participant_id).is(":checked")) {
		jumlah = parseInt(count) + 1;
		$("#countParticipant").val(jumlah);
		$("#listPart").append('<input type="hidden" id="input_' + dataRow.test_participant_id + '" name="idPart[]" value="' + dataRow.test_participant_id + '">');
		$("#listAbsen").append('<input type="hidden" id="absen_' + dataRow.test_participant_id + '" name="absenPart[]" value="' + dataRow.test_participant_id + '">');
	} else {
		jumlah = parseInt(count) - 1;
		$("#countParticipant").val(jumlah);
		$("#input_" + dataRow.test_participant_id).remove();
		$("#absen_" + dataRow.test_participant_id).remove();
	}
	$(".textItem").html(jumlah + " item selected");
	if (jumlah == 0) {
		$("#btnUpdateSet").addClass('hidden');
		$("#btnSendOtp").addClass('hidden');
		$("#btnSetAbsen").addClass('hidden');
	} else {
		$("#btnUpdateSet").removeClass('hidden');
		$("#btnSendOtp").removeClass('hidden');
		$("#btnSetAbsen").removeClass('hidden');
	}
});

$('#tableParticipantTest tbody').on('click', 'button.btn-acc-reschedule', function (e) {
	var table = $('#tableParticipantTest').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	_ajax.getData('/HR/test/detail-reschedule', 'post', { idParticipant: dataRow.test_participant_id }, function (data) {
		$("#spanName").html(dataRow.name);
		$("#spanDate").html(data.date + ' - ' + data.event_id);
		$("#idParticipant").val(data.id_participant);
		$("#idTestRechedule").val(data.id);
	});
	$("#modalReschedule").modal('show');
});

$("#tableChooseInterview tbody").on('click', 'input', function (e) {
	var table = $('#tableChooseInterview').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	var count = $("#countChoose").val();
	var jumlah = "";
	if ($("#interview_" + dataRow.job_application_id).is(":checked")) {
		if (dataRow.foto_profil == null || dataRow.foto_profil == "") {
			image = baseUrl + 'image/icon/homepage/dummy-profile.svg';
		} else {
			image = baseImage + '/' + dataRow.foto_profil;
		}
		var dataNama = '<img class="img-candidate" src="' + image + '" />' + '&nbsp' + dataRow.first_name + ' ' + dataRow.last_name;
		var gender = "";
		if (dataRow.gender == "1") {
			gender = "Laki-laki";
		} else {
			gender = "Perempuan";
		}

		var status = "";

		if (dataRow.status == 0) {
			status = "Application Resume";
		} else if (dataRow.status == 1) {
			status = "Proses to Written Test";
		} else if (dataRow.status == 2) {
			status = "Scheduled to Written Test";
		} else if (dataRow.status == 3) {
			status = "Written Test Pass";
		} else if (dataRow.status == 4) {
			status = "Written Test failed";
		} else if (dataRow.status == 5) {
			status = "Process to HR interview";
		} else if (dataRow.status == 6) {
			status = "Process to User Interview 1";
		} else if (dataRow.status == 7) {
			status = "Process to User Interview 2";
		} else if (dataRow.status == 8) {
			status = "Process to User Interview 3";
		} else if (dataRow.status == 9) {
			status = "Process to MCU";
		} else if (dataRow.status == 10) {
			status = "Process to Doc Sign";
		} else if (dataRow.status == 11) {
			status = "Failed";
		} else if (dataRow.status == 13) {
			status = "HR interview Pass";
		} else if (dataRow.status == 14) {
			status = "HR interview Fail";
		} else if (dataRow.status == 15) {
			status = "User Interview 1 Pass";
		} else if (dataRow.status == 16) {
			status = "User Interview 1 Fail";
		} else if (dataRow.status == 17) {
			status = "User Interview 2 Pass";
		} else if (dataRow.status == 18) {
			status = "User Interview 2 Fail";
		} else if (dataRow.status == 19) {
			status = "User Interview 3 Pass";
		} else if (dataRow.status == 20) {
			status = "User Interview 3 Fail";
		} else if (dataRow.status == 21) {
			status = "MCU Pass";
		} else if (dataRow.status == 22) {
			status = "MCU Fail";
		} else {
			status = "Hired";
		}

		jumlah = parseInt(count) + 1;
		$("#countChoose").val(jumlah);
		$("#chooseInterview").append('<input type="hidden" class="choose-candidate-list" id="input_' + dataRow.job_application_id + '" name="idJOb[]" value="' + dataRow.job_application_id + '">');
		$("#tbodyInterview").append('<tr id="tr_' + dataRow.job_application_id + '">' + '<td>' + dataNama + '</td>' + '<td>' + gender + '</td>' + '<td>' + dataRow.telp + '</td>' + '<td>' + dataRow.kota + '</td>' + '<td>' + dataRow.job_title + '</td>' + '<td>' + status + '</td>' + '</tr>');
	} else {
		jumlah = parseInt(count) - 1;
		$("#countChoose").val(jumlah);
		$("#input_" + dataRow.job_application_id).remove();
		$("#tr_" + dataRow.job_application_id).remove();
	}
	if (jumlah == 0) {
		$("#btnAddCandidateInterview").addClass('hidden');
	} else {
		$("#btnAddCandidateInterview").removeClass('hidden');
	}
});

$('#tableInterview tbody').on('click', 'button.btn-update-status', function (e) {
	var table = $('#tableInterview').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idUpdateStatus").val(dataRow.id);
	$("#idJobApp").val(dataRow.id_job_application);
	$("#statusJobApp").val(dataRow.status_job);
	$("#idKandidat").val(dataRow.kandidat_id);
	$("#modalUpdateStatus").modal('show');
});

$('#tableUniv tbody').on('click', 'button.edit-master', function (e) {
	var table = $('#tableUniv').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idEdit").val(dataRow.id);
	$("#typeEdit").val("1");
	$("#nameEdit").val(dataRow.universitas);
	$("#labelMaster").html("University Name");
	$("#modalEditMaster").modal('show');
});

$('#tableUniv tbody').on('click', 'button.delete-master', function (e) {
	var table = $('#tableUniv').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idDelete").val(dataRow.id);
	$("#typeDelete").val("1");
	$("#spanMaster").html(dataRow.universitas);
	$("#modalDeleteMaster").modal('show');
});

$('#tableMajor tbody').on('click', 'button.edit-master', function (e) {
	var table = $('#tableMajor').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idEdit").val(dataRow.id);
	$("#typeEdit").val("2");
	$("#nameEdit").val(dataRow.major);
	$("#labelMaster").html("Major Name");
	$("#modalEditMaster").modal('show');
});

$('#tableMajor tbody').on('click', 'button.delete-master', function (e) {
	var table = $('#tableMajor').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	$("#idDelete").val(dataRow.id);
	$("#typeDelete").val("2");
	$("#spanMaster").html(dataRow.major);
	$("#modalDeleteMaster").modal('show');
});

$('#tableUser tbody').on('click', 'button.delete-user', function (e) {
	var table = $('#tableUser').DataTable();
	var dataRow = table.row($(this).closest('tr')).data();
	if (dataRow.status == "1") {
		$("#typeDeleteUser").val("0");
		$("#titleDeleteUser").html("Deactive?");
		$("#textDeleteUser").html('Are you sure to deactive " <span class="span-reschedule">' + dataRow.first_name + ' ' + dataRow.last_name + '</span> " ?');
		$("#btnDeleteUser").html('Deactive Now');
	} else {
		$("#typeDeleteUser").val("1");
		$("#titleDeleteUser").html("Active?");
		$("#textDeleteUser").html('Are you sure to active " <span class="span-reschedule">' + dataRow.first_name + ' ' + dataRow.last_name + '</span> " ?');
		$("#btnDeleteUser").html('Active Now');
	}
	$("#idDeleteUser").val(dataRow.user_id);
	$("#modalDeleteUser").modal('show');
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
					$('.personal-information').removeClass('active');
					$('.education-information').addClass('active');
					$('.tracking-line div:first-child').addClass('red-line');
					$('.tracking-line div:last-child').addClass('gray-line');
				} else if (item[0].id === 'page-2') {
					$('.tracking-line div').removeClass();
					$('.other-information img').attr('src', '/image/icon/homepage/track-pin-red.svg');
					$('.education-information').removeClass('active');
					$('.other-information').addClass('active');
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
	},

	'formFirstLogin': {
		ignore: null,
		rules: {
			'photoProfile': {
				required: true
			},
			'firstName': {
				required: true,
				STD_VAL_WEB_3: true
			},
			'lastName': {
				STD_VAL_WEB_3: true
			},
			'birthDate': {
				required: true,
				STD_VAL_WEB_11: true
			},
			'gender': {
				required: true
			},
			'phoneNumber': {
				required: true,
				STD_VAL_WEB_8: true
			},
			'myLocation': {
				required: true
			},
			'lingkedInLink': {
				STD_VAL_WEB_20: true
			},
			'university': {
				required: true,
				STD_VAL_WEB_25: true
			},
			'degree': {
				required: true
			},
			'faculty': {
				required: true,
				STD_VAL_WEB_25: true
			},
			'major': {
				required: true
			},
			'startDateEducation': {
				required: true
			},
			'endDateEducation': {
				required: true
			},
			'gpa': {
				required: true,
				maxDec: 4
			},
			'certificate[]': {
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
			if (element.is("#photoProfile")) {
				error.appendTo(element.parent().parent().parent());
			} else if (element.is("input[type=radio]") || element.is("input[type=checkbox]")) {
				error.appendTo(element.parents('.form-group'));
			} else if (element.hasClass("select2")) {
				error.appendTo(element.parents('.form-group'));
			} else if (element.is("#certificate")) {
				error.appendTo(element.parents('.form-group'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formEditPassword': {
		ignore: null,
		rules: {
			'oldPassword': {
				required: true
			},
			'newPassword': {
				required: true
			},
			'newPasswordConfirm': {
				required: true,
				equalTo: '#newPassword'
			}
		},
		submitHandler: false,
		messages: {
			oldPassword: {
				required: 'Mohon isi password lama'
			},
			newPassword: {
				required: 'Mohon isi password baru'
			},
			newPasswordConfirm: {
				required: 'Mohon isi konfirmasi password baru'
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

	'formResetPass': {
		ignore: null,
		rules: {
			'password': {
				required: true
			},
			'passwordRe': {
				required: true,
				equalTo: '#password'
			}
		},
		submitHandler: false,
		messages: {

			password: {
				required: 'Mohon isi password baru'
			},
			passwordRe: {
				required: 'Mohon isi konfirmasi password baru'
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

	'formEditPersonalInformation': {
		ignore: null,
		rules: {
			'firstName': {
				required: true,
				STD_VAL_WEB_3: true
			},
			'lastName': {
				required: true,
				STD_VAL_WEB_3: true
			},
			'birthDate': {
				required: true,
				STD_VAL_WEB_11: true
			},
			'gender': {
				required: true
			},
			'phoneNumber': {
				required: true,
				STD_VAL_WEB_8: true
			},
			'myLocation': {
				required: true
			},
			'lingkedInLink': {
				required: true,
				STD_VAL_WEB_20: true
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#myLocation")) {
				error.appendTo(element.parents('#myLocationDiv'));
			} else if (element.is("#gender")) {
				error.appendTo(element.parents('#genderDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'updateStatusCandidate': {
		ignore: null,
		rules: {
			'aplicationStatus': {
				required: true
			},
			'TestId': {
				required: true
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#aplicationStatus")) {
				error.appendTo(element.parents('#aplicationStatusDivv'));
			} else if (element.is("#TestId")) {
				error.appendTo(element.parents('#TestIdDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formAddQuestionBank': {
		ignore: null,
		rules: {
			'setTest': {
				required: true
			},
			'testType': {
				required: true
			},
			'subCognitive': {
				required: true
			},
			'chooseAnswer': {
				required: true
			}
		},
		submitHandler: false,
		messages: {
			chooseAnswer: {
				required: 'Mohon pilih salah satu jawaban'
			}
		},
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#setTest")) {
				error.appendTo(element.parents('#setTestDiv'));
			} else if (element.is("#testType")) {
				error.appendTo(element.parents('#testTypeDiv'));
			} else if (element.is("#subCognitive")) {
				error.appendTo(element.parents('#subCognitiveDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formAddTest': {
		ignore: null,
		rules: {
			'cityTest': {
				required: true
			},
			'locationTest': {
				required: true
			},
			'timeTest': {
				required: true
			},
			'dateTest': {
				required: true
			},
			'longlatTest': {
				required: true
			},
			'setTest': {
				required: true
			}
		},
		messages: {
			setTest: {
				required: 'Mohon pilih salah satu set test'
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("input[name=setTest]")) {
				error.appendTo(element.parents('#setTestDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},
	'formForgetCandidate': {
		ignore: null,
		rules: {
			'email': 'required'
		},
		submitHandler: false,
		messages: {
			email: {
				required: 'Mohon isi email'
			}
		}
	},

	'formAddInterview': {
		ignore: null,
		rules: {
			'typeInterview': {
				required: true
			},
			'locationInterview': {
				required: true
			},
			'timeInterview': {
				required: true
			},
			'dateInterview': {
				required: true
			},
			'cityInterview': {
				required: true
			},
			'interviewer': {
				required: true
			}
		},
		messages: {
			setTest: {
				required: 'Mohon pilih salah satu set test'
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#typeInterview")) {
				error.appendTo(element.parents('#typeInterviewDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formEditInterview': {
		ignore: null,
		rules: {
			'locationInterview': {
				required: true
			},
			'timeInterview': {
				required: true
			},
			'dateInterview': {
				required: true
			},
			'cityInterview': {
				required: true
			},
			'interviewer': {
				required: true
			}
		},
		messages: {
			setTest: {
				required: 'Mohon pilih salah satu set test'
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#typeInterview")) {
				error.appendTo(element.parents('#typeInterviewDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'updateStatusInterview': {
		ignore: null,
		rules: {
			'noteInterview': {
				required: true
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			error.insertAfter(element);
		}
	},

	'formRescheduleInterview': {
		ignore: null,
		rules: {
			'dateStart': {
				required: true
			},
			'dateEnd': {
				required: true
			},
			'timeStart': {
				required: true
			},
			'timeEnd': {
				required: true
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#timeStart")) {
				error.appendTo(element.parents('#timeStartDiv'));
			} else if (element.is("#timeEnd")) {
				error.appendTo(element.parents('#timeEndDiv'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formAccInterview': {
		ignore: null,
		rules: {
			'dateAccInterview': {
				required: true
			},
			'timeAccInterview': {
				required: true
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			error.insertAfter(element);
		}
	},

	'formAddCandidate': {
		ignore: null,
		rules: {
			'firstName': {
				required: true,
				STD_VAL_WEB_3: true
			},
			'lastName': {
				required: true,
				STD_VAL_WEB_3: true
			},
			'birthDate': {
				required: true,
				STD_VAL_WEB_11: true
			},
			'gender': {
				required: true
			},
			'email': {
				required: true
			},
			'phoneNumber': {
				required: true,
				STD_VAL_WEB_8: true
			},
			'myLocation': {
				required: true
			},
			'lingkedInLink': {
				STD_VAL_WEB_20: true
			},
			'university': {
				required: true,
				STD_VAL_WEB_25: true
			},
			'degree': {
				required: true
			},
			'faculty': {
				required: true,
				STD_VAL_WEB_25: true
			},
			'major': {
				required: true
			},
			'startDateEducation': {
				required: true
			},
			'endDateEducation': {
				required: true
			},
			'gpa': {
				required: true,
				maxDec: 4
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#photoProfile")) {
				error.appendTo(element.parent().parent().parent());
			} else if (element.is("input[type=radio]") || element.is("input[type=checkbox]")) {
				error.appendTo(element.parents('.form-group'));
			} else if (element.hasClass("select2")) {
				error.appendTo(element.parents('.form-group'));
			} else if (element.hasClass("select2-custom")) {
				error.appendTo(element.parents('.form-group'));
			} else if (element.is("#certificate")) {
				error.appendTo(element.parents('.form-group'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formEditCandidate': {
		ignore: null,
		rules: {
			'universitas': {
				required: true
			},
			'degree': {
				required: true
			},
			'faculty': {
				required: true,
				STD_VAL_WEB_25: true
			},
			'major': {
				required: true
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.hasClass("select2")) {
				error.appendTo(element.parents('.form-group'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'addBulkCandidate': {
		ignore: null,
		rules: {
			'fileBulk': {
				required: true
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			error.appendTo(element.parents('.form-group'));
		}
	},

	'formAddUser': {
		ignore: null,
		rules: {
			'emailUser': {
				required: true,
				STD_VAL_WEB_5: true
			},
			'passUser': {
				required: true,
				STD_VAL_WEB_2: true
			},
			'firstNameUser': {
				required: true,
				STD_VAL_WEB_3: true
			},
			'lastNameUser': {
				required: true,
				STD_VAL_WEB_3: true
			},
			'genderUser': {
				required: true
			},
			'telpUser': {
				required: true,
				STD_VAL_WEB_8: true
			},
			'roleUser': {
				required: true
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#roleUser")) {
				error.appendTo(element.parents('#roleUserDiv'));
			} else if (element.is("input[type=radio]") || element.is("input[type=checkbox]")) {
				error.appendTo(element.parents('.form-group'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formAEditUser': {
		ignore: null,
		rules: {
			'firstNameUser': {
				required: true,
				STD_VAL_WEB_3: true
			},
			'lastNameUser': {
				required: true,
				STD_VAL_WEB_3: true
			},
			'genderUser': {
				required: true
			},
			'telpUser': {
				required: true,
				STD_VAL_WEB_8: true
			},
			'roleUser': {
				required: true
			}
		},
		submitHandler: false,
		errorPlacement: function errorPlacement(error, element) {
			if (element.is("#roleUser")) {
				error.appendTo(element.parents('#roleUserDiv'));
			} else if (element.is("input[type=radio]") || element.is("input[type=checkbox]")) {
				error.appendTo(element.parents('.form-group'));
			} else {
				// This is the default behavior
				error.insertAfter(element);
			}
		}
	},

	'formChangePassword': {
		ignore: null,
		rules: {
			'oldPassword': {
				required: true
			},
			'newPassword': {
				required: true,
				STD_VAL_WEB_2: true
			},
			'konfirmationPassword': {
				required: true,
				equalTo: '#newPassword'
			}
		},
		submitHandler: false
	},

	'formForgetPassword': {
		ignore: null,
		rules: {
			'email': {
				required: true
			}
		},
		submitHandler: false
	},

	'formResetPassword': {
		ignore: null,
		rules: {
			'newPassword': {
				required: true,
				STD_VAL_WEB_2: true
			},
			'konfirmasiPassword': {
				required: true,
				equalTo: '#newPassword'
			}
		},
		submitHandler: false
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

		jQuery.validator.addMethod("STD_VAL_WEB_1", function (value, element) {
			return this.optional(element) || /^(?=.*\d)([a-zA-Z0-9]+)(?!.*[ #<>\/\\=”’"'!@#$%^&()]).{6,10}$/.test(value);
		}, "Username yang Anda masukkan harus terdiri dari 6-10 karakter alfanumerik tanpa spasi");

		jQuery.validator.addMethod("STD_VAL_WEB_2", function (value, element) {
			// 3x salah blokir
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w])(?!.*\s).{8,12}$/.test(value);
		}, "Password kombinasi huruf kapital, huruf kecil, angka, dan karakter non-alphabetic");

		jQuery.validator.addMethod("STD_VAL_WEB_3", function (value, element) {
			return this.optional(element) || /^[a-zA-Z.' ]*$/.test(value);
		}, "Nama harus terdiri dari alfabet, titik (.) dan single quote (')");

		// STD_VAL_WEB_4 Jenis Kelamin (kemungkinan select option)

		jQuery.validator.addMethod("STD_VAL_WEB_5", function (value, element) {
			value = value.toLowerCase();
			return this.optional(element) || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value);
		}, "Email Anda salah. Email harus terdiri dari @ dan domain");

		jQuery.validator.addMethod("STD_VAL_WEB_6", function (value, element) {
			return this.optional(element) || /^\d{16}$/.test(value);
		}, "Nomor KTP yang Anda masukkan salah. Harus terdiri dari 16 karakter");

		jQuery.validator.addMethod("STD_VAL_WEB_7", function (value, element) {
			return this.optional(element) || /^\d{15}$/.test(value);
		}, "NPWP yang Anda masukkan salah. Harus terdiri dari 15 karakter tanpa spasi dan symbol");

		jQuery.validator.addMethod("STD_VAL_WEB_8", function (value, element) {
			return this.optional(element) || /^\d{11,13}$/.test(value);
		}, "Nomor HP yang Anda masukkan salah");

		jQuery.validator.addMethod("STD_VAL_WEB_9", function (value, element) {
			// 3x salah blokir
			return this.optional(element) || /^\d{6}$/.test(value);
		}, "Pin yang anda masukkan salah. Jika salah hingga 3x akan otomatis terblokir");

		jQuery.validator.addMethod("STD_VAL_WEB_10", function (value, element) {
			return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\s).{6,255}$/.test(value);
		}, "Alamat yang anda masukkan salah");

		jQuery.validator.addMethod("STD_VAL_WEB_11", function (value, element) {
			return this.optional(element) || /^(((0[1-9]|[12]\d|3[01])\-(0[13578]|1[02])\-((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\-(0[13456789]|1[012])\-((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\-02\-((19|[2-9]\d)\d{2}))|(29\-02\-((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/.test(value);
		}, "Masukkan format tanggal yang sesuai");

		jQuery.validator.addMethod("STD_VAL_WEB_12", function (value, element) {
			return this.optional(element) || /^([1-9]|([012][0-9])|(3[01]))-([0]{0,1}[1-9]|1[012])-\d\d\d\d [012]{0,1}[0-9]:[0-6][0-9]:[0-6][0-9]$/.test(value);
		}, "Masukkan format tanggal yang sesuai");

		jQuery.validator.addMethod("STD_VAL_WEB_13", function (value, element) {
			// 3x salah blokir, expired 3 menit, 1 menit untuk retry
			return this.optional(element) || /^\d{6}$/.test(value);
		}, "OTP yang Anda masukkan salah");

		jQuery.validator.addMethod("STD_VAL_WEB_14", function (value, element) {
			return this.optional(element) || /^[a-zA-Z0-9]{8,12}$/.test(value);
		}, "MPIN yang Anda masukkan salah");

		jQuery.validator.addMethod("STD_VAL_WEB_15", function (value, element) {
			// setelah 4 input angka otomatis spasi (tambahkan pada masking)
			return this.optional(element) || /^[0-9 ]{19}$/.test(value);
		}, "Nomor kartu yang Anda masukkan tidak valid/salah");

		jQuery.validator.addMethod("STD_VAL_WEB_16", function (value, element) {
			// Saat input otomatis masking
			return this.optional(element) || /^\d{3}$/.test(value);
		}, "CVV yang Anda masukkan tidak valid/salah");

		jQuery.validator.addMethod("STD_VAL_WEB_17", function (value, element) {
			// Maxlength sesuai kebutuhan
			return this.optional(element) || /^[0-9]*$/.test(value);
		}, "Virtual Account Number yang anda masukkan tidak valid");

		jQuery.validator.addMethod('STD_VAL_WEB_18', function (value, element, param) {
			param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpeg|png";
			return this.optional(element) || element.files[0].size <= 1000000 && value.match(new RegExp("\\.(" + param + ")$", "i"));
		}, "Upload gambar maksimal 1MB");

		jQuery.validator.addMethod('STD_VAL_WEB_19', function (value, element, param) {
			param = typeof param === "string" ? param.replace(/,/g, "|") : "doc|docx|xls|xlsx|csv";
			return this.optional(element) || element.files[0].size <= 5000000 && value.match(new RegExp("\\.(" + param + ")$", "i"));
		}, "Upload file maksimal 5MB");

		jQuery.validator.addMethod("STD_VAL_WEB_20", function (value, element) {
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
			return this.optional(element) || value >= param[0] && value <= param[1];
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

var grafik = {
	init: function init() {
		// js grafik
		if ($("#grafikResult").length) {
			var id = $("#idParticipant").val();
			_ajax.getData('/HR/test/inventory-result', 'post', { id: id }, function (inventory) {

				var data = {
					labels: inventory.label,
					datasets: [{
						label: "Inventory Result",
						backgroundColor: "#DF0E2C",
						borderColor: "#DF0E2C",
						pointBackgroundColor: "#DF0E2C",
						pointBorderColor: "#fff",
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "rgba(179,181,198,1)",
						data: inventory.result
					}]
				};

				var ctx = document.getElementById("grafikResult");

				var myRadarChart = new Chart(ctx, {
					type: 'radar',
					data: data,
					options: {
						scale: {
							ticks: {
								beginAtZero: true
							}
						}
					}
				});
			});
		}

		if ($("#chartRecruitment").length) {

			_ajax.getData('/HR/chart-total-application', 'post', null, function (data) {
				var data = {
					labels: ['Processed', 'Declined', 'Hired'],
					datasets: [{
						backgroundColor: ["#DF0E2C", "#2E61AF", "#FFBC42"],
						pointBackgroundColor: "#DF0E2C",
						data: [data.proses, data.decline, data.hired]
					}]
				};

				var ctx = document.getElementById("chartRecruitment");

				var myRadarChart = new Chart(ctx, {
					type: 'doughnut',
					data: data,
					options: {
						responsive: true,
						plugins: {
							legend: {
								position: 'bottom'
							},
							title: {
								display: false
							}
						}
					}
				});
			});
		}

		if ($("#chartApplication").length) {
			_ajax.getData('/HR/chart-application-source', 'post', null, function (data) {

				var data = {
					labels: data.label,
					datasets: [{
						backgroundColor: "#DF0E2C",
						pointBackgroundColor: "#DF0E2C",
						data: data.result,
						barPercentage: 0.3
					}]
				};

				var ctx = document.getElementById("chartApplication");

				var myRadarChart = new Chart(ctx, {
					type: 'bar',
					data: data,
					options: {
						indexAxis: 'y',
						// Elements options apply to all of the options unless overridden in a dataset
						// In this case, we are setting the border of each horizontal bar to be 2px wide
						elements: {
							bar: {
								borderRadius: 10
							}
						},
						responsive: true,
						plugins: {
							legend: {
								display: false
							},
							title: {
								display: false
							}
						}
					}
				});
			});
		}

		if ($("#grafikResultInventory").length) {
			var id = $("#idPart").val();
			_ajax.getData('/HR/job/inventory-result', 'post', { id: id }, function (inventory) {

				var data = {
					labels: inventory.label,
					datasets: [{
						label: "Inventory Result",
						backgroundColor: "#DF0E2C",
						borderColor: "#DF0E2C",
						pointBackgroundColor: "#DF0E2C",
						pointBorderColor: "#fff",
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "rgba(179,181,198,1)",
						data: inventory.result
					}]
				};

				var ctx = document.getElementById("grafikResultInventory");

				var myRadarChart = new Chart(ctx, {
					type: 'radar',
					data: data,
					options: {
						scale: {
							ticks: {
								beginAtZero: true
							}
						}
					}
				});
			});
		}
	}
};

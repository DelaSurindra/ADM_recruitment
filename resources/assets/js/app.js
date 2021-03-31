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
    ajax.init();
    table.init();
    form.init();
    ui.slide.init();
    validation.addMethods();
    // if ($('#main-wrapper').length) {
    //     other.checkSession.init();
    // }
    $(document).ajaxError(function (event, jqxhr, settings, exception) {
        console.log('exception = ' + exception)
    });

    moveOnMax = function (field, nextFieldID) {
        if (field.value.length == 1) {
            document.getElementById(nextFieldID).focus();
        }
    }

    if ($('#notif').length) {
        const status = $('#notif').data('status')
        const message = $('#notif').data('message')
        const url = $('#notif').data('url')
        const id = $('#notif').data('id')
        const value = $('#notif').data('value')
        console.log(value)
        if (id == 'formAddQuestionBank') {
            $("#setTest").val(value.setTest).trigger('change')
            var testType = value.testType;
            $("#testType").val(testType).trigger('change')

            if (testType == "1") {                    
                var cognitive = value.subTest;
                $("#subCognitive").val(cognitive).trigger('change')
                if (cognitive == "1" || cognitive == "3" || cognitive == "4" || cognitive == "7") {
                    $("#QA1").removeClass("hidden");
                    $(".class-QA1").attr('disabled', false);
                }else if (cognitive == "5") {
                    $("#QA2").removeClass("hidden");
                    $(".class-QA2").attr('disabled', false);
                }else if (cognitive == "8") {
                    $("#QA3").removeClass("hidden");
                    $(".class-QA3").attr('disabled', false);
                }else if (cognitive == "2") {
                    $("#QA4").removeClass("hidden");
                    $(".class-QA4").attr('disabled', false);
                }else if (cognitive == "6") {
                    $("#QA5").removeClass("hidden");
                    $(".class-QA5").attr('disabled', false);
                }else if (cognitive == "9" || cognitive == "10" || cognitive == "12") {
                    $("#QA6").removeClass("hidden");
                    $(".class-QA6").attr('disabled', false);
                }else if (cognitive == "11") {
                    $("#QA7").removeClass("hidden");
                    $(".class-QA7").attr('disabled', false);
                }
            }else if(testType == "2"){
                $("#QA8").removeClass("hidden");
                $(".class-QA8").attr('disabled', false);
            }
        }
        
        ui.popup.show(status, message, url)
    }
    if ($('#notifModal').length) {
        const status = $('#notifModal').data('status')
        const message = $('#notifModal').data('message')
        const url = $('#notifModal').data('url')

        if (status == 'success') {
            $('#titleSuccessNotif').html(message)
            $('#modalNotifForSuccess').modal('show')
        } else {
            $('#titleErrorNotif').html(message)
			$('#modalNotifForError').modal('show')
        }
    }
    if ($('#mustLogin').length) {
        $('.modal').modal('hide');
	    ui.popup.hideLoader();

        $('#modalNotifForLogin').modal('show')
    }
    if ($('#profileSaved').length) {
        $('.modal').modal('hide');
	    ui.popup.hideLoader();

        $('#modalNotifProfileSaved').modal('show')
    }
    
    if ($('#addTest').length) {
	    ui.popup.hideLoader();
        $('.modal').modal('hide');
        const url = $('#addTest').data('url')
        $("#urlTest").attr('href', url);
        $('#modalSuccessAddTest').modal('show')
    }
})

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
    
})

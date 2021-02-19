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

        ui.popup.show(status, message, url)
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

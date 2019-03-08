$(document).ready(function() {
	// $(".menu").click(function() {
	// 	var link = $(this);
	// 	var closest_ul = link.closest("ul");
	// 	var parallel_active_links = closest_ul.find(".active")
	// 	var closest_li = link.closest("li");
	// 	var link_status = closest_li.hasClass("active");
	// 	var closest_a = link.closest("a");
	// 	var count = 0;

	// 	closest_ul.find("ul").slideUp(function() {
	// 		if (++count == closest_ul.find("ul").length)
	// 			parallel_active_links.removeClass("active");
	// 	});

	// 	if (!link_status) {
	// 		closest_li.children("ul").slideDown();
	// 		closest_li.addClass("active");
	// 		closest_a.addClass("active");
	// 	}
	// })

	$('.toggle').click(function(e) {
		e.preventDefault();
		
		var $this = $(this);
		
		if ($this.next().hasClass('show')) {
			$this.next().removeClass('show');
			$this.parent().removeClass('active');
			$this.next().slideUp(350);
		} else {
			$this.parent().parent().find('.active').removeClass('active');
			$this.parent().parent().find('li .inner').removeClass('show');
			$this.parent().parent().find('li .inner').slideUp(350);
			$this.parent().toggleClass('active');
			$this.next().toggleClass('show');
			$this.next().slideToggle(350);
		}
	});

	$('.toggle-acd-arrow').click(function(e) {
		e.preventDefault();
		
		var $this = $(this);
		
		if ($this.next().hasClass('show')) {
			$this.next().removeClass('show');
			$this.parent().removeClass('active');
			$this.next('span a i').removeClass('pull-down');
			$this.next().slideUp(350);
		} else {
			$this.parent().parent().find('.active').removeClass('active');
			$this.parent().parent().find('li a span i .pull-down').removeClass('pull-down');
			$this.parent().parent().find('li .inner').removeClass('show');
			$this.parent().parent().find('li .inner').slideUp(350);
			$this.parent().toggleClass('active');
			$this.next().toggleClass('show');
			$this.next().next().toggleClass('pull-down');
			$this.next().slideToggle(350);
		}
	});
	
	$('.toggle-sidebar').click(function(e) {
		e.preventDefault();
		
		var $this = $(this);
		
		if ($this.next().hasClass('show')) {
			$this.next().removeClass('show');
			$this.parent().removeClass('active');
			$this.next('span a i').removeClass('pull-down');
			$this.next().slideUp(350);
		} else {
			$this.parent().parent().find('li a span i .pull-down').removeClass('pull-down');
			$this.parent().parent().find('li .inner').removeClass('show');
			$this.parent().parent().find('li .inner').slideUp(350);
			$this.parent().toggleClass('active');
			$this.next().toggleClass('show');
			$this.next().next().toggleClass('pull-down');
			$this.next().slideToggle(350);
		}
	});

})

var logo = document.querySelector(".logo");
var min = document.querySelector(".minimize");
var side = document.querySelector(".main-sidebar");
var menutoggle = document.querySelector("#menu-toggle");
var main = document.querySelector(".content-wrapper");

menutoggle.addEventListener("click", function(e) {
	logo.classList.toggle("mini");
	min.classList.toggle("mini");
	side.classList.toggle("mini");
	main.classList.toggle("mini");
})

var mobilemenu = document.querySelector("#btn-mobile");

mobilemenu.addEventListener("click", function(e) {
	logo.classList.toggle("mbl");
	mobilemenu.classList.toggle("mbl");
	side.classList.toggle("mbl");
})

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

// $(function () {
// 	$('.datepicker').datepicker();
// });
var ui = {
	popup:{
		show:function(type, message, url) {
			if (type == 'error') {
				Swal.fire({
					title: message,
				  	type: type,
					confirmButtonText: 'OK',
					allowOutsideClick: false
				})
			} else if(type == 'success'){
				if (url == 'close') {
					Swal.fire({
						title: message,
					  	type: type,
						confirmButtonText: 'OK',
						allowOutsideClick: false
					})
				} else {
					Swal.fire({
						title: message,
					  	type: type,
						confirmButtonText: 'OK',
						allowOutsideClick: false
						}).then(function() {
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
				})
			} else if (type == 'warning') {
				if (url == 'close') {
					Swal.fire({
						title: message,
					  	type: type,
						confirmButtonText: 'OK',
						allowOutsideClick: false
					})
				}else{
					Swal.fire({
						title: message,
					  	type: type,
						confirmButtonText: 'OK',
						allowOutsideClick: false
						}).then(function() {
							window.location = url;
					});
				}
			} else {
				Swal.fire({
					title: message,
				  	type: type,
					confirmButtonText: 'OK',
					allowOutsideClick: false
				})
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
	slide:{
		init:function(){
			$('.carousel-control').on('click',function(e){
				e.preventDefault();
				var control = $(this);

				var item = control.parent();

				if(control.hasClass('right')){
					ui.slide.next(item);
				}else{
					ui.slide.prev(item);
				}

			});
			$('.slideBtn').on('click',function(e){
				e.preventDefault();
				var control = $(this);
				var item = $("#"+control.attr('for'));
				
				if (item[0].id === 'page-1') {
					$('.tracking-line div').removeClass();
					$('.education-information img').attr('src', '/image/icon/homepage/track-toga-red.svg')
					$('.tracking-line div:first-child').addClass('red-line');
					$('.tracking-line div:last-child').addClass('gray-line');
				} else if (item[0].id === 'page-2') {
					$('.tracking-line div').removeClass();
					$('.other-information img').attr('src', '/image/icon/homepage/track-pin-red.svg')
					$('.tracking-line div:first-child').addClass('red-line');
					$('.tracking-line div:last-child').addClass('red-line');
				} else {
					$('.tracking-line div').removeClass();
					$('.tracking-line div:first-child').addClass('red-line');
					$('.tracking-line div:last-child').addClass('red-line');
				}

				if(control.hasClass('btn-next')){
					ui.slide.next(item);
				}else{
					ui.slide.prev(item);
				}
			})
		},
		next:function(item){
			var nextItem = item.next();
			item.toggle({'slide':{
				direction:'left'
			}})
			nextItem.toggle({'slide':{
				direction:'right'
			}})
		},
		prev:function(item){
			var prevItem = item.prev();
			item.toggle({'slide':{
				direction:'right'
			}});
			prevItem.toggle({'slide':{
				direction:'left'
			}});
		}
	}
}


$('button').click(function() {
  const parent = 
    $(this).closest('.item')
  const next = 
    parent.parent().find('.item.not-yet').first();
  parent.toggleClass('done');
  next.toggleClass('not-yet');
});

$('.button-next1').click(function() {
    const parent = 
      $(this).closest('.item')
    const next = 
      parent.parent().find('.item.nama').first();
    parent.toggleClass('satu');
    next.toggleClass('dua');
  });

$('.button-back').click(function() {
  const parent = 
    $(this).closest('.item')
  const next = 
    parent.parent().find('.item.done').first();
  parent.toggleClass('not-yet');
  next.toggleClass('done');
});

jQuery(document).ready(function ($) {

  $('#checkbox').change(function(){
    setInterval(function () {
        moveRight();
    }, 3000);
  });
  
	var slideCount = $('#slider ul li').length;
	var slideWidth = $('#slider ul li').width();
	var slideHeight = $('#slider ul li').height();
	var sliderUlWidth = slideCount * slideWidth;
	
	$('#slider').css({ width: slideWidth, height: slideHeight });
	
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: + slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });

});
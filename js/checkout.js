    $('.card1').on('click', function(e) {
  e.preventDefault();
  $('.card1').removeClass('active');
    $('.card2').removeClass('active');
  $(this).addClass('active');
  $('.form').stop().slideUp();
    $('.content1').stop().slideUp();
  $('.form').delay(300).slideDown();
  
      $("button").show();

});

 $('.card2').on('click', function(e) {
  e.preventDefault();
    $('.form').stop().slideUp();

  $('.card1').removeClass('active');
  $(this).addClass('active');
    $('.content1').delay(300).slideDown();
    $(".button").hide();

  });
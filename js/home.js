;
(function($) {
  'use strict';
  // any scripts needed for home page goes here
  //
  if ($(document).scrollTop() > 0) {
    $('.custom-header-background').addClass('light');
  }

  // Add opacity class to site header
  $(document).on('scroll', function() {

    if ($(document).scrollTop() > 0) {
      $('.custom-header-background').addClass('light');

    } else {
      $('.custom-header-background').removeClass('light');
    }

  });


})(jQuery);

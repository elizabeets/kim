export default {
  init() {
    // JavaScript to be fired on all pages\
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    //region Hero Slider
    $('.hero-slider').slick({
      slidesToShow: 1,
      dots: false,
      arrows: false,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 3500,
      fade: true,
      cssEase: 'linear',
    });
    //endregion
    //region Header functionality
    $(window).scroll(function() {
      if ($(window).scrollTop() > 100) {
        $('header.banner').addClass('on');
      }
      else {
        $('header.banner').removeClass('on');
      }
    });
    //endregion
  },
};

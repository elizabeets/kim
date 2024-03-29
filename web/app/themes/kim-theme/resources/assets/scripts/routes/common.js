export default {
  init() {
    // JavaScript to be fired on all pages
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    //region Mobile Burger Menu
    let trigger = $('#hamburger'),
      isClosed = false;

    function burgerTime() {
      if (isClosed === true) {
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
        $('.mobile-menu-overlay').fadeOut();
      } else {
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
        $('.mobile-menu-overlay').fadeIn();
      }
    }

    trigger.click(burgerTime);
    //endregion
    //region Hero Slider
    $('.hero-slider, .slider').slick({
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
      if ($(document).height() > 2500 && $(window).scrollTop() > 100) {
        $('header.banner').addClass('on');
      }
      else {
        $('header.banner').removeClass('on');
      }
    });
    //endregion\
  },
};

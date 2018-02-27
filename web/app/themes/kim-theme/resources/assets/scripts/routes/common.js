export default {
  init() {
    // JavaScript to be fired on all pages\
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
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
    //region Mobile Burger Menu
    let trigger = $('#hamburger'),
      isClosed = false;

    function burgerTime() {
      if (isClosed === true) {
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
        $('.overlay').fadeOut();
      } else {
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
        $('.overlay').fadeIn();
      }
    }

    trigger.click(burgerTime);
    //endregion
    //region Lookbooks
    $('article.lookbook button').click(function() {
      const lookbook = $(this).closest('article.lookbook');
      const siblings = $('article.lookbook');
      siblings.removeClass('current-lookbook');
      siblings.find('.lookbook-back').fadeOut();
      siblings.find('.lookbook-front').fadeIn();
      lookbook.addClass('current-lookbook');
      siblings.css('opacity', 1);
      siblings.not('.current-lookbook').css('opacity', 0.5);
      lookbook.find('.lookbook-back').fadeIn();
      lookbook.find('.lookbook-front').fadeOut();
    });
    $('.flip-lookbook').click(function() {
      const lookbook = $(this).closest('article.lookbook');
      lookbook.find('.lookbook-front').fadeIn();
      lookbook.find('.lookbook-back').fadeOut();
      lookbook.removeClass('current-lookbook');
      $('article.lookbook').not('.current-lookbook').css('opacity', 1);
    });
    //endregion
  },
};

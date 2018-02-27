export default {
  init() {
    // JavaScript to be fired on all pages
    $('input[name="your-subject"]').val($('.product_title').text());
    $('.contact-button a').click(function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).hide();
      $('.form').fadeIn();
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

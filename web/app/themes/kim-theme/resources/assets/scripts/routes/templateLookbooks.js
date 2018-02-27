export default {
  init() {
    // JavaScript to be fired on all pages
    //region Lookbooks
    $('article.lookbook button, article.lookbook .image').click(function() {
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
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};

;

window.DelegateHover = function() {
  function fn_deletageHover() {
    $('[data-delegate-hover-to]').each(function() {
      var $that = $(this),
        delegate_hover_to_selector = $that.data('delegate-hover-to'),
        $delegate_hover_to = $(delegate_hover_to_selector);

      $that.hover(function() {
        $delegate_hover_to.addClass('hover');
      }, function() {
        $delegate_hover_to.removeClass('hover');
      });
    });
  }

  $( document ).ready(fn_deletageHover);

};

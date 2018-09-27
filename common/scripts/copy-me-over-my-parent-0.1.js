;

(function() {
  $('[data-copy-me-over]').each(function onCopyOverMyParentElement() {
    var $that = $(this)
      , pivot = $that.data('copy-me-over')
      , classes_for_original = $that.data('classes-for-original') || 'hidden-xs hidden-sm'
      , classes_for_clone = $that.data('classes-for-clone') || 'visible-xs visible-sm'
      , $pivot = $(pivot);

    $that.addClass(classes_for_original);

    var $clone = $that.clone();

    $clone
      .removeAttr('id')
      .removeClass( classes_for_original )
      .addClass( classes_for_clone + ' clone' )
      .removeAttr('data-copy-me-over');

    $clone.insertBefore($pivot);
  });
})();

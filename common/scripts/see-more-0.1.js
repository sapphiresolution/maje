;

window.SeeMore = function(_options) {
  var options = $.extend({}, {
    durationOfSlideUp: 800,
    durationOfSlideDown: 800,
    waitForSlipeUpToFinishBeforeScrollingUp: false,
  }, _options);

  function _getByData($trigger, name) {
    return $( $trigger.data( name ) );
  }
  function getTargetToShow($trigger) { return _getByData($trigger, 'selector-for-content') }

  var $selector = $('.see-more-trigger[data-selector-for-content]');

  $selector.each(function() {
    var $target_to_show = getTargetToShow( $(this) );
    $target_to_show.css('display', 'none').css('clear', 'both');
  });

  $( document ).ready(function () {
    $selector.on('click', function(e) {
      e.preventDefault();

      var $this = $(this)
        , extraParameters = {
          target_to_show: getTargetToShow($this),
        };

      $this.trigger('toggle', extraParameters);

    });

    $selector.on('toggle', function(e, extraParameters) {
      var $this = $(this);
      var $that = $this.toggleClass('on');

      if ( ! $that.hasClass('on') ) {
        $this.trigger('hide', extraParameters);
      } else {
        $this.trigger('show', extraParameters);
      }
    });

    $selector.on('show', function(e, extraParameters) {
      var $target_to_show
        , $this = $(this)
        ;

      if( $target_to_show = extraParameters.target_to_show ) ;
      else $target_to_show = getTargetToShow($this);

      var durationOfSlideDown = $this.data('duration-of-slide-down') || options.durationOfSlideDown;
      $target_to_show.slideDown(durationOfSlideDown, function() {
        $this.trigger('shown', extraParameters);
      });

    });

    $selector.on('hide', function(e, extraParameters) {
      var $target_to_show
        , $this = $(this)
        ;

      if( $target_to_show = extraParameters.target_to_show ) ;
      else $target_to_show = getTargetToShow($this);

      var fn_scroll_up = function(callback) {
        var anchor = $this.data( 'selector-for-slider' );
        var option = { speed: 800, easing: 'easeOutCubic' };
        if(anchor)
          smoothScroll.animateScroll(
            anchor,
            undefined,
            option,
            { callback: callback }
          );
      };

      var durationOfSlideUp = $this.data('duration-of-slide-up') || options.durationOfSlideUp;

      if(options.waitForSlipeUpToFinishBeforeScrollingUp) {
        $target_to_show.slideUp(durationOfSlideUp, fn_scroll_up);
      } else {

          $target_to_show.slideUp(durationOfSlideUp);
          fn_scroll_up($target_to_show);
      }

    });

  });
};


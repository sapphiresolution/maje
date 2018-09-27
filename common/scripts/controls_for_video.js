;

(function($) {
  $('[data-controls-for-video]').each(function() {
    initPlayer($(this));
  });

  function initPlayer($controls) {
    var selector_for_players = $controls.data('controls-for-video')
      , $ka_play = $controls.find('.ka_play')
      , $ka_mute = $controls.find('.ka_mute')
      ;

    $( selector_for_players ).each(function() {
      var player = this;

      $(player).on('pause', function()  { $ka_play.addClass('active') });
      $(player).on('play', function()   { $ka_play.removeClass('active') });
      $(player).on('volumechange', function() {
        true === player.muted ? $ka_mute.addClass('active') :  $ka_mute.removeClass('active');
      });
    });

    $ka_play.on('click', function (e) {
      e.preventDefault(); togglePlayback(selector_for_players);
    });
    $ka_mute.on('click', function (e) {
      e.preventDefault(); toggleSound(selector_for_players);
    });
  }

  function togglePlayback(selector_for_players) {
    $( selector_for_players ).each(function() {
      var player = this;
      true === player.paused ? player.play() : player.pause();
    });
  }

  function toggleSound(selector_for_players) {
    $( selector_for_players ).each(function() {
      var player = this;
      player.muted = !player.muted;
    });
  }
})(jQuery);

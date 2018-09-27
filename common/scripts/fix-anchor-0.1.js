;

// require smooth-scroll-9.4.2.min.js

window.FixAnchor = function() {

  function getHeaderHeight() {
    return (a = $('#header').height()) ? a : 0;
  }

  $( document ).ready(function onDocumentReady() {
    var anchor = window.location.hash.substring(1);

    setTimeout(function() {
      window.scrollTo(0, 0);

      setTimeout(function() {
        window.kr_smooth_scroll = new smoothScroll.init({
          offset: is_mobile ? 0 : getHeaderHeight(),
          updateURL: true,
        });

        if (anchor)
          smoothScroll.animateScroll( '#' + anchor, undefined, {
            offset: is_mobile ? 0 : (getHeaderHeight() + 50),
          });

      }, 1000);

    }, 10);

  });

};

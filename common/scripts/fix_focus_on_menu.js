;

window.addEventListener('load', function() {
  $( document ).ready(function () {
    $('#header #qA').on('focus', function() { $('#header').addClass('qa-has-focus'); });
    $('#header #qA').on('blur', function() { $('#header').removeClass('qa-has-focus'); });
  });
});

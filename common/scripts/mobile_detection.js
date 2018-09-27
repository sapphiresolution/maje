;

function updateMobileVariables() {
  window.is_iphone  = /iPhone|iPod/.test(navigator.userAgent);
  window.is_ipad    = /iPad/.test(navigator.userAgent);
  window.is_ios     = is_iphone || is_ipad;
  window.is_android = navigator.userAgent.toLowerCase().indexOf("android") > -1;
  window.is_mobile  = is_ios || is_android;

  window.is_landscape = window.height > window.width;
  window.is_portrait = !window.is_landscape;
}

function updateMobileClassesOnBody() {
  updateMobileVariables();

  var $body = $('body')
    , classes = [
      'is_iphone',
      'is_ipad',
      'is_ios',
      'is_android',
      'is_mobile',

      'is_landscape',
      'is_portrait',
    ]
    , getClass = function(variable_name) {
      return variable_name.replace('_', '-');
    };

  classes.forEach(function(variable_name) {
    var class_name = getClass(variable_name)
    , variable_value = window[ variable_name ];

    if (variable_value) $body.addClass(class_name);
    else $body.removeClass(class_name);
  });
}

window.addEventListener('load', function() {
  updateMobileVariables();
  $( document ).ready(updateMobileClassesOnBody);
  $( window ).resize(updateMobileClassesOnBody);
});

<?php
function load_maps($url_handler = null) {
  $out = '';
  $maps = glob('maps/*.map');

  foreach($maps as $map) {
    $name = basename($map, '.map');
    $content = file_get_contents($map);

    $content = preg_replace('/^.+\n/', '', $content);
    $content = preg_replace("/<!--.*?-->\n/ms", '', $content);
    $content = preg_replace_callback(
      '/href="([^""]+)"/',
      function($matches) use ($name, $url_handler) {
        return 'href="'.($url_handler ? $url_handler($matches[1]) : $matches[1]).'" data-product="'.$matches[1].'" data-look="'.$name.'"';
      },
      $content);
    $content = str_replace('<map name="map">', '<map name="'.$name.'">', $content);

    $out .= $content;
  }

  return $out;
}

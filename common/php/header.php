<?php

use MatthiasMullie\Minify;

if(true !== KrConfig::$is_init)
  throw new Exception("KrConfig was not init");

duplicate_words('FR', 'BE-FR');
duplicate_words('UK', 'BE-EN');
duplicate_words('NL', 'BE-NL');
duplicate_words('UK', 'IE');
duplicate_words('UK', 'US');
duplicate_words('IE', 'EU');
duplicate_words('FR', 'CH-FR');
duplicate_words('DE', 'CH-DE');
duplicate_words('UK', 'CH-EN');
duplicate_words('IT', 'CH-IT');
duplicate_words('UK', 'AS');

function rebase($file) {
  global $BASE_DOMAIN;

  $BASE_URL = 'http://' . KrConfig::$SUB_DOMAIN .'.' . KrConfig::$BASE_DOMAIN . '/';

  $pre = file_get_contents($file);
  $pre = str_replace('href="//', 'href="https://', $pre);
  $pre = str_replace('src="//', 'src="https://', $pre);

  $pre = str_replace('href="/', 'href="' . $BASE_URL, $pre);
  $pre = str_replace('src="/', 'src="' . $BASE_URL, $pre);

  $pre = str_replace('__ID__', strtoupper(ID()), $pre);

  return $pre;
}

function str_replace_first($search, $replace, $subject) {
  $pos = strpos($subject, $search);
  if ($pos !== false)
    $subject = substr_replace($subject, $replace, $pos, strlen($search));
  return $subject;
}

function get_file_extension($path) {
  return pathinfo($path)['extension'];
}

function complile_scss_with_cache($compiler, $style_file) {
  global $BUST_CACHE_FOR_SCSS;

  $output = null;

  $temp_file = sys_get_temp_dir() . '/assets-scss-' . str_replace(['/', '.'], '_', $style_file) . implode('-', [ID(), LANG(), PROD()]);

  if( file_exists($temp_file) ) {
    $last_time_cached = filemtime($temp_file);
    $last_time_modified = filemtime($style_file);

    if($last_time_cached >= $last_time_modified) {
      $output = file_get_contents($temp_file);
    }
  }

  if(null === $output || true === @$BUST_CACHE_FOR_SCSS) {
    $output = $compiler->compile( file_get_contents($style_file) );
    file_put_contents($temp_file, $output);
  }

  return $output;
}

function handle_style_file($style_file) {
  $extension = get_file_extension($style_file);
  switch ($extension) {
    case 'css':
      return file_get_contents($style_file);
      break;

    case 'php':
      ob_start(); require $style_file; return ob_get_clean();
      break;

    case 'scss':
      $compiler = new \Leafo\ScssPhp\Compiler();
      $compiler->setVariables(array(
        'ID' => ID(),
        'LANG' => LANG(),
        'PATH_TO_IMAGES' => PATH_TO_IMAGES(),
        ));
      $compiler->addImportPath(BASE_DIRECTORY . '/common/styles/scss');
      $compiler->addImportPath(PROJECT_DIRECTORY);
      $compiler->addImportPath(BASE_DIRECTORY . '/node_modules/bootstrap-sass/assets/stylesheets');
      $compiler->addImportPath(BASE_DIRECTORY . '/vendor/twbs/bootstrap-sass/assets/stylesheets');

      return complile_scss_with_cache($compiler, $style_file);
      break;

    default:
      throw new Exception("Don't know how to handle this type of style file: ${style_file}", 1);
  }

  return '';

}

if( ! $PROD )
  echo rebase('common/html/pre_' . KrConfig::$CLIENT . '_' . KrConfig::$PAGE_TYPE . '.html');

if ( ! $PROD )
  $STYLES = array_merge($STYLES, $STYLES_ONLY_LOCAL);

echo '<style type="text/css">' ;
if( $PROD ) {
  $css_minifier = new Minify\CSS();

  foreach ($STYLES as $style)
    $css_minifier->add( handle_style_file($style) );

  echo $css_minifier->minify();
} else {

  foreach ($STYLES as $style)
    echo handle_style_file($style);

}
echo '</style>';

foreach ($STYLES_EXTERNAL as $styles_external)
  echo "<link href='${styles_external}' rel='stylesheet' type='text/css'>";

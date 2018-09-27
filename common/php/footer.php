<?php
use MatthiasMullie\Minify;

foreach ($SCRIPTS_EXTERNAL as $script_external)
  echo "<script src='${script_external}'></script>";

echo '<script>';
if( $PROD ) {
  $js_minifier = new Minify\JS();

  foreach ($SCRIPTS as $script)
    $js_minifier->add($script);

  echo $js_minifier->minify();
} else {

  foreach ($SCRIPTS as $script)
    echo file_get_contents($script);

}
echo '</script>';

if( ! $PROD )
  echo rebase('common/html/post_' . KrConfig::$CLIENT . '_' . KrConfig::$PAGE_TYPE . '.html');


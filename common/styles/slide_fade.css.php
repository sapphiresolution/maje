<?php
namespace SlideFade;

if( ! defined('DURATION_IMAGE') )
  define('DURATION_IMAGE', 4);

function getPrefixes() {
  static $prefixes = ['-webkit-', '-moz-', '-o-', ''];
  return $prefixes;
}

function showSlider($pattern) {
  $files = glob($pattern);
  $files = array_map('basename', $files);
  $first = @$files[0];
  rsort($files);
?>
  <div class="slider">
    <img src="images/<?= $first ?>?$staticlink$" class="img-responsive poster" />
    <div class="slides slides_for_<?= count($files) ?>">
    <?php
    foreach($files as $file)
      echo '<img src="images/'.$file.'?$staticlink$" class="img-responsive" />';
    echo '</div></div>';
}

function showCss($nb_items) {
  global $ID;

  echo "#${ID} .slides_for_{$nb_items} img {\n";
  foreach(getPrefixes() as $prefix):
?>
  <?= $prefix ?>animation-duration: <?= DURATION_IMAGE*$nb_items ?>s;
<?php
  endforeach;
  echo "}\n";

  for($i = 1; $i <= $nb_items; $i++):
    $delay = DURATION_IMAGE * ( $nb_items - $i );

    echo '#'.$ID.' .slides_for_'.$nb_items.' img:nth-of-type('.$i.') {'."\n";
    foreach(getPrefixes() as $prefix)
      echo '  '.$prefix.'animation-delay: '.$delay.'s;'."\n";
    echo "}\n";
  endfor;
}

foreach(getPrefixes() as $prefix): ?>
@<?= $prefix ?>keyframes weit_maje_slide_fade {
  0%    { opacity: 1; }
  17%   { opacity: 1; }
  25%   { opacity: 0; }
  92%   { opacity: 0; }
  100%  { opacity: 1; }
}
<?php endforeach; ?>

#<?= $ID ?> .slides img {
<?php foreach(getPrefixes() as $prefix): ?>
  <?= $prefix ?>animation-name: weit_maje_slide_fade;
  <?= $prefix ?>animation-timing-function: ease-in-out;
  <?= $prefix ?>animation-iteration-count: infinite;

<?php endforeach; ?>
}
<?php for($i = 1; $i <= 10; $i++) showCss($i); ?>

html.cssanimations #<?= $ID ?> .slider > .poster {
  visibility: hidden;
}
#<?= $ID ?> .slider {
  position: relative;
}
#<?= $ID ?> .slider > .poster {
  z-index: 1;
  position: relative;
}
#<?= $ID ?> .slides {
  z-index: 2;
  position: absolute;
  margin:0 auto;
  left:0;top:0;right:0;
  height:100%;max-width:100%;
}
#<?= $ID ?> .slides img {
  left:0;
  position:absolute;
}

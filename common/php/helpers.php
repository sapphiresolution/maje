<?php

class ProductHelper {
  public static function product($product_id) {
    global $PRODUCTS;
    return $PRODUCTS[ $product_id ];
  }

  public static function product_name($product_id) {
    return self::product( $product_id )[ 'NAME' ];
  }

  public static function product_url($product_id) {
    return self::product( $product_id )[ 'URL' ];
  }

  public static function product_long_url($product_id) {
    return long_url( self::product_url( $product_id ) );
  }

  public static function product_price($product_id, $with_devise = true) {
    global $PRODUCTS;

    $short_lang = SHORT_LANG();

    $prices = $PRODUCTS[ $product_id ]['PRICE'];
    $price = isset( $prices[ $short_lang ] ) ? $prices[ $short_lang ] : $prices[ 'ALL' ];

    return self::price( $price, $with_devise );
  }

  public static function price($price, $with_devise = true) {
    if(true === $with_devise)
    	return in_array(SHORT_LANG(), ['UK', 'US', 'CH']) ? word('DEVISE_SIGN') . $price : $price . '&nbsp;' . word('DEVISE_SIGN');

    return $price;
  }
}

function ID() { global $ID; return $ID; }
function LANG() { global $LANG; return $LANG; }
function PROD() { global $PROD; return $PROD; }
function SHORT_LANG() { return explode('-', LANG())[0]; }

function PATH_TO_IMAGES() {
  global $PATH_TO_IMAGES;
  return isset($PATH_TO_IMAGES) ? $PATH_TO_IMAGES : ('images/' . ID());
}

function word($id, $raise_if_not_found = true) {
  global $words, $LANG;
  // $raise_if_not_found = true;

  try {
    $temp_words = $words[$id];

    $string = empty( $temp_words[ $LANG ] ) ? $temp_words[ 'ALL' ] : $temp_words[ $LANG ];

    return nl2br($string , false );

  } catch (Exception $e) {
    if(true === $raise_if_not_found)
      throw $e;
    else
      error_log("\t/!\ ERROR /!\\\t/!\ ERROR /!\\\t/!\ ERROR /!\\\t/!\ ERROR /!\\");
      error_log($e->getMessage());
      error_log($e->getTraceAsString());
      return '';
  }
}
function word_responsive($id, $classes = 'hidden-xs hidden-on-mobile') {
  return str_replace('<br>', '<br class="' . $classes . '">', word($id));
}
function duplicate_words($lang_from, $lang_to) {
  global $words;

  foreach ($words as $key => $values) {
    if(empty($values[$lang_to]) && !empty($values[$lang_from]))
      $words[$key][$lang_to] = $values[$lang_from];
  }
}

function long_url($short_url) {
  global $BASE_DOMAIN;

  $short_url = trim($short_url, '$');

  if(PROD()) {
    return "\$${short_url}\$";
  } else {
    $chunks = array_map('trim', explode(',', rtrim($short_url, ')')));

    $type = array_shift($chunks);

    $get_query_string = function($chunks) {
      $string = '';
      foreach ($chunks as $index => $chunk) {
        if($index % 2 === 0) {
          if('' !== $string)
            $string .= '&';
          $string .= $chunk;
        } else {
          $string .= '=' . $chunk;
        }
      }

      return $string;
    };

    $query_string = $get_query_string($chunks);

    switch ($type) {
      case "url(Product-Show":
      case "url('Product-Show'":
      case "httpsurl(Product-Show":
        return 'https://fr-staging.' . $BASE_DOMAIN . '/on/demandware.store/' . KrConfig::$DEMANDWARE_ID . '/fr/Product-Variation?' . $query_string;
        break;

      case "include(Product-GetProductInfo":
        switch($chunks[3]) {
          case 'smcp_subTitle':
            return 'Titre Produit (' . $chunks[1] . ' )';
            break;

          case 'price':
            return 'XXX €';
            break;

        }
        break;

      case "url(Search-Show":
      case "url('Search-Show'":
      case "httpsurl(Search-Show":
        return 'https://fr-staging.' . $BASE_DOMAIN . '/on/demandware.store/' . KrConfig::$DEMANDWARE_ID . '/fr/Search-Show?cgid=' . $chunks[1];
        break;

      default:
        return "\$${short_url}\$";
        break;
    }
  }
}

function kr_spacer($xs = 0, $sm = 0, $md = 0, $lg = 0) {
?>
  <div class="clear kr_spacer">
    <div class="visible-xs" style="height: <?= $xs ?>px">&nbsp;</div>
    <div class="visible-sm" style="height: <?= $sm ?>px">&nbsp;</div>
    <div class="visible-md" style="height: <?= $md ?>px">&nbsp;</div>
    <div class="visible-lg" style="height: <?= $lg ?>px">&nbsp;</div>
  </div>
  <?php
}

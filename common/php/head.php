<?php
require_once dirname(__FILE__).'/../../vendor/autoload.php';

@mkdir('data');

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
date_default_timezone_set('Europe/Paris');

function errHandle($errNo, $errStr, $errFile, $errLine) {
  $msg = "[!] $errStr in $errFile on line $errLine";
  if ($errNo == E_NOTICE || $errNo == E_WARNING) {
    throw new ErrorException($msg, $errNo);
  } else {
    echo $msg;
  }
} set_error_handler('errHandle');

$LANG    = getenv('lang')    ?: 'FR';
$VERSION = getenv('version') ?: 'v1';
$PROD    = getenv('prod') == 'true';
$PROD_ACTIVATED = getenv('prod_activated') == 'true';
$UPLOAD_ACTIVATED = getenv('upload_activated') == 'true';
$words   = [];

class KrConfig {
  const CLIENT_MAJE       = 'maje';
  const CLIENT_SANDRO     = 'sandro';
  const CLIENT_MINELLI    = 'minelli';

  const PAGE_TYPE_HOME    = 'home';
  const PAGE_TYPE_GRID    = 'grid';
  const PAGE_TYPE_LANDING = 'landing';

  public static $CLIENT;
  public static $PAGE_TYPE;
  public static $SUB_DOMAIN;
  public static $BASE_DOMAIN;
  public static $DEMANDWARE_ID;

  public static $is_init = false;

  public static function init($_opts = []) {
    $opts = array_merge([], $_opts);

    self::$CLIENT = $opts['client'];
    self::$PAGE_TYPE = $opts['page_type'];

    switch (self::$CLIENT) {
      case self::CLIENT_MAJE:
        self::$SUB_DOMAIN = 'fr';
        self::$BASE_DOMAIN = 'maje.com';
        self::$DEMANDWARE_ID = 'Sites-Maje-FR-Site';
        break;

      case self::CLIENT_SANDRO:
        self::$SUB_DOMAIN = 'fr';
        self::$BASE_DOMAIN = 'sandro-paris.com';
        self::$DEMANDWARE_ID = 'Sites-Sandro-FR-Site';
        break;

      case self::CLIENT_MINELLI:
        self::$SUB_DOMAIN = 'stg';
        self::$BASE_DOMAIN = 'minelli.fr';
        self::$DEMANDWARE_ID = 'Sites-Minelli-FR-Site';

        if(PROD()) $GLOBALS['PATH_TO_IMAGES'] = 'LP/' . ID() . '/images';
        break;

      default:
        throw new Exception("Wrong configuration. Check your index.php file", 1);
    }

    $GLOBALS['BASE_DOMAIN'] = self::$BASE_DOMAIN;

    self::$is_init = true;
  }
}

$VERSION = str_replace('_', '', $VERSION);

$STYLES_ONLY_LOCAL = [
  'common/styles/fonts.css.php',
  'common/styles/style_for_local_only.scss',
];
$SCRIPTS_ONLY_LOCAL = [
];

$SCRIPTS = [];
$SCRIPTS[] = 'common/scripts/mobile_detection.js';

$SCRIPTS_EXTERNAL = [];
$STYLES_EXTERNAL = [];

$STYLES = [];

require 'helpers.php';
require 'data_loaders.php';
require 'words.php';

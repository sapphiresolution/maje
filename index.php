<?php

define('PROJECT_DIRECTORY', dirname(__FILE__));
define('BASE_DIRECTORY', PROJECT_DIRECTORY );

require 'common/php/head.php';

// CHANGE ME !
$ID = 'kr_';

KrConfig::init([
  'client' => '',
  'page_type' => '',
]);

// SET THIS VARIABLE TO 'TRUE' TO BUST THE CACHE OF SCSS FILES
$BUST_CACHE_FOR_SCSS = false;

// IN CASE YOU NEED TO CHANGE PATH TO IMAGES
// if(PROD()) $PATH_TO_IMAGES = 'LP/' . ID() . '/images/';

// ADD HERE YOUR CUSTOM JS FILES TO INCLUDE (relative paths)
$SCRIPTS[] = 'src/javascripts/script.js';

// ADD HERE YOUR CUSTOM CSS FILES TO INCLUDE (relative paths)
$STYLES[] = 'src/styles/_bootstrap-custom.scss';
$STYLES[] = 'common/styles/global.scss';
$STYLES[] = 'common/styles/global_' . KrConfig::$CLIENT . '.scss';
// $STYLES[] = 'common/styles/mobile_full_width.scss';
$STYLES[] = 'src/styles/style.scss';

load_words(
  'URL',
  '', // URL TO 'URL' CSV GOES HERE
  'data/_urls.php'
  );
load_words(
  'TXT',
  '', // URL TO 'TXT' CSV GOES HERE
  'data/_words.php'
  );
load_products(
  '', // URL TO 'PRODUCTS' CSV GOES HERE
  'data/_products.php'
  );

require 'common/php/header.php';

require 'src/templates.php';
?>

<div class="kr_content_wrapper" id="<?= ID() ?>" data-lang="<?= LANG() ?>" data-lang-short="<?= SHORT_LANG() ?>">
  <div class="container">

    <!-- YOUR HTML CODE GOES HERE -->
	<head>
    <title>Maje - landing page</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <link rel="icon" type="image/png" href="" sizes="32x32">
    <!--icon link-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--css link-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" />
    <!--language chnage js-->
    <script src="js/lang.js"></script>
</head>
<body>
    <div class="header row">
        <!-- Use any element to open/show the overlay navigation menu -->
        <div class="inline-flex-menu">
            <span onclick="openNav()" class="menu">
                <span class="line1"></span>
                <span class="line2"></span>
                <span class="line3"></span>
            </span>
            <div class="menu-content">  menu</div>
        </div>

        <div class="logo">
            <img src="images/logo.png" />
        </div>
        <div class="cart">
            <img src="images/cart-icon.png" />
        </div>
        <div class="lang">
            <select id="cmbLanguage" onchange="setLanguage();">
                <option>ALL</option>
                <option>FR</option>
                <option>UK</option>
                <option>IE</option>
                <option>ES</option>
                <option>DE</option>
                <option>IT</option>
                <option>FL</option>
            </select>
        </div>
        <div class="search">
            <span class="scontent"> Search</span> &nbsp;&nbsp;<i class="material-icons">search</i>
            <label class="expandSearch">
                <input type="text" placeholder="Search..." name="search">
            </label>
        </div>
        <!-- The overlay -->
        <div id="myNav" class="overlay-menu">

            <!-- Button to close the overlay navigation -->
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

            <!-- Overlay content -->
            <div class="overlay-content">
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Clients</a>
                <a href="#">Contact</a>
            </div>

        </div>
    </div>
    <main class="page-wrapper">
        <section class="banner">
            <div class="banner-img"></div>
        </section>

        <section class="row section">
            <div class="col-xl-6 col-md-12 col-sm-12 content">
                <img src="images/Arrière-plan.png" class="mx-auto d-block" data-tilt />
                <p id="TXT_1">
                    Suitable for evening and day wear, these sneakers have a strong nineties feel and are the must-have shoes this autumn. Coolness revisited.
                </p>
                <p>
                    <a href="#"><u id="CTA_DISCOVER">Discover</u></a>
                </p>
            </div>
            <div class="col-xl-6 col-md-12 col-sm-12 image-1">
                <img src="images/basket.png" class="mx-auto d-block" />
            </div>
        </section>

        <section class="section row">
            <div class="col-xl-9 col-md-12 col-sm-12 campaign">
                <img src="images/_MAJE_DOUBLE_NEW9.png" class="img-responsive" />
                <div class="overlay-black">
                </div>
            </div>
            <div class="col-xl-3 col-md-12 col-sm-12 text-center xs-mt-20">
                <h1 id="BLOC_2">
                    campaign
                </h1>
                <p>
                    <a href="#"><u id="CTA_DISCOVER1">Discover</u></a>
                </p>
            </div>
        </section>

        <section class="section row pad-b78">
            <div class="col-xl-4 col-md-4 col-sm-6 xs-w-50">
                <div class="feature-img">
                    <img src="images/product1.png" />
                    <div class="overlay"></div>
                </div>
                <div class="img-content" id="PRODUCT_1">
                    Leather jacket
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-sm-6 xs-w-50">
                <div class="feature-img">
                    <img src="images/product2.png" />
                    <div class="overlay"></div>
                </div>
                <div class="img-content" id="PRODUCT_2">
                    Draped plaid dress
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-sm-6 xs-w-50">
                <div class="feature-img">
                    <img src="images/product3.png" />
                    <div class="overlay"></div>
                </div>
                <div class="img-content" id="PRODUCT_3">
                    Mixed-material sneakers
                </div>
            </div>
        </section>

        <footer class="row">
            <ul class="footer_wrapper">
                <li>
                    lorem  <i class="arrow down"></i>
                </li>
                <li>
                    lorem <i class="arrow down"></i>
                </li>
                <li>
                    lorem <i class="arrow down"></i>
                </li>
                <li>
                    lorem <i class="arrow down"></i>
                </li>
                <li>
                    lorem<i class="arrow down"></i>
                </li>
                <li>
                    lorem<i class="arrow down"></i>
                </li>
            </ul>
            <ul class="footer_bottom">
                <li>
                    lorem ipsum
                </li>
                <li class="before">
                    <i class="material-icons">lock_outline</i>&nbsp;&nbsp;Payment Secure
                </li>
                <li class="before">
                    lorem ipsum
                </li>
            </ul>
        </footer>
    </main>
    <!--js link-->
    <script>
        /* Open when someone clicks on the span element */
        function openNav() {
            document.getElementById("myNav").style.width = "100%";
        }

        /* Close when someone clicks on the "x" symbol inside the overlay */
        function closeNav() {
            document.getElementById("myNav").style.width = "0%";
        }
    </script>
    <script src="js/jquery-3.2.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
</body>

    <?php // require 'common/php/button_top.php'; ?>
  </div>
</div>

<?php require 'common/php/footer.php';

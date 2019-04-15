<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <?php include 'head.php'?>
    <title>BCP</title>
    <!-- CSS -->
    <!-- REVOSLIDER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.min.css" media="screen" />

    <!--  GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700%7COpen+Sans:400,300,700' rel='stylesheet' type='text/css'>

    <!-- ICONS ELEGANT FONT & FONT AWESOME & LINEA ICONS  -->
    <link rel="stylesheet" href="css/icons-fonts.css" >

    <!--  CSS THEME -->
    <link rel="stylesheet" href="css/style.css" >

    <!-- ANIMATE -->
    <link rel='stylesheet' href="css/animate.min.css">

    <!-- IE Warning CSS -->
    <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie-warning.css" ><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="css/ie8-fix.css" ><![endif]-->

    <!-- Magnific popup  in style.css	Owl Carousel Assets in style.css -->

    <!-- CSS end -->

    <!-- JS begin some js files in bottom of file-->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Modernizr -->
    <!-- <script src="js/modernizr.js"></script> -->


  </head>
  <header>

              <?php include 'navbar.php' ?>
          <!-- BUTTON -->

  </header>
  <body>
    
      <!-- STATIC MEDIA IMAGE -->
      <div class="sm-img-bg-fullscr parallax-section" style="background-image: url(images/static-media/BCP.jpg)" data-stellar-background-ratio="0.5" >
        <div class="container sm-content-cont text-center js-height-fullscr">
          <div class="sm-cont-middle">

            <!-- OPACITY container -->
            <div>

                <!-- LAYER NR. 1 -->
                <div class="light-72-wide sm-mb-15 mt-0" >
                    <span class="bold">Business Continuity Plan</span>
                </div>

                <!-- LAYER NR. 2 -->
                <div class="norm-16-wide hide-0-736 sm-mb-50">
                  Always be prepared   
                </div>

                <!-- LAYER NR. 3 -->
                <div class="center-0-478">
                    <a class="button medium hover-dark tp-button gray" href="/login.php">Login</a>
                </div>

            </div>

          </div>
        </div>
      </div>
 
  
      <footer>
        <?php include 'footer.php'?>
        <?php include 'jsboot.php'?>
      </footer>
  
<!-- JS begin -->

<!-- jQuery  -->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<!-- MAGNIFIC POPUP -->
<script src='js/jquery.magnific-popup.min.js'></script>

<!-- PORTFOLIO SCRIPTS -->
<script type="text/javascript" src="js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="js/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="js/masonry.pkgd.min.js"></script>

<!-- COUNTER -->
<script type="text/javascript" src="js/jquery.countTo.js"></script>

<!-- APPEAR -->
<script type="text/javascript" src="js/jquery.appear.js"></script>

<!-- OWL CAROUSEL -->
<script type="text/javascript" src="js/owl.carousel.min.js"></script>

<!-- PARALLAX -->
<script type="text/javascript" src="js/jquery.stellar.min.js"></script>

<!-- MAIN SCRIPT -->
<script src="js/main.js"></script>

<!-- FULL SCREEN MENU -->
<script src="js/fs-menu.js"></script>

<!-- JS end -->
  </body>
</html>
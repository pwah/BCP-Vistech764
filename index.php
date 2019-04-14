<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <?php include 'head.php'?>
    <title>BCP</title>
    <meta charset=utf-8 >

    <!-- OLD TEAM CSS ASSETS -->
    <!-- REVOSLIDER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.min.css" media="screen" />

    <!--  CSS THEME -->
    <link rel="stylesheet" href="css/style.css" >

  </head>
  <header>

              <?php include 'navbar.php' ?>
          <!-- BUTTON -->

  </header>
  <body>
    
  <div id="wrap" class="boxed ">
    <div class="grey-bg">
      
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
    </div>
  </div>
  
  <footer>
    <?php include 'footer.php'?>
    <?php include 'jsboot.php'?>
  </footer>
  
  <!-- JS begin -->
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  
  <!-- PORTFOLIO SCRIPTS -->
  <script type="text/javascript" src="js/imagesloaded.pkgd.min.js"></script>

  <!-- PARALLAX -->
  <script type="text/javascript" src="js/jquery.stellar.min.js"></script>

  <!-- JS end -->
    
  </body>
</html>
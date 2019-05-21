<?php  
session_start();
require('db.php');
require("auth.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <?php include 'head.php'?>
    <title>View BCPs</title>
    <meta charset=utf-8>
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="VISTECH-BCP-B">
    <meta name="description" content="VISTECH-BCP-B">
    <meta name="author" content="P.W.">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- FAVICONS -->
    <link rel="shortcut icon" href="images/favicon/favicon.png">
    <link rel="apple-touch-icon" href="images/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-touch-icon-114x114.png">

    <!--  GOOGLE FONT -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700%7COpen+Sans:400,300,700' rel='stylesheet'
          type='text/css'>

    <!-- ICONS ELEGANT FONT & FONT AWESOME & LINEA ICONS  -->
    <link rel="stylesheet" href="css/icons-fonts.css">

    <!--  CSS THEME -->
    <link rel="stylesheet" href="css/style.css">

    <!-- ANIMATE -->
    <link rel='stylesheet' href="css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/sl-1.2.6/datatables.min.css"/>
	
    <!-- CSS end -->

  </head>
  <body>
    <?php include 'navbar.php' ?>
  
    <div class="container bs-docs-container p-10 col-lg-10 col-lg-offset-1">
            <div class="row">
                <div class="grey-light-bg leave-comment-cont col-lg-12">
                    <!-- TITLE -->
                    <h4 class="blog-page-title mt-50 mb-25">View BCPs</h4>
                    <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group col-lg-12">
                              <div class="col-lg-8">
                                  <table id="bcp" class="display" style="width:100%">
                                  </table>
                                  
                              </div>      
                          </div>
                        </div>
                    </div>

                    <!-- CHANGED CODE FOR THE BUTTONS HERE-->
                    <div class="row">
                        <div class="grey-light-bg leave-comment-cont">
                            <!-- TITLE -->
                            <div class="contact-form-container row">
        
                                <div>
                                    <div>
                                            <button id="btnEditRow" class='button button-full-center medium btn-block'>Edit</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- END CHANGED CODE FOR THE BUTTONS HERE-->
                </div>
            </div>
        </div>
	
    <?php include 'footer.php';?>
    <?php include 'jsboot.php';?>

    <!-- JS begin -->
    <!-- JS begin some js files in bottom of file-->
    <script src="js/modernizr.js"></script> <!-- Modernizr -->

    <!--JQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- Upload CSV script-->
    <script src="js/env.js"></script>

    <!-- Enabling & Disabling filter options script-->
    <script src="js/filtertoggle.js"></script>

    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <!-- Datatable filter API & Jquery-->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/sl-1.2.6/datatables.min.js"></script>

    <!-- jQuery  -->
    <!--<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>-->

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

    <script>

      var dataset = ["1","Program","Clinical","Sys","Activity","1","ImAct","Workarnd","01/01/01","01/01/01","test"];
      var data1 = [dataset];

      //DataTable JS
      $(document).ready(function() {
        var bcptable = $('#bcp').DataTable( {
          "autoWidth": true,
            "scrollX": false,
            "searching": true,
            "select": true,
            "ordering": true,
            "paging": true,
            "info": false,
            "ajax": {
              "dataType": "json",
              "url": "viewbcp.php",
              "dataSrc": "",
            },
            columns: [
            { title: "BCP ID", data: "id" },
            { title: "Program", data: "program_name" },
            { title: "Clinical Unit", data: "clinical_unit" },
            { title: "System", data: "it_system_name" },
            { title: "Activity", data: "activity" },
            { title: "Maintained Duration", data: "mtpd" },
            { title: "Immediate Action", data: "immediate_action" },
            { title: "Workaround", data: "work_around" },
            { title: "Creation Date", data: "creation_date" },
            { title: "Review Date", data: "review_date" },
            { title: "Created By", data: "created_by" },
        ]
        } );
        

        $('#btnEditRow').on( 'click', function () {
          
          var dataArr = [];
          var rows = $('tr.selected');
          var rowData = bcptable.rows(rows).data();
          $.each($(rowData),function(key,value){
              dataArr.push(value["id"]);
          });
          console.log("BCP ID is "+ dataArr);
          
          if(dataArr){
            window.location.href = "newedit.php?bcpid="+dataArr;
          } else {
            alert("Please select a BCP record.");
          }

        } );

      } );

    </script>
    
  </body>

</html>
<?php
session_start();
require_once('db.php');
require_once("auth.php");
// Going to use 'require' rather than include for security purposes, because require will kill the php if it cant get the file, whereas include just produces a warning.
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include 'head.php'?>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="css/style.css" />

        <!-- Bootstrap core CSS -->
        <link href="justincss/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="justinjs/bootstrap.min.js"></script>
        <script src="js/jquery.min.js"></script>
        
        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        </style>

    </head>
    <body>
        <?php include 'navbar.php' ?>

        <div class="container form">
        <br>

        <?php
        if(isset($_SESSION["username"]))
            {
                echo "<div class=\"row p-3\">
                        <div class=\"col-3\">		  
                            <a href=\"/view.php\" class=\"custom-card\">			
                            <div class=\"card card-block align-items-center\">			  	          
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">View BCP Plans</h5>
                                </div>
                                <div id=\"colorstrip-green\">
                                </div>
                                
                                <div style=\"height: 300px\" class=\"row w-100 bg-dark justify-content-center align-items-center\">
                                    <img src=\"images/tracker.png\" width=\"101\" height=\"98\" alt=\"\"/> 
                                </div>
                            </div>
                            </a>
                        </div>";
                //Keep out people who only have view access
            if($_SESSION['priv_level'] >= 10 )   
                {
                    echo "<div class=\"col-6\">
                            <a href=\"/newedit.php\" class=\"custom-card\">
                            <div class=\"card card-block align-items-center\">			  	          
                                <div class=\"card-body\">
                                    <h5 class=\"card-title\">Start New BCP Plan</h5>
                                </div>
                                <div id=\"colorstrip-orange\">
                                </div>
                                <div style=\"height: 300px\" class=\"row w-100 bg-dark justify-content-center align-items-center\">
                                    <img src=\"images/start.png\" width=\"101\" height=\"98\" alt=\"\"/> 
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class=\"col-3\">
                            <a href=\"/append.php\" class=\"custom-card\">
                                <div class=\"card card-block align-items-center\">			  	          
                                    <div class=\"card-body\">
                                        <h5 class=\"card-title\">Reference Tables</h5>
                                    </div>
                                    <div id=\"colorstrip-blue\">
                                    </div>
                                    <div style=\"height: 300px\" class=\"row w-100 bg-dark justify-content-center align-items-center\">
                                        <img src=\"images/search.png\" width=\"101\" height=\"98\" alt=\"\"/> 
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>";                                                       
                }
            echo "</ul>";
            }
        ?>

        </div>
        <?php include 'footer.php'?>
        <?php include 'jsboot.php'?>
    </body>
</html>
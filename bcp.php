<?php  
session_start();
require('db.php');
require("auth.php");
//Test if user is auth'ed to be in this menu if not BAIL out.
if(!$_SESSION['priv_level'] >= 10 )
{
  exit(0);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Append Services</title>
        <?php include 'head.php'?>
        <style>
        .redcolor {
        color:red;
        font-weight: bolder;
        }
        .greencolor {
        color:green;
        font-weight: bolder;
        }
        tr.separated td {
        /* set border style for separated rows */
        border-bottom: 1px solid black;
        } 

        table {
            /* make the border continuous (without gaps between columns) */
            border-collapse: collapse;
        }
        </style>
        <script>
            function InsertAjaxTo(idsendto,getstatement) {
                //USE : IDSENDTO= to the id that you want to insert the get'ed page into
                //USE : getstatement= Is the get request strin in full if you need to pass variables do it in here.
                if (idsendto.length == 0) {
                document.getElementById(idsendto).innerHTML = "";
                return;
                } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById(idsendto).innerHTML = document.write(this.responseText);
                        //let x=document.getElementById(idsendto).innerHTML;
                       // let res = eval(x);
                    }
                };
                xmlhttp.open("GET", getstatement, false);
                xmlhttp.send();
                }
            } 
   
            function UpdatedB(updatestatement,id,update_get_statement){ 
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                                //Now update the specific part of the web page
                                InsertAjaxTo(id,update_get_statement);
                    }
                };
                xmlhttp.open("GET", updatestatement, false);
                xmlhttp.send();
            }

            function LoadNewBCP() {
                InsertAjaxTo("page_here","newbcp.php");
            }

            function LoadEditBCP() {
                InsertAjaxTo("page_here","editbcp.php");
            }

        </script>

    </head>
<body>
    <?php include 'navbar.php' ?>
        
    <main class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="d-md-flex d-block flex-row mx-md-auto mx-0">
            <span class="navbar-brand"></span>
                    <div class="collapse navbar-collapse mr-auto" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <ul class="nav navbar-nav navbar-right"> 
                            <li><a href="newbcp.php" type="button" class="btn btn-primary navbar-btn btn-lg" ><span class="glyphicon glyphicon-check"></span> CREATE BCP</a></li>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   </li>
                            <li><a href="editbcp.php" type="button" class="btn btn-secondary navbar-btn btn-lg" ><span class="glyphicon glyphicon-remove"></span> EDIT EXISTING BCP</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div id="page_here">
        <!-- THIS IS WHERE EITHER THE NEW BCP OR CREATE BCP PAGE GOES -->
        </div>


    <?php include 'footer.php'?>
    <?php include 'jsboot.php'?>
    </main>
</body>
</html>
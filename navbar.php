<nav class="navbar navbar-dark navbar-expand-md bg-dark justify-content-center">  
 <div class="container">
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse1,#navbarCollapse2" aria-controls="navbarCollapse1" aria-expanded="false" aria-label="Toggle navigation">
 <span class="navbar-toggler-icon"></span>
    </button>
    <span class="navbar-text d-flex w-50 mr-auto">
    <?php 
    if(isset($_SESSION["username"])){
            echo "<a href=\"securepage.php\">Home </a>";
          }else {
            echo "<a href=\"index.php\">Home </a>";
          }
    ?></span>

    <div class="collapse navbar-collapse w-100" id="navbarCollapse1">
        <!-- put view/create/reference tables back here if needed -->
        
            <ul class="collapse navbar-collapse navbar-nav ml-auto w-100 justify-content-end" id="navbarCollapse2">
                <?php 

                if(!isset($_SESSION["username"])){
                            
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='register.php'>Register</a>";
                    echo "</li>";
                    echo "<li class='nav-item'>";
                    echo "<a class='nav-link' href='login.php'>Login</a>";
                    echo "</li>";
                    }
                    else
                    {
                        
                        echo "<li class='nav-item'>";
                        echo "<span class='navbar-text'>Account : <a href='selfcare.php'> ".$_SESSION["username"]."</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </span>";
                        echo "</li>";
                        
                        if($_SESSION['priv_level'] == 100 ){
                            //Sort this out later, if user priv == 100
                            echo "<li class='nav-item'>";
                            echo "<span class='navbar-text'><a href='admin.php'>Admin-Menu</a> &nbsp;&nbsp;&nbsp;&nbsp; </span>";
                            echo "</li>";
                        }
                        echo "<li class='nav-item'>";
                        echo "<a class='nav-link' href='logout.php'>Log off</a>";
                        echo "</li>";   
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>

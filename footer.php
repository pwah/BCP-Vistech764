<nav class="navbar fixed-bottom navbar-expand-sm navbar-dark bg-dark">
  <div class="container">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse " id="navbarCollapse">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item active">
        <?php
          if(isset($_SESSION["username"])){
            echo "<a class=\"nav-link\" href=\"securepage.php\">Home </a>";
          }else {
            echo "<a class=\"nav-link\" href=\"index.php\">Home </a>";
          }
        ?>
        </li>
    <li class="nav-item active">
          <a class="nav-link" href="services.php">Services </a>
        </li>
    <li class="nav-item active">
          <a class="nav-link" href="projects.php">Projects </a>
        </li>
    <li class="nav-item active">
          <a class="nav-link" href="contactus.php">Contact Us </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="aboutus.php">About Us</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
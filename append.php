<?php  
session_start();
require('db.php');
require("auth.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <?php include 'head.php'?>
    <title>Append Services</title>
  </head>
  <body>
    <?php include 'navbar.php' ?>
      
    <main class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <span class="navbar-brand span12 text-center" id="admin_type">Add/Remove Business Functions/Systems/etc</span>
    </nav>
               

  </main>

	
  <?php include 'footer.php'?>
  <?php include 'jsboot.php'?>
  
</body>
</html>
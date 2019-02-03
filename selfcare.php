<?php
session_start();
require_once 'db.php';
require_once "auth.php";
require_once "email.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<!doctype html>
<html lang="en">
  <head>
    <?php include 'head.php'; ?>
    <title>Self Care</title>
  </head>
  <body>
    <?php include 'navbar.php'; ?>
    <?php

$username = stripslashes($_SESSION["username"]);
$result = $con->query("SELECT * from users WHERE username='$username'");
$rows = mysqli_num_rows($result);

$row = mysqli_fetch_assoc($result); 
$dB_users_email = $row["email"];
$db_users_firstname = $row["firstname"];
$db_users_lastname = $row["lastname"];
$db_users_email_confirmed = $row["email_confirmed"];
$db_user_priv_level = $row["user_priv_level"];
$db_user_id = $row["id"];
$db_user_old_email = $row["email"];



    if (isset($_REQUEST['firstname'])){
            //Add some HTML
            ?>
                <main class="container">
                <div class="jumbotron">
                <h1>Self Care</h1>
                <br>
                <?php
            //HTML added
        $username = stripslashes($_REQUEST['username']);
        $password = stripslashes($_REQUEST['password']);
        $firstname = stripslashes($_REQUEST['firstname']);
        $lastname = stripslashes($_REQUEST['lastname']);
        $email = stripslashes($_REQUEST['email']);

        $newpw = hash ( 'sha256', $password);

        // Begin test for duplicate accounts //
        $query = "SELECT * FROM `users` WHERE username='$username' AND id <>'$db_user_id'";
        $result = mysqli_query($con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if($rows>=1)    {
                                echo "<div class='container form'> <h3>You have entered a username that is already in use.</h3> <br/>Click here to try <a href='selfcare.php'>again</a></div>";
                                exit(0); //exit now
                        }
        $query = "SELECT * FROM `users` WHERE email='$email'AND id <> '$db_user_id'";
        $result = mysqli_query($con,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if($rows>=1)    {
                                echo "<div class='container form'> <h3>You have entered an email address that is already in use.</h3> <br/>Click here to try <a href='selfcare.php'>again</a></div>";
                                exit(0); //exit now                   
                        }

      
                        
        $query = "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', username='$username', password='$newpw'  WHERE email ='$db_user_old_email'";
         $result = mysqli_query($con,$query);         

        if($dB_users_email != $email)   {     
                                           
                                                //NEED TO CONFIRM NEW EMAIL ADDRESS SO SEND A NEW CONFIRM CODE AND EMAIL
                                                $confirmcode = date("Y-m-d-h-i-s");
                                                $confirmcode = hash ( 'sha256', $confirmcode);
                                              
                                                $query = "UPDATE users SET email_confirmed='0', confirm_code='$confirmcode'  WHERE email ='$email'";
                                                $result = mysqli_query($con,$query); 
                                                

                                                $sql = "SELECT mail_from_addr, domain_name FROM configuration";
                                                            $result = mysqli_query($con, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            $mail_from_addr = $row["mail_from_addr"];
                                                            $domain_name = $_SERVER['SERVER_NAME'];
                                                
                                                $email_body = "<html> Hi<br> This Email has been automatically generated as part of a update request to the web site <b>".$domain_name.".</b><br><br> Please click the link below to register your new Email Address.<br><br> <a href=http://".$_SERVER['SERVER_NAME']."/register.php?emailconfirmcode=".$confirmcode.">".$confirmcode."</a>";                 
                                                emailto($email,$mail_from_addr,$mail_from_addr,'BCP Password Confirmation',$email_body);
                                              
                                                exit(0);
                                        }else{
                                                echo "<h3>Your details have been updated<h3>";
                                        }
                //FINISH OFF THE HTML FOR PROPER PAGE FORMATTING
                ?>
                </div>
                </main>
                        
                <?php include 'footer.php'?>
                <?php include 'jsboot.php'?>
                
                </body>
                </html>
                <?php
        exit(0);

    }

    ?>
    <main class="container">
      <div class="jumbotron">
        <h1>Self Care</h1>

        <div class="container form">
                                                <!-- form user info -->
                                                <div class="card card-outline-secondary">
                                                        <div class="card-header">
                                                                <h3 class="mb-0">Update your details</h3>
                                                        </div>
                                                        <div class="card-body">
                                                                <form class="form" autocomplete="off" name="update"  method="post">
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" name="firstname" type="text" value="<?php echo $db_users_firstname; ?>" required />
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" name="lastname" type="text" value="<?php echo $db_users_lastname; ?>" required />
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" name="email" type="email" value="<?php echo $dB_users_email; ?>" required />
                                                                        </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" name="username" type="text" value="<?php echo $username; ?>" required />
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">New Password</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control"  pattern=".{4,32}" minlength=4 title="Password should be between 4 and 32 characters" name="password" type="password" id="password" required />
                                                                        </div>
                                                                        </div>
 
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                                                        <div class="col-lg-9">
                                                                                
                                                                                <input type="submit" class="btn btn-primary" value="Update">
                                                                        </div>
                                                                        </div>
                                                                </form>
                                                        </div>
                                                </div>
                                                <!-- /form user info -->
                                        </div>

      </div>
    </main>
	
    <?php include 'footer.php'?>
    <?php include 'jsboot.php'?>
    
  </body>
</html>  
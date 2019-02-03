<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once 'head.php';
require_once 'email.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<title>Registration</title>

</head>
<body>



<script>                      
        function validateForm(){
                                        var pw = document.forms["registration"]["password"].value;
                                        var cp = document.forms["registration"]["confirm_password"].value;
                                        if( pw.localeCompare(cp) == 0 )
                                        {
                                                return;
                                        }else   {
                                                        alert("Your password's do not match");
                                                        return false;
                                                }
                                }
                        
</script>

<?php require_once 'navbar.php' ?>

<div class="container form">

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['emailconfirmcode'])){

        $confirmcode = stripslashes($_GET['emailconfirmcode']);
        $sql = "SELECT * FROM `users` WHERE confirm_code='$confirmcode'";
        $result = mysqli_query($con, $sql); 
        $rows = mysqli_num_rows($result);
        if($rows == 0)  {
                        // IF THE CODE FAILS THEN GIVE USER AN OPTION TO GET A NEW CODE USING THE FORGET LOGON PAGE SYSTEM.
                            echo "<h2>Your confirmation code is invalid</h2>. <br>Please try the link again or use the forgot logon form to generate a new confirmation key to submit. Please <a href='forgotlogon.php'>try again.</a> </h2></div></div></div>";
                        }else {
                                //LETS UPDATE THE dB to Say the user's email is valid.
                                $query = "UPDATE users SET confirm_code='', email_confirmed='1' WHERE confirm_code ='$confirmcode'";
                                $result = mysqli_query($con,$query);
                                echo "<h2>Your confirmation code has been accepted.</h2><br>Please <a href='login.php'>LOGIN</a></h2></div></div></div>";

                        }

exit(0);
}


if (!isset($_REQUEST['username'])){
                                ?>
                                        
                                        <h1>Registration</h1>

                                                <!-- form user info -->
                                                <div class="card card-outline-secondary">
                                                        <div class="card-header">
                                                                <h3 class="mb-0">Register Here</h3>
                                                        </div>
                                                        <div class="card-body">
                                                                <form class="form" autocomplete="off" name="registration" onsubmit="return validateForm()" method="post">
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" name="firstname" type="text" placeholder="First Name" required />
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" name="lastname" type="text" placeholder="Last Name" required />
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" name="email" type="email" placeholder="Your Email Address" required />
                                                                        </div>
                                                                        </div>

                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" name="username" type="text" placeholder="Username" required />
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" pattern=".{4,32}" minlength=4 name="password" title="at least 4 to 32 characters"  type="password" id="password" required />
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label">Confirm Password</label>
                                                                        <div class="col-lg-9">
                                                                                <input class="form-control" pattern=".{4,32}" minlength=4 name="confirm_password" title="at least 4 to 32 characters" type="password" id="confirm_password" required />
                                                                        </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                                                        <div class="col-lg-9">
                                                                                <input type="reset" class="btn btn-secondary" value="Cancel">
                                                                                <input type="submit" class="btn btn-primary" value="Register">
                                                                        </div>
                                                                        </div>
                                                                </form>
                                                        </div>
                                                </div>
                                                <!-- /form user info -->
                                        </div>
                                        
                                <?php
                                 }else {
                                                // removes backslashes
                                                $username = stripslashes($_REQUEST['username']);
                                                //escapes special characters in a string
                                                $username = mysqli_real_escape_string($con,$username); 
                                                //Continue this to prevent SQL attacks.
                                                $email = stripslashes($_REQUEST['email']);
                                                $email = mysqli_real_escape_string($con,$email);

                                                $password = stripslashes($_REQUEST['password']);
                                                $password = mysqli_real_escape_string($con,$password);
                                                // Hash the password before storing. sha256=64 character hash
                                                $password = hash ( 'sha256', $password);

                                                $firstname = stripslashes($_REQUEST['firstname']);
                                                $firstname = mysqli_real_escape_string($con,$firstname);

                                                $lastname = stripslashes($_REQUEST['lastname']);
                                                $lastname = mysqli_real_escape_string($con,$lastname);

                                                $today = date("Y-m-d");

                                                // Begin test for duplicate accounts //
                                                $query = "SELECT * FROM `users` WHERE username='$username'";
                                                $result = mysqli_query($con,$query) or die(mysql_error());
                                                $rows = mysqli_num_rows($result);
                                                if($rows>=1)    {
                                                                        echo "<div class='container form'> <h3>You have entered a username that is already in use.</h3> <br/>Click here to try and <a href='register.php'>Register again</a></div>";
                                                                        exit(0); //exit now
                                                                }
                                                $query = "SELECT * FROM `users` WHERE email='$email'";
                                                $result = mysqli_query($con,$query) or die(mysql_error());
                                                $rows = mysqli_num_rows($result);
                                                if($rows>=1)    {
                                                                        echo "<div class='container form'> <h3>You have entered an email address that is already in use.</h3> <br/>Click here to try and <a href='register.php'>Register again</a></div>";
                                                                        exit(0); //exit now                   
                                                                }

                                                $sql = "SELECT self_register, self_reg_priv_level FROM configuration";
                                                $result = mysqli_query($con, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                $self_register = $row["self_register"];
                                                $self_reg_priv_level = $row["self_reg_priv_level"]; 

                                                
                                                $registercode = date("Y-m-d-h-i-s");
                                                $registercode = hash ( 'sha256', $registercode);
                                                // Update the recovery hash code into the table for the user.
                                                

                                                
                                                $sql = "SELECT mail_from_addr, domain_name FROM configuration";
                                                $result = mysqli_query($con, $sql);
                                                $row = mysqli_fetch_assoc($result);
                                                $mail_from_addr = $row["mail_from_addr"];
                                                $domain_name = $_SERVER['SERVER_NAME'];


                                                $email_body = "<html> Hi<br> This Email has been automatically generated as part of a registration request to the web site <b>".$domain_name.".</b><br><br> Please click the link below to register your account fully.<br><br> <a href=http://".$_SERVER['SERVER_NAME']."/register.php?emailconfirmcode=".$registercode.">".$registercode."</a>";                 
                                                emailto($email,$mail_from_addr,$mail_from_addr,'BCP Password Confirmation',$email_body);
                                                if ($self_register == true)     {
                                                                                        $query = "INSERT into `users` (username, password, email, firstname, lastname, creation_date,account_active,user_priv_level) VALUES ('$username', '$password', '$email', '$firstname', '$lastname', '$today', '1', '$self_reg_priv_level')";
                                                                                        $result = mysqli_query($con,$query);
                                                                                        if($result)     {
                                                                                                echo "<div class='container form'><h3>Thank you for sucessfully registering, an email address confirmation letter has been sent to the email address provided. Please check it to progress your registration.</h3><br/>Click here to <a href='login.php'>Login</a></div>";     
                                                                                                $query = "UPDATE users SET confirm_code='$registercode' WHERE email ='$email'";
                                                                                                $result = mysqli_query($con,$query);  
                                                                                                        }
                                                                                }else   {
                                                                                                //if self register is not enabled. An admin must activate the account manually and manually adjust user priv level.
                                                                                                //code to register, but not activate.
                                                                                                $query = "INSERT into `users` (username, password, email, firstname, lastname, creation_date,account_active,user_priv_level) VALUES ('$username', '$password', '$email', '$firstname', '$lastname', '$today', '0', '0')";
                                                                                                $result = mysqli_query($con,$query);
                                                                                                if($result)     {
                                                                                                                       
                                                                                                                      
                                                                                                                echo "<div class='container form'><h3>Thank you for sucessfully registering, an email address confirmation letter has been sent to the email address provided. Please check it to progress your registration.</h3><br/>Click here to <a href='login.php'>Login</a></div>";                                                                                                                
                                                                                                                $query = "UPDATE users SET confirm_code='$registercode' WHERE email ='$email'";
                                                                                                                $result = mysqli_query($con,$query);
                                                                                                                }

                                                                                        }
                                                
                                                                                } ?>                     
    <?php include 'footer.php'?>
    <?php include 'jsboot.php'?>
</body>
</html>
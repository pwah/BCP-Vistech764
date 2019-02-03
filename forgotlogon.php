<?php
if (isset($_REQUEST['email'])){ 
                                include "email.php";
                                ?>
                                <!doctype html>
                                    <html lang="en">
                                    <head>
                                        <?php require 'head.php'?>
                                        
                                        <title>Password Recovery</title>
                                        <style>
                                        
                                        </style>
                                    </head>
                                    <body>
                                    <?php require 'navbar.php' ?>
                                    <main class="container">
                                        <div class="jumbotron">
                                        <?php


                                    $email = stripslashes($_REQUEST['email']);
                                  
                                    $sql = "SELECT * FROM `users` WHERE email='$email'";
                                    $result = mysqli_query($con, $sql);
                                    $rows = mysqli_num_rows($result);
                                    if ($rows==0){
                                        // No users by that name in the dB..
                                        echo "<h2>Sorry, but no one registered by that email address is listed.</h2>";
                                        echo "<h3><a href='forgotlogon.php'>Click here</a> to try again</h3>";
                                    }else{
                                        //So we have a legit user. Make a new recovery code(using date/time) and update it into the dB
                                        //Then send an email with the recovery code to the email address.
                                        $recoverycode = date("Y-m-d-h-i-s");
                                        $recoverycode = hash ( 'sha256', $recoverycode);
                                        // Update the recovery hash code into the table for the user.

                                        $query = "UPDATE users SET confirm_code='$recoverycode' WHERE email ='$email'";
                                        $result = mysqli_query($con,$query);
                                        if($result)     {
                                                            // get details from the managament dB
                                                            $sql = "SELECT mail_from_addr, domain_name FROM configuration";
                                                            $result = mysqli_query($con, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            $mail_from_addr = $row["mail_from_addr"];
                                                            $domain_name = $_SERVER['SERVER_NAME'];
                                                                                                                        
                                                            $email_body = "<html> Hi<br> This Email has been automatically generated as part of a request to reset your password for the web site <b>".$domain_name.".</b><br><br> Please click the link the recovery key below to take you to the password reset page.<br><br> <a href=http://".$_SERVER['SERVER_NAME']."/recovery.php?thekey=".$recoverycode.">".$recoverycode."</a>";
                                                            emailto($email,$mail_from_addr,$mail_from_addr,'BCP Password Recovery',$email_body);
                                                            echo "<h3>A password recovery email has been sent to : ".$email."</h3><br>";
                                                            //a$ = "<a href = ' ";
                                                            echo "<h2> <a href = 'http://".$domain_name." '>Click here to return to the main page</a> </h2>";
                                                        }

                                       
                                    }
                                    //Close off the HTML
                                    echo "</div></main></body></html>";
}else{
    //HTML UP THE PAGE
?>
    <!doctype html>
    <html lang="en">
      <head>
        <?php require 'head.php'?>
        
        <title>Password Recovery</title>
        <style>
        
        </style>
      </head>
      <body>
      <?php require 'navbar.php' ?>



      <main class="container">
      <div class="jumbotron">
        <h1>Password Recovery</h1>
       

                    <!-- form card reset password -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Password Reset</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" autocomplete="off" method="post">
                                <div class="form-group">
                                    <label for="inputResetPasswordEmail">Email</label>
                                    <input type="email" class="form-control" name="email" id="inputResetPasswordEmail" required="">
                                    <span id="helpResetPasswordEmail" class="form-text small text-muted">
                                            Password reset instructions will be sent to this email address.
                                        </span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg float-right">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /form card reset password -->


        
      </div>
    </main>
    <?php require 'footer.php'?>
    <?php require 'jsboot.php'?>
</body>
</html>
<?php   unset ($_REQUEST['email']);   } ?>
 
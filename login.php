<!doctype html>
<html lang="en">
  <head>
    <?php require 'head.php'?>
    <title>Login</title>
    <!-- Bootstrap core CSS -->
    <script src="js/jquery.min.js"></script>
  </head>
  <body>
  <?php require 'navbar.php' ?>
  <?php
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
                                        // removes backslashes
                                        $username = stripslashes($_REQUEST['username']);
                                        //escapes special characters in a string
                                        $username = mysqli_real_escape_string($con,$username);
                                        $password = stripslashes($_REQUEST['password']);
                                        $password = mysqli_real_escape_string($con,$password);
                                        
                                        // next we encrypt the user's password as a sha256(=64 characters) hash, we could also salt it here or better yet double hash it !
                                        $password = hash ( 'sha256', $password);


                                        //Checking is user existing in the database or not
                                        // NOTE $row and $rows
                                        $sql = "SELECT * FROM `users` WHERE username='$username'and password='".$password."'";
                                        $result = mysqli_query($con, $sql);
                                        $rows = mysqli_num_rows($result);

                                        //if the rows reterned = 1 then the account must exist, but we need to check that the account is correctly activated etc before enabling the session.
                                        if($rows ==1){ 
                                        
                                                        $row = mysqli_fetch_assoc($result); 
                                                        // need this data to make a decision weather user is active if not tell user what the issue is.
                                                        $dB_users_id = $row["id"];
                                                        $dB_users_username = $row["username"];
                                                        $dB_users_account_active = $row["account_active"];
                                                        $dB_users_user_priv_level = $row["user_priv_level"]; 
                                                        $db_users_email_confirmed = $row["email_confirmed"];
                                                        $db_users_account_administratively_disabled = $row["account_administratively_disabled"];

                                                        //Get configuration data...                                                  
                                                        $sql = "SELECT self_register, self_activate FROM configuration";
                                                        $result = mysqli_query($con, $sql);
                                                        $rows = mysqli_num_rows($result);
                                                        // Get config data so to give appropriate error messages
                                                        $db_configuration_self_register = $row["self_register"];
                                                                                                                                            
                                                        if($db_users_account_administratively_disabled == true){
                                                          echo "<div class='form'><h3>Your account has been administratively disabled. Please contact your administrator if there is an issue</h3><br/>Click here to go back to the <a href='index.php'>Main Page</a></div>";
                                                          exit(0);
                                                        } 

                                                        if($dB_users_account_active == false){
                                                          echo "<div class='form'><h3>Your account is not activated yet</h3><br/>Click here to go back to the <a href='index.php'>Main Page</a></div>";
                                                          exit(0);
                                                        } 

                                                        // If code has made it this far then the user is good to go, and the last logon date will be updated and the user directed to the main secure page.
                                                        // Set the last user logon day
                                                        $_SESSION['username'] = $dB_users_username;
                                                        $_SESSION['priv_level'] = $dB_users_user_priv_level;

                                                        $today = date("Y-m-d");
                                                        $sql = "UPDATE users SET last_login='$today' WHERE username='$username'";
                                                        if (mysqli_query($con, $sql)) {
                                                                                          echo "Record updated successfully";
                                                                                        } else  {
                                                                                                  echo "Error updating record: " . mysqli_error($con);
                                                                                                }
                                                        mysqli_close($con);
                                                        // End the last user logon day

                                                        // Redirect user to index.php                            
                                                        header("Location: securepage.php");
                                                        exit(0); //Browser should have jumped prior to this point
                                                      }else   {
                                                                      // if $rows!=0 e.g there was no account.
                                                                      echo "<div class='form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href='login.php'>Login</a></div>";
                                                              }
                                }else{
                                ?>
                                <div class="container form">
                                          <h1>Log In</h1>
   

                                          <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Login</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="loginForm"  method="POST" name="login">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required />
                                    <div class="invalid-feedback">Please enter your username or email</div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" id="password"  placeholder="Password" required />
                                    <div class="invalid-feedback">Please enter a password</div>
                                </div>

                                <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Login</button>
                                <p>Not registered yet? <a href='register.php'>Register Here</a></p>
                                          <p>Forgot your logon details? <a href='forgotlogon.php'>Click Here</a></p>
                                          
                            </form>
                        </div>
                        <!--/card-body-->
                    </div>
                    <!-- /form card login -->

                                </div>

                                <?php } ?>

<?php require 'footer.php'?>
<?php require 'jsboot.php'?>
</body>

</html>


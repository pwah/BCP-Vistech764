<!doctype html>
<html lang="en">
<head>
<?php require 'head.php'?>
<title>BCP Passsword recovery</title>
<style>
</style>
</head>
<body>

  <?php require 'navbar.php' ?>
<div class="container form">
    <div class="jumbotron">

  <?php
  require('db.php');
    // This is the password recovery system
if (isset($_POST['password'])){
                                //Now that we have the key and now also the new password lets update the dB and let the user know its done.
                                $key = stripslashes($_GET['thekey']);
                                $newpw = stripslashes($_POST['password']);
                                $newpw = hash ( 'sha256', $newpw);

                                
                                $sql = "SELECT * FROM users WHERE confirm_code ='$key'";
                                $result = mysqli_query($con, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $username = $row["username"];


                                $sql = "UPDATE users SET password='$newpw' WHERE confirm_code ='$key'";
                                $result = mysqli_query($con, $sql);

                                $sql = "UPDATE users SET confirm_code ='' WHERE username='$username'";
                                $result = mysqli_query($con, $sql);
                                        
                                echo "<h2>Password updated.</h2> Please <a href='login.php'>LOG IN.</a> </div></div></body></html>";
                                                                
                                    exit(0);
                                }

    if (isset($_GET['thekey'])) {
                                $key = stripslashes($_GET['thekey']);
                                $sql = "SELECT * FROM `users` WHERE confirm_code='$key'";
                                $result = mysqli_query($con, $sql);
                                $row = mysqli_fetch_assoc($result);
                                $theemail = $row["email"];
                            
                                $rows = mysqli_num_rows($result);
                                if($rows == 0)  {
                                                    echo "<h2>Your recovery key is invalid. If your need to recovery your lost password please <a href='forgotlogon.php'>try again.</a> </h2></div></div></body></html>";
                                                }else { ?>

                                                        <div class="card card-outline-secondary">
                                                            <div class="card-header">
                                                                <h3 class="mb-0">Password Reset form for Email address : <?php echo $theemail; ?></h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <form class="form" autocomplete="off" id="ResetForm"  method="POST" name="recover">
        
                                                                    <div class="form-group">
                                                                        <label>Password</label>
                                                                        <input type="password" class="form-control" name="password" id="password"  placeholder="Password" pattern=".{4,32}" minlength=4 title="at least 4 to 32 characters" required />
                                                                        <div class="invalid-feedback">Please enter a password</div>
                                                                    </div>
                                                                    <button type="submit" class="btn btn-success btn-lg float-right" id="btnReset">RESET</button>       
                                                                </form>
                                                            </div>
                                                        </div>    
                                                    
        </div>
    </div>
</body>
</html>
                                                <?php }  

                                }

?>
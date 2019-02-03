<?php
session_start();
require('db.php');
require("auth.php");

// THIS PAGE SHOULD INCLUDE EDITING OF SYSTEM CONFIGS
// ALT PAGE IS USER MANAGAMENT
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head.php'; ?>
        
        <title>System Admin Page</title>
       <style>
       </style>

    <script>
    function changetitle($name){
        document.getElementById('admin_type').innerHTML = $name;
    }
    </script>
    </head>
    <body>
        <?php include 'navbar.php'; ?>
        <div class="container">

            <?php 
            include 'adminnavbar.php';
         
            // Control the menu selection so you always end back at the right menu and defaults to adminmenu if you havent been in their yet.
                if (isset($_POST['user']))  {
                                                $_SESSION["adminmenu"] = "user";
                                            }
                if (isset($_POST['admin'])) {
                                                    $_SESSION["adminmenu"] = "adminmenu";
                                            }
                if (!isset($_SESSION["adminmenu"])){
                    $_SESSION["adminmenu"] = "adminmenu";
                }

            
            //Admin has updated a record
            if(isset($_POST['usersemail']) ){
                //Lets update the user dB entry from the form "usersettings"
                $accid = stripslashes($_POST['userid']);
                $accemail = stripslashes($_POST['usersemail']);
                $accfirstname = stripslashes($_POST['usersfname']);
                $acclastname = stripslashes($_POST['userslname']);
                $accactive = stripslashes($_POST['usersaccact']);
                $accpriv= stripslashes($_POST['usersprivlevel']);
                $accemailconfim = stripslashes($_POST['usersemailconf']);
                $accadmindis = stripslashes($_POST['usersadmindis']);
               
                //update dB
                $query = "UPDATE users SET email='$accemail', firstname='$accfirstname', lastname='$acclastname', account_active='$accactive', user_priv_level='$accpriv', email_confirmed='$accemailconfim', account_administratively_disabled='$accadmindis' WHERE id ='$accid'";
               

                $result = mysqli_query($con,$query);

               
                echo "<script>alert('User Account Update completed-->');</script>"; 

                unset($_POST['userid']);
                unset($_POST['usersemail']);
                unset($_POST['usersfname']);
                unset($_POST['userslname']);
                unset($_POST['usersaccact']);
                unset($_POST['usersprivlevel']);
                unset($_POST['usersemailconf']);
                unset($_POST['usersadmindis']);
                

            }



            if(isset($_POST['mailhost'])){
                //Then user has submitted changes to the admin 
                $mailhost = stripslashes($_POST['mailhost']);
                $mailport = stripslashes($_POST['mailport']);
                $useauth = stripslashes($_POST['useauth']);
                $mailusername = stripslashes($_POST['mailusername']);
                $mailpassword = stripslashes($_POST['mailpassword']);
                $fromaddr = stripslashes($_POST['fromaddr']);
                $selfregister = stripslashes($_POST['selfregister']);
                $privlevel = stripslashes($_POST['privlevel']);
                $domainname = stripslashes($_POST['domainname']);
                //update dB
                $query = "UPDATE configuration SET mail_host='$mailhost', mail_port='$mailport', mail_use_auth='$useauth',mail_username='$mailusername', mail_password='$mailpassword', mail_from_addr='$fromaddr', self_register='$selfregister', self_reg_priv_level='$privlevel', domain_name='$domainname' WHERE id ='0'";
                $result = mysqli_query($con,$query);
                //unset POST variables.
                unset($_POST['mailhost']);
                unset($_POST['mailport']);
                unset($_POST['useauth']);
                unset($_POST['mailusername']);
                unset($_POST['mailpassword']);
                unset($_POST['fromaddr']);
                unset($_POST['selfregister']);
                unset($_POST['privlevel']);
                unset($_POST['domainname']);
                echo "<script>alert('Update completed');</script>";       
            }


            if ($_SESSION["adminmenu"] == "user"){

                // Update the running menu note.
                echo "<script>changetitle('User Admin');</script>";
                //Get names from dB
                $result = $con->query ("SELECT id,firstname,lastname FROM users");
                //create a select table

                ?>

                <form name='user' method='post'>
                    <div class="row">
                        <div class="col-md-12 school-options-dropdown text-center">
                        <h2>Select a user</h2>
                            <div class="dropdown btn-group">
                                <select class='form-control' name='id' style='width:auto;'>
                                    <?php
                                                            if (isset($_POST['id'])){
                                                                                        $selectedid = stripslashes($_POST['id']);
                                                                                    }
                                                            while ($row = $result->fetch_assoc()) {
                                                                unset($id, $fname, $lname);
                                                                $id = $row['id'];
                                                                $fname = $row['firstname'];
                                                                $lname = $row['lastname']; 
                                                                if($selectedid == $id){
                                                                    echo "<option name='nameid' value='$id' selected>$fname&nbsp;$lname</option>"; 
                                                                }else{
                                                                    echo "<option name='nameid' value='$id'>$fname&nbsp;$lname</option>";
                                                                }
                                                            }
                                    ?>

                                </select>&nbsp;&nbsp;&nbsp; 
                                <button type='submit' class='btn btn-success float-right' id='btnLogin'>Select</button>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <?php

                //IF post data exits show user data/form..
                if (isset($_POST['id']))
                {
                    $selectedid = stripslashes($_POST['id']);
                  

                    $sql = "SELECT * FROM `users` WHERE id='$selectedid'";
                    $result = mysqli_query($con, $sql);
                    //$rows = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result); 
                    
                    $db_users_username = $row["username"];
                    //skip password(its hashed !)
                    $dB_users_email = $row["email"];
                    $db_users_firstname = $row["firstname"];
                    $db_users_lastname = $row["lastname"];
                    $db_users_creationdate = $row["creation_date"];
                    $db_users_lastlogin = $row["last_login"];
                    $db_users_account_active = $row["account_active"];
                    $db_user_priv_level = $row["user_priv_level"];
                    $db_users_email_confirmed = $row["email_confirmed"];
                    $db_user_priv_level = $row["user_priv_level"];
                    $db_users_admindisable = $row["account_administratively_disabled"];
         
?>


<form class="form" name="usersettings" method="post">
                        <table class="table table-striped">

                            <thead>
                                <tr>
                                    <th>Variable</th>
                                    <th>Current Value</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Account ID</td>
                                    <td><?php echo $_POST['id']; ?></td>
                                    <td><input type="hidden" name="userid" value="<?php echo $_POST['id']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>E-Mail Host Name</td>
                                    <td><?php echo $dB_users_email; ?></td>
                                    <td><input type="text" name="usersemail" value="<?php echo $dB_users_email; ?>"></td>
                                </tr>
                                <tr>
                                    <td>First Name</td>
                                    <td><?php echo $db_users_firstname; ?></td>
                                    <td><input type="text" name="usersfname" value="<?php echo $db_users_firstname; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td><?php echo $db_users_lastname; ?></td>
                                    <td><input type="text" name="userslname" value="<?php echo $db_users_lastname; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Account Creation Date</td>
                                    <td><?php echo $db_users_creationdate; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Last Login Date</td>
                                    <td><?php echo $db_users_lastlogin; ?></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Account Active</td>
                                    <td><?php echo $db_users_account_active; ?></td>
                                    <td><input type="text" name="usersaccact" value="<?php echo $db_users_account_active; ?>">*to-be-fixed*</td>
                                </tr>
                                <tr>
                                    <td>Account Priviledge Level</td>
                                    <td><?php echo $db_user_priv_level; ?></td>
                                    <td><input type="text" name="usersprivlevel" value="<?php echo $db_user_priv_level; ?>">*to-be-fixed*</td>
                                </tr>
                                <tr>
                                    <td>Account Email Confirmed</td>
                                    <td><?php echo $db_users_email_confirmed ; ?></td>
                                    <td><input type="text" name="usersemailconf" value="<?php echo $db_users_email_confirmed ; ?>">*to-be-fixed*</td>
                                </tr>
                                <tr>
                                    <td>Administrativly Disabled</td>
                                    <td><?php echo $db_users_admindisable ; ?></td>
                                    <td><input type="text" name="usersadmindis" value="<?php echo $db_users_admindisable; ?>">*to-be-fixed*</td>
                                </tr>

                            </tbody>
                        </table>
                        
                        <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Update User Account</button>
                    </form>

<?php

                }                                        

                

               //$_POST['user']='true';  
                 //   exit(0);
                } elseif ($_SESSION["adminmenu"] == "adminmenu") {
                    //This is the default menu
                    // Updat the name of the menu type
                    echo "<script>changetitle('System Admin');</script>";
                    // Display a table with all the menu items
                    $sql = "SELECT * FROM `configuration` WHERE id='0'";
                    $result = mysqli_query($con, $sql);
                    //$rows = mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result); 

                    $db_conf_mail_host = $row["mail_host"];
                    $db_conf_mail_port = $row["mail_port"];
                    $db_conf_mail_use_auth = $row["mail_use_auth"];
                    $db_conf_mail_username = $row["mail_username"]; 
                    $db_conf_mail_password = $row["mail_password"];
                    $db_conf_mail_from_addr = $row["mail_from_addr"];
                    $db_conf_self_register = $row["self_register"]; 
                    $db_conf_self_reg_priv_level = $row["self_reg_priv_level"];
                    $db_conf_domain_name = $row["domain_name"];

                    //Password hidden with Astrix's
                    $db_conf_hiddenpassword = str_repeat("*", strlen($db_conf_mail_password)); 

                    ?>
                    <form class="form" name="systemsettings" method="post">
                        <table class="table table-striped">

                            <thead>
                                <tr>
                                    <th>Variable</th>
                                    <th>Current Value</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>E-Mail Host Name</td>
                                    <td><?php echo $db_conf_mail_host; ?></td>
                                    <td><input type="text" name="mailhost" value="<?php echo $db_conf_mail_host; ?>"></td>
                                </tr>
                                <tr>
                                    <td>E-Mail Host Port #</td>
                                    <td><?php echo $db_conf_mail_port; ?></td>
                                    <td><input type="text" name="mailport" value="<?php echo $db_conf_mail_port; ?>"></td>
                                </tr>
                                <tr>
                                    <td>E-Mail Use Authorization</td>
                                    <td><?php echo $db_conf_mail_use_auth; ?></td>
                                    <td><input type="text" name="useauth" value="<?php echo $db_conf_mail_use_auth; ?>">*to-be-fixed*</td>
                                </tr>
                                <tr>
                                    <td>E-Mail Username</td>
                                    <td><?php echo $db_conf_mail_username; ?></td>
                                    <td><input type="text" name="mailusername" value="<?php echo $db_conf_mail_username; ?>"></td>
                                </tr>
                                <tr>
                                    <td>E-Email Authorization Password</td>
                                    <td><?php echo $db_conf_hiddenpassword; ?></td>
                                    <td><input type="password" name="mailpassword" value="<?php echo $db_conf_mail_password; ?>"  ></td>
                                </tr>
                                <tr>
                                    <td>E-Mail From Address</td>
                                    <td><?php echo $db_conf_mail_from_addr; ?></td>
                                    <td><input type="text" name="fromaddr" value="<?php echo $db_conf_mail_from_addr; ?>"></td>
                                </tr>
                                <tr>
                                    <td>Enable Self Register for users</td>
                                    <td><?php echo $db_conf_self_register; ?></td>
                                    <td><input type="text" name="selfregister" value="<?php echo $db_conf_self_register; ?>">*to-be-fixed*</td>
                                </tr>
                                <tr>
                                    <td>Self Registering users default privilegde level</td>
                                    <td><?php echo $db_conf_self_reg_priv_level; ?></td>
                                    <td><input type="text" name="privlevel" value="<?php echo $db_conf_self_reg_priv_level; ?>">*to-be-fixed*</td>
                                </tr>
                                <tr>
                                    <td>Domain Name or IP address of server</td>
                                    <td><?php echo $db_conf_domain_name; ?></td>
                                    <td><input type="text" name="domainname" value="<?php echo $db_conf_domain_name; ?>"></td>
                                </tr>

                            </tbody>
                        </table>
                       
                        <button type="submit" class="btn btn-success btn-lg float-right" id="btnLogin">Update System Config</button>
                    </form>
                    <?php
                }
            
            ?>

        </div>
        
        <?php //include 'footer.php'; ?>
        <?php include 'jsboot.php'; ?>
    </body>
</html>
<?php
    require_once('db.php');
    require_once "Mail.php";
    // using PHP PEAR PLUGIN FOR EMAIL

    // format :  emailto($to,$from,$replyto,$subject,$body);
 

   

    //Go to the configuration table and get the email config data.
    $sql = "SELECT * FROM configuration where id='0'";
                                                            //echo $sql;
                                                            $result = mysqli_query($con, $sql);
                                                            $row = mysqli_fetch_assoc($result);
                                                            //$rows = mysqli_num_rows($result);
                                                            
                                                            $config_mail_host = $row["mail_host"];
                                                            $config_mail_port =$row["mail_port"];
                                                            $config_mail_use_auth = $row["mail_use_auth"];
                                                            $config_mail_username =$row["mail_username"];
                                                            $config_mail_password =$row["mail_password"];
                                                            $config_mail_from_addr =$row["mail_from_addr"];


    function emailto($to,$from,$replyto,$subject,$body)     {
                                                            // global allows access to global variables outside the function
                                                            global $config_mail_host, $config_mail_port, $config_mail_use_auth, $config_mail_username, $config_mail_password, $config_mail_from_addr;
                                                            $mime = '1.0';
                                                            $ctype = 'text/html;charset=UTF-8';
                                                            
                                                            $headers = array(
                                                                'From' => $from,
                                                                'To' => $to,
                                                                'Subject' => $subject,
                                                                'Reply-To' => $replyto,
                                                                'MIME-Version' => $mime, 
                                                                'Content-Type' => $ctype
                                                            );
                                                            
                                                            //$sql  = 'SELECT `id`, `mail_host`, `mail_port`, `mail_use_auth`, `mail_username`, `mail_password`, `mail_from_addr`, `self_register`, `self_reg_priv_level` FROM `configuration` WHERE 1';
                                                            
                                                            $smtp = Mail::factory('smtp', array(
                                                                    'host' => $config_mail_host,
                                                                    'port' => $config_mail_port,
                                                                    'auth' => true,
                                                                    'username' => $config_mail_username,
                                                                    'password' => $config_mail_password
                                                                ));
                                                            $mail = $smtp->send($to, $headers, $body);
                                                            if (PEAR::isError($mail))   {
                                                                                                return FALSE;
                                                                                        } else  {
                                                                                                
                                                                                                return TRUE;
                                                                                                }
                                                           
                                                            } 

    
?>


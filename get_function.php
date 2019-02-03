<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    //session_start();
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }

$catagory = $_GET['catagory'];

$sql="SELECT * FROM cat_func WHERE catagory = '".$catagory."'";
$idval=0;
if ($result = $con->query($sql))    {
                                        echo "[Function]<br><select name='catfunc' id='func' name='function'>";
                                            while ($row = $result->fetch_assoc())   {   
                                                                                        $idval++;
                                                                                        $function = $row['function'];
                                                                                        $rowid = $row['id'];
                                                                                        echo "<option value='$rowid'>$function</option>";
                                                                                    }
                                    //add a blank function value as it may not need one
                                            echo "<option value='$idval'></option>";

                                        echo "</select>";
                                    }
?>
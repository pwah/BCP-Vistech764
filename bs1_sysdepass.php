<?php  
    require("auth.php");
    require('db.php');
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }
?>

    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'head.php'?>
        <title> SYSTEM DEPENDANCY ASSESSMENT</title>

        <script>
            function ShowClinical(str) {
                //Lets fill out the clinical options based on the bu_program
                if (str.length == 0) {
                    document.getElementById("clinical").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("clinical").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "get_clinical.php?program=" + str, true);
                    xmlhttp.send();
                }
            }

            function ShowFunction(str) {
                //Lets fill out the function based 
                if (str.length == 0) {
                    document.getElementById("function").innerHTML = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("function").innerHTML = this.responseText;
                        }
                    };
                    xmlhttp.open("GET", "get_function.php?catagory=" + str, true);
                    xmlhttp.send();
                }
            }

            function UpdateCatFun(id)   {
                                        var xmlhttp = new XMLHttpRequest();
                                        xmlhttp.onreadystatechange = function() {
                                                                                if (this.readyState == 4 && this.status == 200) {
                                                                                                                                var myObj = JSON.parse(this.responseText);
                                                                                                                                $corp= myObj[0];
                                                                                                                                $func= myObj[1];
                                                                                                                                var dd = document.getElementById('catagory');
                                                                                                                                
                                                                                                                                for (var i = 0; i < dd.options.length; i++) {                     
                                                                                                                                                                            if (dd.options[i].text === $corp)   {
                                                                                                                                                                                                                dd.selectedIndex = i;
                                                                                                                                                                                                                break;
                                                                                                                                                                                                                }
                                                                                                                                                                            }
                                                                                                                                document.getElementById("catagory").selectedIndex = dd.selectedIndex; 
                                                                                                                                dd = document.getElementById('func');
                                                                                                                                for (i = 0; i < dd.options.length; i++) {                     
                                                                                                                                                                        if (dd.options[i].text === $func)   {
                                                                                                                                                                                                            dd.selectedIndex = i;
                                                                                                                                                                                                            break;
                                                                                                                                                                                                            document.getElementById("func").selectedIndex = dd.selectedIndex; 
                                                                                                                                                                                                            }
                                                                                                                                                                        } 
                                                                                                                                }
                                                                                }
                                        xmlhttp.open("GET", "get_clinical_func.php?id="+id, true);
                                        xmlhttp.send(); 
                                        }

                function ShowDependanceInfo(id) {
        
                                                if (id.length == 0) {
                                                    document.getElementById("dependanceid").innerHTML = "";
                                                    return;
                                                } else {
                                                    var xmlhttp = new XMLHttpRequest();
                                                    xmlhttp.onreadystatechange = function() {
                                                        if (this.readyState == 4 && this.status == 200) {
                                                            document.getElementById("dependanceid").innerHTML = this.responseText;
                                                        }
                                                    };
                                                    xmlhttp.open("GET", "get_dependance.php?id=" + id, true);
                                                    xmlhttp.send();
                                                }
                                            }

                function fixaction() {
                                    // THE USER HAS PRESSED THE SUBMIT BUTTON, SO TIME TO DO SOME CLEANUP MAGIC

                                    //IF USER HAS PUT IN A CUSTOM ACTIVITY THEN GOOD, ELSE COPY THE ACTIVTY NAME FROM THE DROPDOWN TO THE TEXTAREA BOX AS THAT IS WHAT IS SUBMITTED POST STYLE..
                                    var act = document.getElementById("activity");
                                    var cust_act = document.getElementById("custom_activity").value;
                                    var acttext = act.options[act.selectedIndex].text;
                                  
                                    if (cust_act.length == 0 )  {
                                                                    //Just copy the name of the dropdown to the textarea so its parsed to the next stage POST style
                                                                    document.getElementById("custom_activity").value = acttext;

                                                                }else {
                                                                        // UPDATE the end user dB with the new activity.
                                                                        var x=new XMLHttpRequest();
                                                                        x.open("GET", "put_activity.php?cust_act=" + cust_act, false); 
                                                                        x.send();
                                                                      }
                                    //END THE TEXTAREA CLEANUP


                                    //So being cheeky, use this to change the values of dropdowns to the text of the current dropdowns to POST to next area             
                                    //Start with the System
                                    var sysnametext = document.getElementById("1system").options[act.selectedIndex].text;
                                    var sysname = sysnametext.split("-", 1);
                                    document.getElementById("1system").options[act.selectedIndex].value = sysname;
                                    //Next the system
                                    var catagory = document.getElementById("catagory").options[act.selectedIndex].text;
                                    document.getElementById("catagory").options[act.selectedIndex].value = catagory;       
                                   //Next the catagory/function
                                    var catfunc = document.getElementById("func").options[act.selectedIndex].text;
                                    document.getElementById("func").options[act.selectedIndex].value = catfunc; 

                                    //Next the Business unit
                                    var bu = document.getElementById("bu").options[act.selectedIndex].text;
                                    document.getElementById("bu").options[act.selectedIndex].value = bu; 

                                    //The Activity is already text so no need to play with that

                                    //Next the Sub Program of tyhe BU aka clinical unit
                                    var subclinical = document.getElementById("subclinic").options[act.selectedIndex].text;
                                    document.getElementById("subclinic").options[act.selectedIndex].value = subclinical; 

                                    //Next the system dependancy
                                    var dependancy = document.getElementById("dependancy").options[act.selectedIndex].text;
                                    document.getElementById("dependancy").options[act.selectedIndex].value = dependancy; 

                                    }
        </script>
    </head>
    <body>
    <?php include 'navbar.php' ?>
        
    <main class="container">
        
    <p class="text-lg-left font-weight-bold" id="top_text">The system dependency assessment identifies the business area's activities that are dependent on the respective systems.  The worksheet captures the assessed dependency that the activities have on each system under normal operations, and the level of that dependency. 
    </p>

    </main>


<form onsubmit="fixaction()" method="post" action="bs2_bia.php" >
    <div class="container form-group">


        <table class="table">
            <tr>
                <th>Dependancy</th>
                <th>Content</th>
                <th></th>
                <th>Your freetext input</th>
            </tr>
            <tr style="background-color:rgb(255, 153, 153)">
                <td class="font-weight-bold">1. System</td>
                <td>
                    <?php
                        //FILL OUT THE SYSTEM SELECT MENU FROM THE DB
                        $result = $con->query("select id, it_system_name, it_system_description from system_register ORDER BY it_system_name");
                            echo "<select name='system' id='1system' style='width: 200px' onchange='UpdateCatFun(this.options[this.selectedIndex].value)'> ";
                                while ($row = $result->fetch_assoc()) {
                                                    unset($id, $name, $desc);
                                                    $id = $row['id'];
                                                    $name = $row['it_system_name']; 
                                                    $desc = $row['it_system_description'];
                                                    echo '<option value="'.$id.'" >'.$name.'---'.$desc.'</option>';
                                                    }                                     
                                    echo "</select>";
                                    
                    ?>
                </td>
                <td></td>
                <td></td>
            </tr>


            <tr style="background-color:rgb(255, 153, 153)">
                <td class="font-weight-bold">2. System Function</td>
                <td>[System Catagory]<br>

                <?php

                    //FILL OUT THE SYSTEM CATAGORYS FROM THE DB
                    $result = $con->query("select id, catagory from catagory ORDER BY catagory ASC");
                    echo "<select id='catagory' name='catagory' onchange='ShowFunction(this.options[this.selectedIndex].text)'>";
                    
                    while ($row = $result->fetch_assoc()) {
                                                            unset($id, $program);
                                                            $id = $row['id'];
                                                            $catagory = $row['catagory']; 

                                                            echo '<option value="'.$id.'" >'.$catagory.'</option>';
                                                                                    
                                                            }
                    echo "</select>";
                    ?>------->

                </td>
                <td id="function"></td>
                <td></td>
                
            </tr>

            <tr style="background-color:rgb(200, 153, 153)">
                <td class="font-weight-bold">3. Business Unit/Program</td>
                <td>
                    <?php
                    //FILL OUT THE BUSINESS UNIT/PROGRAMS DROPDOWNS
                    $result = $con->query("select id, program_name from program ORDER BY program_name ASC");
                    echo "<select id='bu' name='buprog'  onload='ShowClinical(Aged Care)' onchange='ShowClinical(this.options[this.selectedIndex].text)'>";
                    
                    while ($row = $result->fetch_assoc()) {
                                                            unset($id, $program);
                                                            $id = $row['id'];
                                                            $program = $row['program_name']; 

                                                                                    echo '<option value="'.$id.'" >'.$program.'</option>';
                                                                                
                                                            }
                    echo "</select>";
                    ?> 
                </td>
                <td></td>
                <td></td>
            </tr>

            <tr style="background-color:rgb(200, 153, 153)">
                <td class="font-weight-bold">4. Sub Program/Clinical Unit</td>
                <td id="clinical">SELECT A BUSINESS UNIT</td>
                <td></td>
                <td></td>
                
            </tr>

            <tr style="background-color:rgb(255, 153, 102)">
                <td class="font-weight-bold">5. Activity</td>
                <td>
                <?php
                //FILL OUT THE ACTIVITIES DROPDOWN MENU
                    $result = $con->query("select id, activity from activity ORDER BY activity ASC");
                    echo "<select id='activity'>";
                    
                    while ($row = $result->fetch_assoc())   {
                                                            unset($id, $program);
                                                            $id = $row['id'];
                                                            $activity = $row['activity']; 
                                                            echo '<option value="'.$id.'" >'.$activity.'</option>';                      
                                                            }
                                                            echo '<option value="9999"></option>';     
                    echo "</select>";
                    ?>

                </td>

                <td class="text-center">Or Enter Your Own</td>
                <td><textarea rows="2" cols="30" id="custom_activity" name="activity"></textarea></td>
            </tr>
        
            <tr style="background-color:rgb(255, 153, 102)">
                <td class="font-weight-bold">Activity Dependence<br>On system</td>
                <td>
                <?php
                    // FILL OUT THE DEPENDANCY SELECT DROPDOWN
                    $result = $con->query("select * from dependancy_rating ORDER BY id");
                    echo "<select size='1' id='dependancy' name='dependancy' onchange='ShowDependanceInfo(this.options[this.selectedIndex].value)'>";
                    
                    while ($row = $result->fetch_assoc())   {
                                                                unset($id, $program);
                                                                $id = $row['id'];
                                                                $scale = $row['scale'];
                                                                $level = $row['level'];
                                                                $description= $row['description'];
                                                                $summary= $row['summary'];
                                                                echo '<option value="'.$id.'">'.$scale.' --- '.$level.'</option>';                                                                    
                                                            }
                    echo "</select>";
                    echo "</td><td colspan='2'><textarea rows='4' cols='80' id='dependanceid'  disabled></textarea></td>";

                    ?>
               
            <tr>
                <td>
                    
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        </table>
        <div class="row">
        
        <input type="submit" value="Go to next page"  class="btn btn-primary">
        </div>
        <br>
    </div>
</form>


    <script>

        // This gets executed as the last part of end-of-loading the page and we need to tidy/sync the page up so appropritae default dropdowns etc are shown.      

        //Update via ajax the Clinical Units based on the default Business unit shown                                            
        var  e = document.getElementById ( "bu" );
        var  strUser = e.options [e.selectedIndex].text;
        ShowClinical(strUser);

        //Update via ajax the system functions based on the default catagory                                                   
        e = document.getElementById ( "catagory" );
        strUser = e.options [e.selectedIndex].text;
        ShowFunction(strUser);

        //Because the dB is not in 3NF I need to do some text compares from the dropdowns and select the correct defaults from a table in the dB to the System/Function                                                    
        UpdateCatFun(0);

        //Display summary text about the activity dependance based on the selected(default 1 in this case)                                                    
        ShowDependanceInfo(1);


    </script>
    <?php //include 'footer.php'?>
    <?php include 'jsboot.php'?>       
    </body>
    </html>
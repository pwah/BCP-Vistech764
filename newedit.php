<?php  
session_start();
require('db.php');
require("auth.php");
//Test if user is auth'ed to be in this menu if not BAIL out.
if(!$_SESSION['priv_level'] >= 10 )
{
  exit(0);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Append Services</title>
        <?php include 'head.php'?>
        <style>
        .redcolor {
        color:red;
        font-weight: bolder;
        }
        .greencolor {
        color:green;
        font-weight: bolder;
        }
        tr.separated td {
        /* set border style for separated rows */
        border-bottom: 1px solid black;
        } 



        </style>
        <script>
          var is_existing_bcp = false;

            function InsertAjaxTo(idsendto,getstatement) {
                //USE : IDSENDTO= to the id that you want to insert the get'ed page into
                //USE : getstatement= Is the get request strin in full if you need to pass variables do it in here.
                if (idsendto.length == 0) {
                document.getElementById(idsendto).innerHTML = "";
                return;
                } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById(idsendto).innerHTML =this.responseText;
                    }
                };
                xmlhttp.open("GET", getstatement, false);
                xmlhttp.send();
                }
            } 
   
            function UpdatedB(updatestatement,id,update_get_statement){ 
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                                //Now update the specific part of the web page
                                InsertAjaxTo(id,update_get_statement);
                    }
                };
                xmlhttp.open("GET", updatestatement, false);
                xmlhttp.send();
            }

            function GetExistingBCP(id){
              //Using the id which is from the bcp table, get all the data from the dB and Populate fields
              //... TODO

            }
            function CheckExistingBCP(){
              var  clinical = document.getElementById("cu");
              var  id_clin = clinical.options [clinical.selectedIndex].value;
              //var clin_program = id_clin.getAttribute('data-program_name');

              var  system = document.getElementById("selectsystemname");
              var  id_sys = system.options [system.selectedIndex].value;

              var  activity = document.getElementById("activities");
              var  id_act = activity.options [activity.selectedIndex].value;

              var get_statement="get_existingbcp_id.php?id_clinical="+id_clin+"&id_system="+id_sys+"&id_activity="+id_act;
              
              var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("exitingbcpid").innerHTML = this.responseText;
                      if (this.responseText!=0)
                      {
                        GetExistingBCP(this.responseText);
                      }          
                    }
                }
                xmlhttp.open("GET", get_statement, false);
                xmlhttp.send();

            }

            function CheckPriAct(){
              var custom_act_text = document.getElementById("cust_act_input").value;
              if (custom_act_text != "" || activities != null){
                //Disable/enable select depedning on text in the custom
                document.getElementById("activities").disabled = true; 
                document.getElementById("new_act_mtpd").disabled = false; 
                      
              }
              if (custom_act_text == "" || activities == null){
                document.getElementById("activities").disabled = false;
                document.getElementById("new_act_mtpd").disabled = true; 
              }

            }

            function OnChangePreReq(){
              //CLINICAL UNIT-PROGRAM
              var  clinical = document.getElementById("cu");
              var  id_clin = clinical.options [clinical.selectedIndex];
              var clin_program = id_clin.getAttribute('data-program_name');
              document.getElementById("associated_program").innerHTML = clin_program;
              document.getElementById("program_name").value = clin_program;

              //SYSTEM MTPD
              var  system = document.getElementById("selectsystemname");
              var  id_sys = system.options [system.selectedIndex];
              var system_mtpd = id_sys.getAttribute('data-mtpd');
              var system_info = id_sys.getAttribute('data-sysdescr');
              document.getElementById("systems_info").innerHTML = system_info;
              //Now we need to display the MTPD 'NAME' in the right spot.
              InsertAjaxTo("systems_mtpd", "get_mtpd_by_id.php?idname="+system_mtpd);

             
              //ACTIVTY MTPD
              var  activity = document.getElementById("activities");
              var  id_act = activity.options [activity.selectedIndex];
              var act_mtpd = id_act.getAttribute('data-mtpd');
              InsertAjaxTo("activities_mtpd", "get_mtpd_by_id.php?idname="+act_mtpd);

              //REFRESH THE DEPENDANCY
              var  dependancy = document.getElementById("the_dependancy");
              var  id_dependancy = dependancy.options [dependancy.selectedIndex];
              var data_desc = id_dependancy.getAttribute('data-description');
              document.getElementById("depedancy_info").innerHTML = data_desc;

              //REFRESH THE IMPACT RATINGS
              var  impact = document.getElementById("the_impact_ref");
              var  id_impact = impact.options [impact.selectedIndex];
              var  pe = id_impact.getAttribute('data-pe');
              var  fi = id_impact.getAttribute('data-fi');
              var  rep = id_impact.getAttribute('data-rep');
              var  so = id_impact.getAttribute('data-so');
              var  lc = id_impact.getAttribute('data-lc');
              var  mi = id_impact.getAttribute('data-mi');

              pe = "<b>People Effects </b>"+pe +"<br>";
              fi = "<b>Financial Impact </b>"+fi +"<br>";
              rep = "<b>Reputation </b>"+rep +"<br>";
              so = "<b>Service Outputs </b>"+so +"<br>";
              lc = "<b>Legal Compliance </b>"+lc +"<br>";
              mi = "<b>Managament Impact </b>"+mi +"<br>";
             


              document.getElementById("impact_info").innerHTML = pe+fi+rep+so+lc+mi;
              CheckExistingBCP();
             
              //IF WE MATCH AN EXISTING BCP THEN

              //FILL OUT THE is_existing_bcp
             }

        </script>

    </head>
<body>
    <?php include 'navbar.php' ?>
        
    <main class="container">
     <div class="container jumbotron jumbotron-fluid">
     <h1 class="display-4">Create / Edit BCP's</h1>


      <div class="table-responsive">
      <form action="submitbcp.php" method="POST">
      <div class="form group">
      <table class="table">
      <tr>
        <td></td> 
        <td></td>
        <td style="text-align: right; "id="exitingbcpid"><input type="hidden" id="existingbcpid" name="existingbcpid"></td>
      </tr>
      <tr>
        <td><b>SELECT CLINICAL UNIT</b><input type="hidden" id="program_name" name="program_name"></td> 
        <td id="clinical_unit_select"></td>
        <td><b>Assocated Program : &nbsp;</b><span id="associated_program"></span></td>

      </tr>
      <tr>
        <td><b>SELECT SYSTEM</b></td>
        <td id="system_select"></td>
        <td><b>Default MTPD : &nbsp;</b><span id="systems_mtpd"></span> </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><b>System Information : &nbsp;</b><span id="systems_info"></span> </td>
      </tr>
      <tr>
        <td><b>SELECT ACTIVITY</b></td>
        <td id="activity_select"></td>
        <td><b>Default MTPD : &nbsp;</b><span id="activities_mtpd"></span></td>
      </tr>
      <tr>
        <td><b>CUSTOM ACTIVITY</b></td>
        <td id="custom_activity"> <input id="cust_act_input" name="cust_act_input" oninput="CheckPriAct()" placeholder="A new activity" ></td>
        <td><b>Custom Activities MTPD : &nbsp;</b><span id="cust_act_mtpd"></span></td>
      </tr>
      <tr>
        <td><b>DEPENDANCY RATING</b></td>
        <td id="insert_dependency_rating"></td>
        <td id="depedancy_info" class="small"></td>
      </tr>
      <tr>
            <td><b>IMPACT RATING</b></td>
            <td id="impact_rating"></td>
            <td id="impact_info" class="small"></td>
      </tr>
      <tr>
            <td><b>IMMEDIATE ACTION</b></td>
            <td colspan="2"><div class="form-group"><textarea name="immediate_action" class="form-control" style="min-width: 100%; resize: none;" rows="6" placeholder="What you need to do immediatly when the system breaks..." ></textarea></div></td>
            
      </tr>
      <tr>
            <td><b>PRE-REQUISITE</b></td>
            <td colspan="2"><div  class="form-group"><textarea name="pre_req" class="form-control" style="min-width: 100%; resize: none;" rows="6" placeholder="What you need on hand (and in preperation for) in order to work-around the issue..."></textarea></div></td>
          
      </tr>
      <tr>
            <td><b>WORK-AROUND</b></td>
            <td colspan="2"><div  class="form-group"><textarea name="work_around" class="form-control" style="min-width: 100%; resize: none;" rows="6" placeholder="What is the long term work-around until the problem is resolved..."></textarea></div></td>
            
      </tr>

      </table>
      <button type="submit" class="btn btn-primary  btn-lg btn-block" name="bcpsubmit" >Submit</button>
     </div>
      </form>
      </div>
  
     



      
      <script >

      //AJAX LOAD HERE
      //Load Programs
     // InsertAjaxTo("clinical_unit_select", "get_option_programs.php?idname=programoptions&option=onchange='OnChangePreReq()'");
      InsertAjaxTo("clinical_unit_select", "get_clinicalunit.php?idname=cu&option=onchange='OnChangePreReq();'");

      //Load Systems
      InsertAjaxTo("system_select", "get_system_option.php?idname=selectsystemname&option=onchange='OnChangePreReq()'");

      //Load Activities
      InsertAjaxTo("activity_select", "get_activities.php?idname=activities&option=onchange='OnChangePreReq()'");

      //Insert the custom activities mtpd select-options on the page.
      InsertAjaxTo("cust_act_mtpd", "get_mtpd.php?idname=new_act_mtpd&option=onchange=''");

    //INSERT DEFAULT DEPENDANCY RATING
      InsertAjaxTo("insert_dependency_rating", "get_dependancy_ratings.php?idname=the_dependancy&option=onchange='OnChangePreReq()'");

      //INSERT IMPACT REF
      InsertAjaxTo("impact_rating", "get_impact_reference.php?idname=the_impact_ref&option=onchange='OnChangePreReq()'");

      OnChangePreReq();
      </script>
      </div>

      
    <?php //include 'footer.php'?>
    <?php include 'jsboot.php'?>
  </main>
</body>
</html>

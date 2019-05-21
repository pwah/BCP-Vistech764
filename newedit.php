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
              //IF YOU ARE AT THIS FUNCTION THEN WE KNOW WE NEED TO GET THE BCP AND BLAT ITS DATA ONTO THE FORM.
              // WE NEED TO SET THE FORMS   *existingbcpid* value to the BCP ID to tell the submit to do an UPDATE as opposed to an INSERT
                
             
                  var xmlhttp = new XMLHttpRequest();
                  xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                      var retreivedbcp = JSON.parse(this.responseText);
                      Dump_dB_BCP_to_page(this.responseText);
                    }
                  };
                  xmlhttp.open("GET", "get_existingbcp_full.php?id="+id, true);
                  xmlhttp.send();
   
            }


            function Dump_dB_BCP_to_page(thejsonarray){
            //THIS FUNTION GETS A JSON ARRAY AND DISPLAYS IT TO THE WEB FORM TABLE.
            //Should be 13 items at this point in time.
            myObj = JSON.parse(thejsonarray);
                id =myObj.id
                program_id = myObj.program_id;
                clinical_unit_id = myObj.clinical_unit_id;
                system_id = myObj.system_id;
                activity_id = myObj.activity_id;
                mtpd_id = myObj.mtpd_id;
                dependancy_rating_id = myObj.dependancy_rating_id;
                impact_rating_id = myObj.impact_rating_id;
                immediate_action = myObj.immediate_action;
                pre_requisites =myObj.pre_requisites;
                work_around = myObj.work_around;
                creation_date = myObj.creation_date;
                review_date = myObj.review_date;
                created_by = myObj.created_by;
                // SO WE NEED TO PUSH THIS DATA INTO THE TEXTAREA'S / INPUTS / OPTION & misc areas
                //document.getElementById("").innerHTML = 
                //document.getElementById("xx").value = 

                
            }

            function CheckExistingBCP(){
              //SO IF THE USER HAPPENS TO SELECT THE SAME 3X MAIN OPTIONS AS SOMETHING ALREADY IN THE BCP DATABASE THEN WE NEED TO DEAL WITH THAT SO THIS ROUTINE CHECKS THE DB TO SEE IF WE ARE SELECTING A PRE-EXISTING BCP
              // IF SO GET THE BCP AND HAND OFF TO THE GETEXISTINGBCP(id of the BCP) AND UPDATE THE PAGE

              //SO LETS GET THE 3X KEY ITEMS AND CHECK
              var  clinical = document.getElementById("cu");
              var  id_clin = clinical.options [clinical.selectedIndex].value;
              //var clin_program = id_clin.getAttribute('data-program_name');

              var  system = document.getElementById("selectsystemname");
              var  id_sys = system.options [system.selectedIndex].value;

              var  activity = document.getElementById("activities");
              var  id_act = activity.options [activity.selectedIndex].value;

              //ok if user has put in a new activity, alter the id to zero !
              //this needs to be done B4 we do a call to check in the dB !
              var custom_act_text = document.getElementById("cust_act_input").value;
              if (custom_act_text != "" ){
                //THIS IS A BIT EVIL BUT WILL WORK
                id_act =0;
              }

              var get_statement="get_existingbcp_id.php?id_clinical="+id_clin+"&id_system="+id_sys+"&id_activity="+id_act;
              
              var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                      //THIS IS IF WE *DO* HAVE AN EXISTING BCP, THEN TO DISPLAY THE ID OF THE EXISTING BCP IN THE FORM TABLE
                      document.getElementById("exitingbcpid").innerHTML = this.responseText;

                      //OK LETS TEST TO SEE IF THERE IS A RESPONCE OTHER THAN ZERO AS THAT WILL INDICATE THAT ITS AN EXISTING BCP
                      if (this.responseText!=0)
                      {
                        //SO WE KNOW WE NEED TO GET THE BCP DATA FROM THE DATABASE
                        GetExistingBCP(this.responseText);
                      }          
                    }
                }
                xmlhttp.open("GET", get_statement, false);
                xmlhttp.send();

            }

            function CheckPriAct(){
              //THIS GETS CALLED WHEN THE ACTIVITY TEXT BOX IS ALTERED
              var custom_act_text = document.getElementById("cust_act_input").value;
              
              if (custom_act_text != "" ){
                //Disable/enable select depedning on text in the custom
                document.getElementById("activities").disabled = true; 
                document.getElementById("new_act_mtpd").disabled = false; 
                      
              }
              if (custom_act_text == "" ){
                //IF THE TEXT BOX IS EMPTY
                document.getElementById("activities").disabled = false;
                document.getElementById("new_act_mtpd").disabled = true; 
                //This might not be good but will get by
                document.getElementById("new_act_mtpd").value = 1;
              }

              //Should call existingBCP as it will be need to be checked
            CheckExistingBCP();


            }

            function OnChangePreReq(){
              //CLINICAL UNIT-PROGRAM
              var  clinical = document.getElementById("cu");
              var  id_clin = clinical.options [clinical.selectedIndex];
              var clin_program = id_clin.getAttribute('data-program_name');
              var programid = id_clin.getAttribute('data-programid');
              document.getElementById("associated_program").innerHTML = clin_program;
              document.getElementById("program_name").value = clin_program;
              document.getElementById("sendprogramid").value = programid;


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
              //Refresh the page
              CheckExistingBCP();
             
              //IF WE HAVE AN EXISTING BCP, REFRSSH
              // NOW TEST FOR BCP ACTIVATION

              //FILL OUT THE is_existing_bcp
             }



             function getUrlParameter(name) {
               //name id the paramter we are interested in
              name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
              var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
              var results = regex.exec(location.search);
              return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
             };



             function GetBCPBecasePageGetID(){
              bcpid = getUrlParameter('bcpid')
              if (bcpid != null)
              {
                //OK THEN WE NEED TO GO AND GET THE BCP AND PRE-FILL
                // LETS SET is_existing_bcp TO TRUE SO UPDATES BECOME AN UPDATE
                is_existing_bcp = true
                //NOW LETS UPDATE ALL
                //...
              }
            
            //alert(c);
             }

            // exitingbcpid   -- ID of BCP
            // program_name -- A HIDDEN INPUT BOX FOR THE PHYSICA PROGRAM NAME, NOT DIRECTLY USED IN THE DB
            // cu  -- CLINICAL UNIT OPTION BOX (has data-program_name and data-programid and id(value of the selected clinical unit)
            // associated_program -- AN id of the area the Associated Program assocaiated to a clinical program is located
            // selectsystemname -- AN Id of a OPTION box holding the system name, and hidden data data-sysdescr which is the info about the system
            // systems_mtpd -- AN ID of a <TD> that hold the default MTPD of a system
            // systems_info -- an id of a <SPAN> that hold the selected systems misc info..IS changed when the system is refreshed
            // activity_select -- An ID of a <td> that holds the option menu for activities
            // activities -- The selected activity
            // activities_mtpd -- A <span> id for holding the default MTPD for the given activity
            // cust_act_input -- An INPUT id to hold a CUSTOM activity
            // new_act_mtpd -- An input for CUSTOM activities MTPD.
            // the_dependancy -- An ID for an option box for the bcp's depenency rating 1-5, Hold hidden data data-summary / data-level / data-description / data-scale
            // depedancy_info -- An TD Id holdting the_depenancies data-description
            // the_impact_ref -- An option box id holding values 1-5 and hidden data for display in 'impact_info'
            // impact_info -- A TD id holding info from the_impact_ref
            // immediate_action -- THE TEXT-AREA BOX holding the Immediate action info
            // pre_req -- The TEXTAREA BOX holding the Pre-Requisite info
            // work_around -- THE TEXTAREA BOX holding the Work-Around info

        </script>

    </head>
<body>
    <?php include 'navbar.php' ?>
        
    <main class="container">
     <div class="container jumbotron jumbotron-fluid">
     <h1 class="display-4">Create / Edit BCP's</h1>


      <div class="table-responsive">
      <form action="submitbcp.php" method="POST">
      <input type="hidden" id="sendbcpid" name="existingbcpid" value="0" />
      <input type="hidden" id="sendprogramid" name="sendprogramid" value="0" />
      <div class="form group">
      <table class="table">
      <tr>
        <td></td> 
        <td></td>
        <td style="text-align:right" id="exitingbcpid"> </td>
      </tr>
      <tr>
        <td><b>SELECT CLINICAL UNIT</b><input type="hidden" id="program_name" name="program_name" /></td> 
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
        <td id="custom_activity"> <input id="cust_act_input" name="cust_act_input" oninput="CheckPriAct()" placeholder="A new activity" value="" ></td>
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
            <td colspan="2"><div class="form-group"><textarea name="immediate_action" id="immediate_action" class="form-control" style="min-width: 100%; resize: none;" rows="6" placeholder="What you need to do immediatly when the system breaks..." ></textarea></div></td>
            
      </tr>
      <tr>
            <td><b>PRE-REQUISITE</b></td>
            <td colspan="2"><div  class="form-group"><textarea name="pre_req" id="pre_req" class="form-control" style="min-width: 100%; resize: none;" rows="6" placeholder="What you need on hand (and in preperation for) in order to work-around the issue..."></textarea></div></td>
          
      </tr>
      <tr>
            <td><b>WORK-AROUND</b></td>
            <td colspan="2"><div  class="form-group"><textarea name="work_around" id="work_around" class="form-control" style="min-width: 100%; resize: none;" rows="6" placeholder="What is the long term work-around until the problem is resolved..."></textarea></div></td>
            
      </tr>

      </table>
      <button type="submit" class="btn btn-primary  btn-lg btn-block" name="bcpsubmit" >Submit</button>
     </div>
      </form>
      </div>
        
      <script >

      //***** ACTUAL CODE STARTS HERE AFTER PAGE EFFECTIVLY LOADS****//
      //LOAD UP ALL THE DROP BOXES ETC
      //THEN CHECK TO SEE IF THE PAGE WAS CALLED WITH A BCP ID if so BASED ON THAT ID, go get it AND set the existing bcp to true and the hidden input's in the form to the
      // id as that is used in the next page to decided on insert vs a update. We should probably lock a few dropdowns too?

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

    // LETS CHECK TO SEE IF THIS PAGE WAS REFERED, GO GET THE BCP and pre-fill
    //  PUT routine() here to do that.
      GetBCPBecasePageGetID()

      OnChangePreReq();

      //Set the default Custom Activity
      CheckPriAct();

      </script>
      </div>

      
    <?php //include 'footer.php'?>
    <?php include 'jsboot.php'?>
  </main>
</body>
</html>

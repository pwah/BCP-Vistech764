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

table {
    /* make the border continuous (without gaps between columns) */
    border-collapse: collapse;
}
        </style>

     <!-- THIS IS THE SCRIPT TO GET THE CLINICAL UNIT's ASSOCIATED PROGRAM -->
     <script> 

      function OnChangeClinical() {

        //THE HIDDEN DATA IS IN THE 'cu' SELECT/OPTION.
        //GET THE DATA OUT AND 
        var e = document.getElementById("cu");
        var program = e.options [e.selectedIndex];
        var associated_program = program.getAttribute('data-program_name');
        document.getElementById("clinicalprogram").innerHTML = "<b>"+associated_program+"</b>";

      }

      function OnChangeSystem() {
        //Get the id name of the loaded page's Clinical unit then update as required
        var  e = document.getElementById("selectsystemname");
        var  id = e.options [e.selectedIndex];
        //GET the Hidden system-description data from the system option
        var get_sys_desc = id.getAttribute('data-sysdescr');
        //Now SET THE SYSTEM DESCRIPTION
        document.getElementById("system_desc_here").value = get_sys_desc;
        //NOW SET THE OPTION VAL FOR THE ASSOCIATED MTPD
        var get_sys_def_mtpd = id.getAttribute('data-mtpd');
       // if (get_sys_def_mtpd==0) get_sys_def_mtpd=1; //Fixes this if the value was null !;
        //NOW insert the hidden 'data' from the System option into the MTPD dropdown to show the current dropdown so the selected option is selected.
        document.getElementById("defaultsystemmtpd").value = get_sys_def_mtpd;   
       
       

      }

      function  OnChangeActivities(){



        var e = document.getElementById("activities");
        var activities = e.options [e.selectedIndex];
        var mtpd_id = activities.getAttribute('data-mtpd');
       
        document.getElementById("activiy_mtpd").value = mtpd_id;
        //NOW SET THE OPTION VAL FOR THE ASSOCIATED MTPD
             
        document.getElementById("rename_activity").value = "";

      }

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
                      document.getElementById(idsendto).innerHTML = this.responseText;
                  }
              };
              xmlhttp.open("GET", getstatement, false);
              xmlhttp.send();
          }
      }
   

function UpdatedB(updatestatement,id,update_get_statement)
{ 
  //
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
// END UPDATE dB SCRIPT

      function RenameProgram(){
        var  e = document.getElementById("programoptions");
        var oldprogramname = e.options [e.selectedIndex].text;
        var newprogramname = document.getElementById("rename_program").value; 
        var value_id =  document.getElementById("programoptions").value;       
        var r = confirm("Are you sure you want to RENAME "+oldprogramname+" TO "+newprogramname);
        if (r == true) {
         UpdatedB("get_rename_program.php?newname="+newprogramname+"&id="+value_id,"program_option_list", "get_option_programs.php?idname=programoptions&option=onchange=''");
          //clear new name program new-name-checkbox
          document.getElementById("rename_program").value="";
          //Should update clinical section now too
        }
      }

      function AddProgram(){
        var newprogramname = document.getElementById("addprogram").value;
        var r = confirm("Are you sure you want to Add "+newprogramname + " ? ");
        if (r == true)  {
                          UpdatedB("get_add_program.php?newprogram="+newprogramname,"program_option_list", "get_option_programs.php?idname=programoptions&option=onchange=''");
                          //clear new name program new-name-checkbox
                          document.getElementById("addprogram").value="";  
                          //Should update clinical section now too
                        }
      }

      function DeleteProgram(){
        var  e = document.getElementById("programoptions");
        var deleteprogramname = e.options [e.selectedIndex].text;
        var value_id =  document.getElementById("programoptions").value;
       
        var r = confirm("Are you sure you want to DELETE "+deleteprogramname + " ? ");
        if (r == true)  {
                          UpdatedB("get_delete_program.php?deleteprogramid="+value_id,"program_option_list", "get_option_programs.php?idname=programoptions&option=onchange=''");
               
                          //Should update clinical section now too
                        }
      }

      function RenameClinicalUnit(){

        //GET THE CURRENT SELECTED CLINICAL UNIT ID
        var  e = document.getElementById("cu");
        var old_clinical_unit_name = e.options [e.selectedIndex].text;
        var new_clinical_unit_name = document.getElementById("rename_clinical_unit").value; 
        //GET THE clinical unit id to pass to the ajax php  to be specific what to change.
        var value_id =  document.getElementById("cu").value;       

        var r = confirm("Are you sure you want to RENAME "+old_clinical_unit_name+" TO "+new_clinical_unit_name);
        if (r == true) {

         UpdatedB("get_rename_clinical.php?newname="+new_clinical_unit_name+"&id="+value_id,"clinicalunit_option", "get_clinicalunit.php?idname=cu&option=onchange='OnChangeClinical();'");
          //clear new name program new-name-checkbox
          document.getElementById("rename_clinical_unit").value="";
          //Now refresh the Associated program
          OnChangeClinical();
        
        }
      }

      function DeleteClinicalUnit(){
        var  e = document.getElementById("cu");
        var clincal_unit_name = e.options [e.selectedIndex].text;
        var clinical_unit_id = document.getElementById("cu").value;
        var r = confirm("Are you sure you want to DELETE  " + clincal_unit_name);
        if (r == true) {
          UpdatedB("get_delete_clinical.php?id="+ clinical_unit_id,"clinicalunit_option", "get_clinicalunit.php?idname=cu&option=onchange='OnChangeClinical();'");
          //clear new name program new-name-checkbox
          document.getElementById("clinicalprogram").value="";
          //Now refresh the Associated program
          OnChangeClinical();
        }
      }

      function UpdateClinicalProg(){
        var  e = document.getElementById("cu");
        var clinical_unit_name = e.options [e.selectedIndex].text;
        var clinical_unit_id = document.getElementById("cu").value;

        var  f = document.getElementById("clinical_change_program");
        var updated_program_name = f.options [f.selectedIndex].text;
       
        
        var r = confirm("Are you sure you want to UPDATE unit:" +clinical_unit_name+" and program :"+updated_program_name );
        if (r == true) {
          UpdatedB("get_update_clinical.php?id="+ clinical_unit_id+"&clinical_unit_name="+clinical_unit_name+"&program_name="+updated_program_name,"clinicalunit_option", "get_clinicalunit.php?idname=cu&option=onchange='OnChangeClinical();'");
          //clear new name program new-name-checkbox
          document.getElementById("clinicalprogram").value="";
          //Now refresh the Associated program
          OnChangeClinical();
        }
      }

      function AddNewClinicalUnit(){
        //UPDATE THE ADD NEW CLINICAL UNIT FUNCTION.

        var new_clinical_unit_name = document.getElementById("new_clincal_name").value;
        var  x = document.getElementById("clinical_add_program");
        var new_associated_program = x.options [x.selectedIndex].text;
               
        var r = confirm("Are you sure you want to ADD the NEW clinical unit:" +new_clinical_unit_name+" and the associated program :"+new_associated_program );
        if (r == true) {

          UpdatedB("get_addnew_clinical.php?newname="+ new_clinical_unit_name+"&associatedprogram="+new_associated_program,"clinicalunit_option", "get_clinicalunit.php?idname=cu&option=onchange='OnChangeClinical();'");
          //clear new name program new-name-checkbox
          document.getElementById("new_clincal_name").value="";
          //Now refresh the Associated program
          OnChangeClinical();
        }
      }

      function UpdateSystems(){
        //UPDATE THE SYSNAME/DESCRIPTION AND MTPD
        var  e = document.getElementById("selectsystemname");
        var system_name = e.options [e.selectedIndex].text;
        var system_name_id = document.getElementById("selectsystemname").value;
        var system_description = document.getElementById("system_desc_here").value;

        var  f = document.getElementById("defaultsystemmtpd");
        var MTPD_text = f.options [f.selectedIndex].text;
        var MTPD_id = document.getElementById("defaultsystemmtpd").value;
        
        var r = confirm("Are you sure you want to UPDATE the SYSTEM : " +system_name+" with the description of : "+system_description+" and a MTPD of : "+MTPD_text );
        if (r == true) {

          UpdatedB("get_update_system.php?id="+system_name_id+"&sys_desc="+system_description+"&mtpd_id="+MTPD_id,"system_option", "get_system_option.php?idname=selectsystemname&option=onchange='OnChangeSystem()'");
         OnChangeSystem();
        }

      }
      function DeleteSystem(){
          //DELETE THE SYSTEM
          var  e = document.getElementById("selectsystemname");
        var system_name = e.options [e.selectedIndex].text;
        var system_name_id = document.getElementById("selectsystemname").value;
        var r = confirm("Are you sure you want to DELETE the SYSTEM : " +system_name );
        if (r == true) {
          UpdatedB("get_delete_system.php?id="+system_name_id,"system_option", "get_system_option.php?idname=selectsystemname&option=onchange='OnChangeSystem()'");
           OnChangeSystem();
        }

      }

      function RenameSystem(){
        //RENAME THE SYSTEM

        var  e = document.getElementById("selectsystemname");
        var system_name = e.options [e.selectedIndex].text;
        var system_name_id = document.getElementById("selectsystemname").value;
        var new_system_name = document.getElementById("renamesystem").value;
        var r = confirm("Are you sure you want to RENAME the SYSTEM: " +system_name+" TO :"+new_system_name );
        if (r == true) {
          UpdatedB("get_rename_system.php?id="+system_name_id+"&newsysname="+new_system_name,"system_option", "get_system_option.php?idname=selectsystemname&option=onchange='OnChangeSystem()'");
           OnChangeSystem();
        }
        //Clear the rename input box
        new_system_name = document.getElementById("renamesystem").value = "";
      }

      function AddNewSystem(){

        var new_system_name = document.getElementById("newsysname").value;
        var new_system_description = document.getElementById("newsysdescr").value;
        var new_sys_mtpd_id = document.getElementById("newsysmtpd").value;

        var  x = document.getElementById("newsysmtpd");
        var new_sys_mtpd_name = x.options [x.selectedIndex].text;
              
        var r = confirm("Are you sure you want to ADD the NEW SYSTEM unit:" +new_system_name+" with the associated description of :"+new_system_description+" and a System MTPD value of "+new_sys_mtpd_name );
        if (r == true) {
          UpdatedB("get_addnew_system.php?newsysname="+new_system_name+"&newsysdesc="+new_system_description+"&mtpd_val="+new_sys_mtpd_id,"system_option", "get_system_option.php?idname=selectsystemname&option=onchange='OnChangeSystem()'");
          //clear new name program new-name-checkbox
          document.getElementById("newsysname").value="";
          document.getElementById("newsysdescr").value="";
          //Now refresh the Associated program
          OnChangeSystem();

        }

    }

    function UpdateActivities(){

        //UPDATE THE SYSNAME/DESCRIPTION AND MTPD
        var e = document.getElementById("activities");
        var activity_name = e.options [e.selectedIndex].text;
        var activity_id = document.getElementById("activities").value;

        var  f = document.getElementById("activiy_mtpd");
        var MTPD_text = f.options [f.selectedIndex].text;
        var MTPD_id = document.getElementById("activiy_mtpd").value;
        
        var r = confirm("Are you sure you want to UPDATE the ACTIVITY : " +activity_name+" with the default MTPD of : "+MTPD_text );
        if (r == true) {
                        UpdatedB("get_update_activities.php?act_id="+activity_id+"&act_mtpd="+MTPD_id,"insert_activty", "get_activities.php?idname=activities&option=onchange='OnChangeActivities()'");
                        OnChangeActivities();
                       }
    }

    function RenameActivities(){
              
              var e = document.getElementById("activities");
        var activity_name = e.options [e.selectedIndex].text;
        var activity_id = document.getElementById("activities").value;
        var new_activity_name = document.getElementById("rename_activity").value;
          
        var r = confirm("Are you sure you want to RENAME the activity : " +activity_name+" with : "+new_activity_name );
        if (r == true) {
                        UpdatedB("get_rename_activities.php?act_id="+activity_id+"&newname="+new_activity_name,"insert_activty", "get_activities.php?idname=activities&option=onchange='OnChangeActivities()'");
                        OnChangeActivities();
                       }
    }

    function DeleteActivities(){
              
              var e = document.getElementById("activities");
        var activity_name = e.options [e.selectedIndex].text;
        var activity_id = document.getElementById("activities").value;
      
        var r = confirm("Are you sure you want to DELETE the activity : " +activity_name);
        if (r == true) {
                        UpdatedB("get_delete_activity.php?act_id="+activity_id,"insert_activty", "get_activities.php?idname=activities&option=onchange='OnChangeActivities()'");
                        OnChangeActivities();
                       }
    }

    function AddNewActivity(){

      var new_activity_name = document.getElementById("new_activity").value;
      var  f = document.getElementById("new_act_mtpd");
      var MTPD_text = f.options [f.selectedIndex].text;
      var MTPD_id = document.getElementById("new_act_mtpd").value;
      var r = confirm("Are you sure you want to ADD the new activity : " +new_activity_name);
        if (r == true) {
                        UpdatedB("get_add_activity.php?new_activity_name="+new_activity_name+"&new_activity_mtpd="+MTPD_id,"insert_activty", "get_activities.php?idname=activities&option=onchange='OnChangeActivities()'");
                        document.getElementById("new_activity").value = "";
                        document.getElementById("new_act_mtpd").value = 1;
                        OnChangeActivities();

                       }
    }
  </script>
      <!-- END OF SCRIPT -->

  </head>
  <body>
    <?php include 'navbar.php' ?>
      
    <main class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <span class="navbar-brand span12 text-center" id="admin_type">Edit core business items</span>
    </nav>
 

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Programs</h1>
         <p class="lead">Add / Edit Programs.</p>
      </div>
      <!-- START TABLE FOR PROGRAMS -->


      <table class="table">

				<!--FINISH TABLE TEXT HEADERS -->
				<!-- INSERT DATA FROM dB IN NEXT STAGES   ***ROW 1 x4-->  
					<tr>
            <td><b>PROGRAM</b></td>
            <td id="program_option_list"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="DeleteProgram()">DELETE-PROGRAM</button> </td>
          </tr>
          <tr class="separated">
            <td><b>RENAME-PROGRAM</b></td>
            <td><input type="text" id="rename_program" class="redcolor"> </td>
            <td><button type="button" class="btn btn-warning btn-sm" onclick="RenameProgram()"> RENAME-PROGRAM</button></td>
          </tr>
          <tr>
            <td><b>ADD A NEW PROGRAM</b></td>
            <td><input type="text" name="addprogram" id="addprogram" class="greencolor"></td>
            <td><button type="button" class="btn btn-primary btn-sm" onclick="AddProgram()"> ADD A NEW PROGRAM</button></td>
          </tr>
					
      </table>
      <!--END TABLE FOR PROGRAMS -->
    </div>

    <hr class="my-4">


<!-- CLINICAL UNIT BELOW -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Clinical Unit</h1>
         <p class="lead">Add / Edit Clinical Unit & Programs.</p>
      </div>

      <!--START TABLE FOR CLINICAL UNITS --> 

      <table class="table">

        <tr>
          <td><b>CLINICAL UNIT</b></td> 
          <td id="clinicalunit_option"> </td>
          <td>  </td>
        </tr>
        <tr>
          <td><b>ASSOCIATED PROGRAM</b></td>
          <td> <span id="clinicalprogram"></span></td>
          <td> <button type="button" class="btn btn-danger btn-sm" onclick="DeleteClinicalUnit()">DELETE-CLINICAL-UNIT</button> </td>
        </tr>
        <tr>
          <td><b>CHANGE ASSOCIATED PROGRAM TO:</b></td>
          <td id="clinical_changeprogram"></td>
          <td></td>
        </td>
        <tr>
          <td></td>
          <td><button type="button" style="width:100%;" onclick="UpdateClinicalProg()" class="btn btn-danger btn-sm">UPDATE-COMBINATION</button></td>
          <td></td>
        </tr>
        <tr class="separated">
          <td><b>RENAME THE CLINICAL UNIT</b></td>
          <td> <input type="text" id="rename_clinical_unit" class="redcolor" > </td>
          <td> <button type="button" class="btn btn-danger btn-sm" onclick="RenameClinicalUnit()"> RENAME-CLINICAL-UNIT</button></td>
        </tr>
        <tr>
          <td><b>ADD NEW CLINCAL UNIT </b></td>
          <td><input type="text" id="new_clincal_name" class="greencolor" > </td>
          <td></td>
        </tr>
        <tr>
          <td><b>ADD ASSOCIATED PROGRAM</b></td>
          <td id="add_associated_program"></td>
          <td><button type="button" class="btn btn-primary btn-sm" onclick="AddNewClinicalUnit()"> ADD A NEW CLINICAL UNIT</button></td>
        </tr>

      </table>
     <!-- END TABLE FOR CLINICAL UNITS --> 
    </div>
    <!-- END OF JUMBOTRON FOR CLINICAL -->

    <hr class="my-4">

    <!-- START JUMBOTRON FOR SYSTEMS -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">SYSTEMS</h1>
         <p class="lead">Add / Edit SYSTEMS</p>
      </div>

      <table class="table table-bordered">
        <tr>
          <td><b>SYSTEM NAME</b></td>
          <td id="system_option"></td>
		    </tr>
      	<tr>
            <td><b>SYSTEM DESCRIPTION</b></td>
            <td> <textarea id="system_desc_here" class="greencolor"></textarea></td>
        </tr>
        <tr>
          <td><b>DEFAULT SYSTEM MTPD</b></td>
          <td id="def_system_mtpd"></td>
        </tr>
        <tr>
			    <td><button type="button" onclick="OnChangeSystem()" class="btn btn-primary btn-sm">RESET-VIEW</button>
              <button type="button" class="btn btn-primary btn-sm" onclick="UpdateSystems()">UPDATE-DESCRIPTION/MTPD</button>
              <button type="button" class="btn btn-danger btn-sm" onclick="DeleteSystem()">DELETE-SYSTEM</button> </td>
			    <td></td>            
		    </tr>
        <tr class="separated">
        	<td>  <input type="text" name="renamesystem" id="renamesystem" class="greencolor" >
                <button type="button" class="btn btn-warning btn-sm" onclick="RenameSystem()">RENAME CURRENT SYSTEM</button></td> 
          <td></td>
        </tr>

      </table>
      <table class="table table-bordered">
          <tr>
            <td><b>NEW SYSTEM NAME</b></td>
            <td><input id="newsysname"></td>
          </tr>
          <tr>
            <td><b>NEW SYSTEM DESCRIPTION</b></td>
            <td> <textarea id="newsysdescr" class="greencolor"></textarea></td>
          </tr>
          <tr>
            <td><b>NEW SYSTEM DEFAULT SYSTEM MTPD</b></td>
            <td id="newsystemmtpd"></td>
          </tr>
          <tr>
            <td><button type="button" class="btn btn-primary btn-sm" onclick="AddNewSystem()">ADD NEW SYSTEM</button></td>
            <td></td>            
          </tr>
      </table>
    </div>
    <!-- END SYSTEMS -->


    <!-- START ACTIVITIES -->                                                        
    <hr class="my-4">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">ACTIVITIES</h1>
         <p class="lead">Add / Edit Activites</p>
      </div>
    

    <table class="table table-bordered">
      <tr>
        <td><b>ACTIVITIES</b></td>
        <td id='insert_activty'></td>
    </tr>
    <tr>
      <td><b>DEFAULT MTPD FOR THIS ACTIVITY</b></td>
      <td id="activities_existing_mtpd"></td>
    </tr>
    <tr>
      <td><b>RENAME ACTIVITY</b></td>
      <td><input id="rename_activity" type="text"></td>
    </tr>
    <tr >
      <td> <button type="button" class="btn btn-warning btn-sm" onclick="RenameActivities()" >RENAME-ACTIVITIES</button> </td>  
      <td></td>
    </tr>
    <tr class="separated">
    
      <td>  <button type="button" class="btn btn-primary btn-sm" onclick="OnChangeActivities()" >RESET-VIEW</button>
            <button type="button" class="btn btn-warning btn-sm" onclick="UpdateActivities()">UPDATE-ACTIVITY/MTPD</button>
            <button type="button" class="btn btn-danger btn-sm" onclick="DeleteActivities()">DELETE-ACTIVITY</button></td>
      <td></td>     
    </tr>
  </table>

  <table class="table table-bordered">
    <tr>
      <td><b>NEW ACTIVITY</b></td>
      <td><input id="new_activity" type="text"></td>
    </tr>
    <tr>
      <td><b>SET ACTIVTY'S DEFAULT MTPD</b></td>
      <td id="new_activity_mtpd"></td>
    </tr>
    <tr>
      <td><button type="button" class="btn btn-primary btn-sm" onclick="AddNewActivity()">ADD NEW ACTIVITY </button></td>
      <td></td>            
    </tr>  
  </table>
  </div>

  <hr class="my-4">

  </main>


  <script>
    //UPDATE THE PROGRAMS OPTION LIST
    InsertAjaxTo("program_option_list", "get_option_programs.php?idname=programoptions&option=onchange=''");

    //UPDATE THE PROGRAMS IN THE CLINICAL UNITS UPDATE PROGRAM SECTION
    InsertAjaxTo("clinical_changeprogram", "get_option_programs.php?idname=clinical_change_program&option=onchange=''");

    //UPDATE THE PROGRAMS IN THE CLINICAL ADD-PROGRAMS SECTION
    InsertAjaxTo("add_associated_program", "get_option_programs.php?idname=clinical_add_program&option=onchange=''");

    //UPDATE THE CLINICAL UNITS LIST
    InsertAjaxTo("clinicalunit_option", "get_clinicalunit.php?idname=cu&option=onchange='OnChangeClinical();'");
    //UPDATE THE CLINICAL UNIT ASSOCIATED PROGRAM
    
   // InsertAjaxTo("add_associated_program", "get_option_programs.php?idname=programoptions&option=onchange=''");
    //UPDATE THE SYSTEM...
    InsertAjaxTo("system_option", "get_system_option.php?idname=selectsystemname&option=onchange='OnChangeSystem()'");

    InsertAjaxTo("def_system_mtpd", "get_mtpd.php?idname=defaultsystemmtpd&option=onchange=''");
    InsertAjaxTo("newsystemmtpd", "get_mtpd.php?idname=newsysmtpd&option=onchange=''");


    InsertAjaxTo("insert_activty", "get_activities.php?idname=activities&option=onchange='OnChangeActivities()'");

    InsertAjaxTo("activities_existing_mtpd", "get_mtpd.php?idname=activiy_mtpd&option=onchange=''");

    InsertAjaxTo("new_activity_mtpd", "get_mtpd.php?idname=new_act_mtpd&option=onchange=''");
    OnChangeClinical();
    OnChangeSystem();
    OnChangeActivities();
 

  </script>
	
  <?php include 'footer.php'?>
  <?php include 'jsboot.php'?>
  
  </body>
</html>
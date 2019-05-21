<?php  
    session_start();
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }
?>

    <!doctype html>
    <html lang="en">
    <head>
        <?php include 'head.php'?>
        <title>Create/Edit BCP</title>
    </head>
    <body>
    <?php include 'navbar.php' ?>
        
    <main class="container">

    <p class="text-lg-left font-weight-bold" id="top_text">The business continuity planning identifies immediate and sustainable actions for the continuity of priority activities. 
    Immediate actions are to provide a basic level of service in the period immediately following a disruption. 
    Sustainable actions are to provide a higher level of service that can be sustained for a longer period of time or until the disruption is over. .
    The worksheet captures these as a summary level.
    </p>
    </main>

    <div class="container">

    <table  class="table" style="background-color: pink;">
            <tr>
                <th>The System</th>
                <th>Business Unit(Program)</th>
                <th>Sub-Unit(Clinical Unit)</th>
                <th>Business Function</th>
                <th>Activity Depend</th>
                <th>MTPD</th>
                <th>Highest Impact</th>
            </tr>
            <tr>
                <td>sys</td>
                <td>bu</td>
                <td>sub</td>
                <td>BF</td> 
                <td>FULL</td>
                <td>1 Day</td>
                <td>4</td>
            </tr>
          

        </table>
        <br><br>


        <table style="background-color: aqua;" class="table">
  
        <tr>
            <td>Immediate continuity Plan...</td>
            <td>
                <select class="form-control" id="sel1" >
                <option>Take notes</option>
                <option>Fix your resume</option>
                <option>Quit</option>
                <option>Apply for new job</option>
                </select>
            </td>

            <td class="text-center">Or Enter Your Own</td>
            <td><textarea rows="2" cols="30"> </textarea></td>
            </tr>
            <tr>
            <td>Maintainable immediate duration</td>
            <td>
                <select class="form-control" id="sel1" >
                    <option>1 Day</option>
                    <option>2 Day</option>
                    <option>8 HR</option>
                    <option>4 weeks</option>
                </select>
            </td>
            <td></td>
        
            </tr>
        </table>
        <table style="background-color: green;" class="table">
        
       
        <tr>
            <td>Sustainable continuity plan</td>
            <td>
                <select class="form-control" id="sel1" >
                <option>Take notes</option>
                <option>Fix your resume</option>
                <option>Quit</option>
                <option>Apply for new job</option>
                </select>
            </td>

            <td class="text-center">Or Enter Your Own</td>
            <td><textarea rows="2" cols="30"> </textarea></td>
            </tr>
            <tr>
            <td>Pre-requsites / Resources Required for Sustainability</td>
            <td>
                <select class="form-control" id="sel1" >
                <option>Progress note pages/resources for data entry</option>
                <option>Proforma checklist</option>
                <option>Data in data warehouse</option>
                <option>4</option>
                </select>
            </td>

            <td class="text-center">Or Enter Your Own</td>
            <td><textarea rows="2" cols="30"> </textarea></td>
            </tr>
            <tr>
            <td>Maintainable sustainable duration</td>
            <td>
                <select class="form-control" id="sel1" >
                    <option>1 Day</option>
                    <option>2 Day</option>
                    <option>8 HR</option>
                    <option>4 weeks</option>
                </select>
            </td>


     
            </tr>


        </table>
        <a href="index.php" class="btn btn-primary text-center">SAVE THE BCP</a>

            







      </table>
      <br>







    </div>


    <?php //include 'footer.php'?>
    <?php include 'jsboot.php'?>
        
    </body>
    </html>
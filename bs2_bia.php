<?php  
    session_start();
    require('db.php');
    require("auth.php");
    //Test if user is auth'ed to be in this menu if not BAIL out.
    if(!$_SESSION['priv_level'] >= 10 ) {
    exit(0);
    }
    
    if (isset($_POST['system']))  {
     $system = stripslashes($_POST['system']);
    }
    if (isset($_POST['catagory']))  {
      $catagory = stripslashes($_POST['catagory']);
     }
     if (isset($_POST['catfunc']))  {
      $catfunc = stripslashes($_POST['catfunc']);
     }
     if (isset($_POST['buprog']))  {
      $buprog = stripslashes($_POST['buprog']);
     }
     if (isset($_POST['clinical']))  {
      $clinical = stripslashes($_POST['clinical']);
     }
     if (isset($_POST['activity']))  {
      $activity = stripslashes($_POST['activity']);
     }
     if (isset($_POST['dependancy']))  {
      $dependancy = stripslashes($_POST['dependancy']);
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
        
            <p class="text-lg-left font-weight-bold" id="top_text">Using the activity list determined in the previous step, this worksheet is use in assessing the business impact of a disruption to these activities, and identify the corresponding Maximum Tolerable Period of Disruption (MTPD) for each of the activities.  
            <br>Note: The MTPD must be within timeframe for the impact severity cut-off rating (4 or 5). Refer to the standard impact rating definitions to identify category and severity.<br>
            MTPD refers to the maximum tolerable period a system can be offline for MTDL refers to the maximum targeted period in which data might be lost from an IT service due to a disruption.
            </p><br>
      
    </main>

    <div class="container">
        <table style="background-color: pink;" class="table">
            <tr>
                <th>The System</th>
                <th>System Catagory/Function</th>
                <th>Business Unit/SubProgram</th>
                <th>The Activity</th>
                <th>System Dependancy</th>
            </tr>

            <tr>
                <td><?php echo $system; ?></td>
                <td><?php echo $catagory."--".$catfunc; ?></td>
                <td><?php echo $buprog."--".$clinical; ?></td>
                <td><?php echo $activity; ?></td> 
                <td><?php echo $dependancy; ?></td>           
            </tr>
          

        </table>
        <br><br>


        <table class="table" style="background-color: Teal;" >
        <tr>
          <th>Type</th>
          <th>Dropdowns</th>
          <th></th>
        </tr>
        <tr>
          <td>Impact of disruption</td>
          <td> 
            <select class="form-control" id="sel1" >
              <option>Miss information</option>
              <option>Fail to meet compliance</option>
              <option>3</option>
              <option>4</option>
            </select>
          </td>
          <td class="text-center">Or Enter Your Own</td>
          <td><textarea rows="2" cols="30"> </textarea></td>
         
        </tr>
        <tr>
          <td>Category</td>
          <td>
              <select class="form-control" id="sel1" >
                <option>People Effects</option>
                <option>Legal and Compliance</option>
                <option>3</option>
                <option>4</option>
            </select>
          </td>
          <td >
          </td>
          
        </tr>






        <tr>
          <td>Maximum Tolerable Period of Disruption(MTPD)</td>
          <td>
            <select class="form-control" id="sel1" >
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
          </td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>Maximum Tolerable Data Loss(MTDL)</td>
          <td>
            <select class="form-control" id="sel1" >
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
            </select>
          </td>
          <td></td>
          <td></td>
        </tr>
      </table>
      <br>
      <table class="table" style="background-color: Olive;">
      <tr>
      <td colspan="4" class="text-center font-weight-bold" > IMPACT RATING </td>
      </tr>
      <tr>
        <th>Min's</th>
        <th>Hrs</th>
        <th>Days</th>
        <th>Wks</th>
      </tr>
      <tr>
        <td>
        <select>
          <?php for($i = 1; $i < 6; $i++): 
          echo "<option value='$i'>$i</option>";
        endfor ?>
        </select>
        </td>
        <td>
          <select>
            <?php for($i = 1; $i < 6; $i++): 
            echo "<option value='$i'>$i</option>";
          endfor ?>
          </select>

        </td>
        <td>
        <select>
          <?php for($i = 1; $i < 6; $i++): 
          echo "<option value='$i'>$i</option>";
        endfor ?>
        </select>

        </td>
        <td>
        <select>
          <?php for($i = 1; $i < 6; $i++): 
          echo "<option value='$i'>$i</option>";
        endfor ?>
        </select>
        </td>
      </tr>
      <tr>
        <td colspan="4" class="text-center" > Please input 1-5 rating for each field above (1=min; 5=max)<br><a href="bs3_bcp.php" class="btn btn-primary text-center">GO TO BS3 BCP STAGE</a> </td>
      </tr>

      </table>


    </div>



    
    <div class="container">
    </div>



    <?php //include 'footer.php'?>
    <?php include 'jsboot.php'?>
        
    </body>
    </html>
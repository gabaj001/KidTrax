<?php require_once('../../private/initialize.php'); ?>
 
<?php

  //-------------------- Student activities Page 01--------------------------------
  include(SHARED_PATH . '/session.php');

  if (!isset($_GET['schoolno'])) {

        redirect_to(url_for('/index.php'));

  }

  $schoolno = $_GET['schoolno'];
  $date = date_create(getCurrentdate()["curdate"]);
  $currentyear = date_format($date,'Y');

  if(is_post_request())
  {
      if (isset($_POST['search']))
      {
        
   
       $schoolno =  $_POST['schoolno'];
       $selectedday = $_POST['day'];
       $selectedyear = $_POST['year'];
       $selectedmonth = $_POST['month'];
       $tripstate =  $_POST['trip'];

        //echo $tripstate;

        $date=date_create($selectedyear.'-'.$selectedmonth  . '-' . $selectedday);

        $cdate = date_format($date,'Y-m-d');
        
        $bus_set = businfo($schoolno);
        

        
      }

  } else {

      $cdate = date_format($date,'Y-m-d');
      
      $selectedday = date_format($date,'d');
      $selectedyear = date_format($date,'Y');
      $selectedmonth = date_format($date,'m');
        
      $bus_set = businfo($schoolno);
      //$bus_set = businfo_by_date($schoolno,$cdate);
      $tripstate = 1;

  }
  
  
  


  //$activity_set = find_student_activities($id,$crusr->schoolno,$cdate);

  $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 
            5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 
            9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
 
 

?>

<?php $page_title = 'Student Activities info'; ?>

<?php 
     include(SHARED_PATH . '/track_header.php'); 

     //$crusr->printfields();
          
?>

<div id="content" class="well container-fliud" style='overflow:scroll;height:400px;'>
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">School Buses</h1>
    <form name="actvitiesForm"  class="form-inline"
        action="<?php echo url_for('/bustrack/schadmbus.php?schoolno=' . $schoolno); ?>"  method="post">
        
        <table class="table">
            <tr>
                
                <td>
                    <label>Date</label>
                    <select size="1" name="month" style="height:35px;" class="form-control input-sm">
                        <?php
                            foreach ($months as $num => $name) {
                                printf('<option value="%u" %s >%s</option>', $num,($selectedmonth == $num) ? 'selected' : '', $name);
                                
                            }
                        ?>
                    </select>
               
                    <select	name="day" style="height:35px;" class="form-control input-sm">
                        <?php
                        for($i=1; $i <= 31; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($i == $selectedday) {
                            echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                
                    <select	name="year" style="height:35px;" class="form-control input-sm">
                        <?php
                        for($i=2017; $i <= $currentyear; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($selectedyear == $selectedyear) {
                            echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>  
                    <select name="trip" style="height:35px;" class="form-control input-sm">
                        <option value="1"
                        <?php 
                            if ($tripstate==1)
                            {
                                echo 'selected';
                            }
                        ?>
                        >Moring Trip</option>
                        <option value="2" 
                        <?php 
                            if ($tripstate==2)
                            {
                                echo 'selected';
                            }
                        ?>
                        
                        >Afternoon Trip</option>
                    </select>
                    <input type="submit" name="search" value="Search"
                    class="btn btn-primary" />
                    <input type="text" name="schoolno" value="<?php echo $schoolno; ?>" hidden/>
                </td>

            </tr>
        </table>
        
        <table class="table table-condensed table-responsive">
          <tr class="btn-primary">
            <th>Bus No</th>
            <th>Trip State</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>

          </tr>
           
          <?php foreach($bus_set as $bus) { ?>
            <tr>
            
              <td><span><?php echo h($bus['BusNo']); ?></span></td>
              <td>
                    <?php 
                    
                        if ($bus['TripState']==1)
                        {
                            echo 'Morning Trip';
                        } else {
                            echo 'Afternoon Trip';
                        }
                        
                    
                    ?>
             </td>
              
              <td>
                <a class="action btn btn-link btn-block" 
                    href="<?php 
                         echo url_for('/bustrack/stdinbus.php?schoolno=' . h($bus['SchoolNo']) . 
                                        "&busno=" . h($bus['BusNo']) . 
                                        "&cdate=" . h($cdate) . "&tripstate=" . h($tripstate));  
                         
                         ?>">
                    List Students
                </a>   
              
              </td>
              <td>
                <a class="action btn btn-link btn-block" 
                    href="<?php 
                         echo url_for('/bustrack/admbuslocation.php?busno=' . h($bus['BusNo'])); 
                         
                         ?>">
                    Location
                </a>                
              
              </td>
              

              
            </tr>
          <?php } ?>
        </table>
      <?php
          
          mysqli_free_result($activity_set);
          
      ?>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

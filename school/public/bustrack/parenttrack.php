<?php require_once('../../private/initialize.php'); ?>
 
<?php

  //-------------------- student in the bus --------------------------------
  include(SHARED_PATH . '/session.php');
  require_once('../../private/initialize.php');

    if (!isset($_GET['id'])) {

            redirect_to(url_for('/index.php'));

    }

    $id = $_GET['id'];



    $date = date_create(getCurrentdate()["curdate"]);
    $currentyear = date_format($date,'Y');

  if(is_post_request())
  {
      if (isset($_POST['search']))
      {
        
   
       

       $selectedday = $_POST['day'];
       $selectedyear = $_POST['year'];
       $selectedmonth = $_POST['month'];
       $tripstate =  $_POST['trip'];

        //echo $tripstate;

        $date=date_create($selectedyear.'-'.$selectedmonth  . '-' . $selectedday);

        $cdate = date_format($date,'Y-m-d');
        
        //echo  $id . " " . $cdate . "  " . $tripstate;
        $children_set = parent_children_bus($id,$cdate,$tripstate) ;

        
      }

  } else {


      $cdate = date_format($date,'Y-m-d');
      
      $selectedday = date_format($date,'d');
      $selectedyear = date_format($date,'Y');
      $selectedmonth = date_format($date,'m');
  
      $tripstate = 1;

      

      $children_set = parent_children_bus($id,$cdate,$tripstate) ;

  }
 
    $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 
            5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 
            9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');

?>

<?php $page_title = 'Teacher info'; ?>

<?php 
     include(SHARED_PATH . '/track_header.php'); 
?>

<div id="content" class="well container-fliud" style='overflow:scroll;height:400px;'>
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">Student In The Bus </h1>
    <form name="StudetinbusForm"  class="form-inline"
        action="<?php echo url_for('/bustrack/parenttrack.php?id=' . $crusr->userid); ?>" 
        method="post">

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
        <?php 
            
        ?>
        <table class="table table-condensed">
          <tr class="btn-primary">
            <th>Name</th>
            <th>Bus</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Date</th>
            <td></td>

            

          </tr>

          <?php foreach($children_set as $student) { ?>
            <tr>
              <td><?php echo h($student['studentname']); ?></td>
              <td><?php echo h($student['busno']); ?></td>
              <td><a class="action btn btn-link btn-block" href="<?php
                    echo url_for('/bustrack/lastlocation.php?lat=' . h($student['lat1'] .
                     "&lon=" . h($student['lon1'])));
               ?>"
               ><?php echo h($student['time_attendance']); ?></a></td>
              <td><a class="action btn btn-link btn-block" href="<?php
                    echo url_for('/bustrack/lastlocation.php?lat=' . h($student['lat2'] .
                     "&lon=" . h($student['lon2'])));
               ?>"
              ><?php echo h($student['time_attendance_out']); ?></a></td>
              <td><?php echo h($student['date_attendance']); ?></td>
              <td>
                    <a class="action btn btn-link btn-block" 
                    href="<?php 
                         echo url_for('/bustrack/buslocation.php?busno=' . h($student['busno'] . "&schoolno=" . $student['schoolno'])); 
                         
                         ?>">
                    Location
                </a>
              </td>              
            </tr>
          <?php } ?>
        </table>
      <?php
          
          mysqli_free_result($children_set);

      ?>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

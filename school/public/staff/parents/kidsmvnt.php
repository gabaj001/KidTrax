<?php require_once('../../../private/initialize.php'); ?>
 
<?php

  //-------------------- Student activities Page 01--------------------------------
  include(SHARED_PATH . '/session.php');

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
       $studentId =  $_POST['student'];

        //echo $tripstate;

        $date=date_create($selectedyear.'-'.$selectedmonth  . '-' . $selectedday);

        $cdate = date_format($date,'Y-m-d');
        
        //echo  $id . " " . $cdate . "  " . $tripstate;
        $activity_set = find_student_activities_for_parent($studentId,$crusr->schoolno,$cdate);
 

        
      }
  } else {


      $cdate = date_format($date,'Y-m-d');
     
      $selectedday = date_format($date,'d');
      $selectedyear = date_format($date,'Y');
      $selectedmonth = date_format($date,'m');
  
     

      

      //$activity_set = find_student_activities($id,$crusr->schoolno,$cdate);

  }

  //$studentname = $_GET['studentname'];
  //$cdate = $_GET['cdate'];

  //$date = date_create(getCurrentdate()["curdate"]);
  //$cdate = date_format($date,'Y-m-d');

  //$activity_set = find_student_activities($id,$crusr->schoolno,$cdate);
 
  $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 
            5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 
            9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
 
  $children_set = parent_children($id) ;
?>

<?php $page_title = 'Student Activities info'; ?>

<?php 
     include(SHARED_PATH . '/track_header.php'); 

     //$crusr->printfields();
          
?>

<div id="content" class="well container-fliud" style='overflow:scroll;height:400px;'>
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">School Area</h1>
    <form name="actvitiesForm"  class="form-inline"
        action="<?php echo url_for('/staff/parents/kidsmvnt.php?id=' . $crusr->userid); ?>"  method="post">

        <table class="table">
            <tr>
                <td><label>Name</label></td>
                <td>
                    <select name="student" id="student" style="height:35px;" class="btn-block input-sm">
                    <?php
                        $i = 0;
                        while($children = mysqli_fetch_assoc($children_set)) {
                            echo "<option " . isfound(). " value=\"{$children["studentID"]}\"";
                            if($children["studentID"] == $studentId) {
                                        echo " selected";
                                    }
                            echo ">{$children["studentName"]}</option>";
                            $i++;
                        }
                       
                    ?>
                    </select>
                </td>                
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
 
                    <input type="submit" name="search" value="Search"
                    class="btn btn-primary" />
                    <input type="text" name="schoolno" value="<?php echo $schoolno; ?>" hidden/>
                </td>

            </tr>
        </table>

        <table class="table table-condensed table-responsive">
          <tr class="btn-primary">
            <th>Place</th>
            <th>Time</th>
            <th>Date</th>
            <th>State</th>
            

            <!-- 
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            -->
          </tr>
           
          <?php foreach($activity_set as $activity) { ?>
            <tr>
              <td><?php echo h($activity['placeName']); ?></td>
              <td><?php echo h($activity['ActivityTime']); ?></td>
              <td><?php echo h($activity['ActivityDate']); ?></td>
              <td><?php echo h($activity['actvstate']); ?></td>
              
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

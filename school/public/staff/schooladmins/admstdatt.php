<?php require_once('../../../private/initialize.php'); ?>
 
<?php

  //-------------------- student Page 01 --------------------------------
  include(SHARED_PATH . '/session.php');
  $selectedschool = null;
  if(is_post_request())
  {
      if (isset($_POST['search']))
      {
        
       $selroom = $_POST['rooms'];
       //echo $selroom;
       
       $selectedday = $_POST['day'];
       $selectedyear = $_POST['year'];
       $selectedmonth = $_POST['month'];



        $date=date_create($selectedyear.'-'.$selectedmonth  . '-' . $selectedday);

        $cdate = date_format($date,'Y-m-d');
        
        $roominfo_rec = roominfo($selroom,$crusr->schoolno,$cdate);
        $roomatt_set = roomclass($selroom,$selsubjectid,$selperiod,$crusr->schoolno,$cdate);

        
      }
      
      
  }
  
  //$teacher_set = find_all_teachers();

  //$school_set = find_all_schools();


?>

<?php $page_title = 'Teacher info'; ?>

<?php 
     include(SHARED_PATH . '/track_header.php'); 

     //$crusr->printfields();
     

  

     $date = date_create(getCurrentdate()["curdate"]);

     // for loop to list years
     $currentyear = date_format($date,'Y');

     $room_set = roominschool($crusr->schoolno);




    
    $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 
                    5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 
                    9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');

 
    
 
     
?>

<div id="content" class="well container-fliud" style='overflow:scroll;height:400px;'>
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">Student Attendance</h1>
    <form name="teacherForm"  class="form-inline"
        action="<?php echo url_for('/staff/schooladmins/admstdatt.php'); ?>" 
        method="post">

        <table class="table">
            <tr> <!-- 1 -->
                <td>Room</td>
                <td>
                    <select name="rooms"  id="rooms" style="height:35px;" class="btn-block input-sm">
                    <?php

                        while($room = mysqli_fetch_assoc($room_set)) {
                            echo "<option value=\"{$room["RoomNo"]}-{$room["PeriodNo"]}\"";
                            if(($room["RoomNo"] . ' - ' . $room["PeriodNo"])== $selroom) {
                                        echo " selected";
                                    }
                            echo ">{$room["RoomNo"]}-{$room["periodtitle"]}</option>";
                        }
                        
                    ?>
                    </select> 
                </td>

                <td> 
                    <select  name="searchby" style="height:35px;" class="form-control input-sm" disabled>
                            <option value="ByDate" <?php if ($searchby=="Date") echo "selected"; ?>>By Date</option>
                            <option value="Today" <?php if ($searchby=="Today") echo "selected"; ?>>Today</option>

                    </select>
                </td>

                <td>
                    <select size="1" name="month" style="height:35px;" class="btn-block input-sm">
                        <?php
                            foreach ($months as $num => $name) {
                                printf('<option value="%u" %s >%s</option>', $num,($selectedmonth == $num) ? 'selected' : '', $name);
                                
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select	name="day" style="height:35px;" class="form-control input-sm">
                        <?php
                        for($i=1; $i <= 31; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($selectedday == $i) {
                            echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <select	name="year" style="height:35px;" class="form-control input-sm">
                        <?php
                        for($i=2017; $i <= $currentyear; $i++) {
                            echo "<option value=\"{$i}\"";
                            if($selectedyear == $i) {
                            echo " selected";
                            }
                            echo ">{$i}</option>";
                        }
                        ?>
                    </select>  
                    <input type="submit" name="search" value="Display Attendance"
                    class="btn btn-primary" /> 
                </td>
 

    
            </tr> <!-- 1 -->
            <tr>
                
                <td>Subject</td>
                <td>
                    <input  class="btn-block" type="text" name="subjectname" value="<?php echo 
                    h($roominfo_rec["SubjectName"]); ?>" readonly style="height:35px;" />
                </td>
                <td>
                    Teacher
                </td>
                <td>
                   <input  class="btn-block" type="text" name="teachername" value="<?php echo 
                    h($roominfo_rec["TeacherName"]); ?>" readonly style="height:35px;" />                  
                </td>
                <td>Grade</td>
                <td>
                <input  class="btn-block" type="text" name="classgrade" value="<?php echo 
                    h($roominfo_rec["ClassGrade"]); ?>" style="height:35px;" />                  
                </td>
                
                
            </tr>
 

        </table>
        <?php 
            
        ?>
        <table class="table table-condensed">
          <tr class="btn-primary"> <!-- 3 -->
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Start</th>
            <th>End</th>
            <th>Attandance Time</th>
            <th>Date</th>
            <th>More Information</th>

         </tr> <!-- 3 -->

          <?php foreach($roomatt_set as $croom) { ?>
            <tr> <!-- 4 -->
              <td><?php echo h($croom['studentid']); ?></td>
              <td><?php echo h($croom['studentname']); ?></td>
              <td><?php echo h($croom['starttime']); ?></td>
              <td><?php echo h($croom['endtime']); ?></td>
              <td><?php echo h($croom['time_attendance']); ?></td>
              <td><?php echo h($croom['date_ttendance']); ?></td>
              <td>
                <a class="action btn btn-default btn-block" 
                    href="<?php 
                         echo url_for('student/info.php?id=' . h($croom['studentid']) . "&studentname=" . h($croom['studentname'])) . 
                                        "&cdate=" . h("$cdate"); 
                         
                         ?>">
                    Show
                </a>              
              </td>

              
            </tr> <!-- 4 -->
          <?php } ?>
        </table>
      <?php
          
          mysqli_free_result($room_set);
          mysqli_free_result($roominfo_rec);
 
      ?>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

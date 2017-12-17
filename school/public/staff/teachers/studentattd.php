<?php require_once('../../../private/initialize.php'); ?>
 
<?php

  //-------------------- student Page 01 --------------------------------
  include(SHARED_PATH . '/session.php');
  $selectedschool = null;
  if(is_post_request())
  {
      if (isset($_POST['search']))
      {
        
       $selperiod = $_POST['periodno'];
       $selsubjectid = $_POST['subjectid'];
       $roomno = $_POST['roomno'];
       $grade = $_POST['classgrade'];
       $teachername = $_POST['teachername'];
       $searchby = $_POST['searchby'];
       
       $selectedday = $_POST['day'];
       $selectedyear = $_POST['year'];
       $selectedmonth = $_POST['month'];

        /*if ($searchby=="Today") 
        {
            $date = date_create(getCurrentdate()["curdate"]);

            $selectedday = date_format($date,'d');
            $selectedyear = date_format($date,'Y');
            $selectedmonth = date_format($date,'m');
            

        }*/

        $date=date_create($selectedyear.'-'.$selectedmonth  . '-' . $selectedday);

        $cdate = date_format($date,'Y-m-d');
        
        $room_set = roomperiod($roomno,$selsubjectid,$selperiod,$crusr->schoolno,$cdate);

        
      }
      
      
  }
  
  //$teacher_set = find_all_teachers();

  //$school_set = find_all_schools();


?>

<?php $page_title = 'Teacher info'; ?>

<?php 
     include(SHARED_PATH . '/track_header.php'); 

     //$crusr->printfields();
     

     $period_set = find_teacher_period($crusr->userid,$crusr->schoolno);
     //echo $crusr->userid;
     $subject_set = teacher_subjects($crusr->userid,$crusr->schoolno);
     $roomdata = find_room_by_teacher($crusr->userid,$crusr->schoolno);

     $date = date_create(getCurrentdate()["curdate"]);

     // for loop to list years
     $currentyear = date_format($date,'Y');

    




    
    $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 
                    5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 
                    9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');

 
    
 
     
?>

<div id="content" class="well container-fliud" style='overflow:scroll;height:400px;'>
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">Student Attendance</h1>
    <form name="teacherForm"  class="form-inline"
        action="<?php echo url_for('/staff/teachers/studentattd.php'); ?>" 
        method="post">

        <table class="table">
            <tr>
                <td>Room No  </td>
                <td>
                    <input  class="form-control btn-block" type="text" name="roomno" value="<?php echo 
                    h($roomdata['RoomNo']); ?>" />
                </td>
                <td>Teacher Name  </td>
                <td>
                    <input  class="form-control input-sm" type="text" name="teachername" value="<?php echo 
                    h($crusr->user_name); ?>" />                
                </td>
                <td>Grade</td>
                <td>
                    <input  class="form-control" type="text" name="classgrade" value="<?php echo 
                    h($roomdata['ClassGrade']); ?>" />  
                </td>
    
            </tr>
            <tr>
                <td>Subject</td>
                <td>
                    <!--<input  class="form-control" type="text" name="subject" value="<?php echo 
                    h($crusr->subject); ?>" /> 
                    -->
                    <select name="subjectid"   style="height:35px;" class="btn-block input-sm">
                    <?php

                        while($subject = mysqli_fetch_assoc($subject_set)) {
                            echo "<option value=\"{$subject["SubjectId"]}\"";
                            if($subject["SubjectId"] == $selsubjectid) {
                                        echo " selected";
                                    }
                            echo ">{$subject["SubjectName"]}</option>";
                        }
                        
                    ?>
                    </select> 
                </td>
                <td>Period</td>
                <td>
                    <select name="periodno" class="btn-block input-sm" 
                            style="height:35px;">
                    <?php

                        while($period = mysqli_fetch_assoc($period_set)) {
                            echo "<option value=\"{$period["PeriodNo"]}\"";
                            if($period["PeriodNo"] == $selperiod) {
                                        echo " selected";
                                    }
                            echo ">{$period["periodtitle"]}</option>";
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
                        if($selectedday == $i) {
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
                        if($selectedyear == $i) {
                        echo " selected";
                        }
                        echo ">{$i}</option>";
                    }
                    ?>
				</select>  

                </td>

            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" name="search" value="Display Attendance"
                    class="btn btn-primary btn-block" <?php if($roomdata['RoomNo']==null) echo 'disabled' ?>    />                 
                </td>
            </tr>
        </table>
        <?php 
            
        ?>
        <table class="table table-condensed">
          <tr class="btn-primary">
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Start</th>
            <th>End</th>
            <th>Attandance Time</th>
            <th>Date</th>
            <th>More Information</th>

            <!-- 
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            -->
          </tr>

          <?php foreach($room_set as $room) { ?>
            <tr>
              <td><?php echo h($room['studentid']); ?></td>
              <td><?php echo h($room['studentname']); ?></td>
              <td><?php echo h($room['starttime']); ?></td>
              <td><?php echo h($room['endtime']); ?></td>
              <td><?php echo h($room['time_attendance']); ?></td>
              <td><?php echo h($room['date_ttendance']); ?></td>
              <td>
                <a class="action btn btn-default btn-block" 
                    href="<?php 
                         echo url_for('student/info.php?id=' . h($room['studentid']) . "&studentname=" . h($room['studentname'])) . 
                                        "&cdate=" . h("$cdate"); 
                         
                         ?>">
                    Show
                </a>              
              </td>

              
            </tr>
          <?php } ?>
        </table>
      <?php
          
          mysqli_free_result($room_set);
          mysqli_free_result($school_set);
          mysqli_free_result($period_set);
          mysqli_free_result($subject_set);
      ?>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

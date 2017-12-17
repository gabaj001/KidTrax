<?php require_once('../../../private/initialize.php'); ?>
 
<?php

  //-------------------- parent kid attendance Page --------------------------------
  include(SHARED_PATH . '/session.php');
  $selectedschool = null;
  if(is_post_request())
  {
      if (isset($_POST['search']))
      {
        
       
       
       $studentid = $_POST['studentid'];
       $searchby = $_POST['searchby'];
       
       $selectedday = $_POST['day'];
       $selectedyear = $_POST['year'];
       $selectedmonth = $_POST['month'];

        /*if ($searchby=="Today") 
        {

            $date = date("Y/m/d"); //date_create(getCurrentdate()["curdate"]);
    
            $selectedday = date_format($date,'d');
            $selectedyear = date_format($date,'Y');
            $selectedmonth = date_format($date,'m');
            

        }*/

        $date=date_create($selectedyear.'-'.$selectedmonth  . '-' . $selectedday);
        
        $cdate = date_format($date,'Y-m-d');
        //echo $cdate;
        $studentschedule_set = student_schedule($studentid,$cdate);


        
      }
      
      
  }
  
 

?>

<?php $page_title = 'Teacher info'; ?>

<?php 
     include(SHARED_PATH . '/track_header.php'); 

     //$crusr->printfields();
     

     //$period_set = find_teacher_period($crusr->userid,$crusr->schoolno);
     //$subject_set = teacher_subjects($crusr->userid,$crusr->schoolno);
     //$roomdata = find_room_by_teacher($crusr->userid,$crusr->schoolno);

     $date = date_create(getCurrentdate()["curdate"]);

     // for loop to list years
     $currentyear = date_format($date,'Y');

    $children_set = parent_children($crusr->userid) ;
    $school_set = student_schools();
    



    
    $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 
                    5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 
                    9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');

 
    
 
     
?>

<script type="text/javascript">
    
    function studentsschool()
    {
        //alert(document.getElementById("studentid").value);
        //alert("23232");
        document.getElementById("school").value = document.getElementById("studentid").value;
        
    }


    

</script>

<div id="content" class="well container-fliud">
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">Student Attendance</h1>
    <form name="teacherForm"  class="form-inline"
        action="<?php echo url_for('/staff/parents/kidattd.php'); ?>" 
        method="post">

        <table class="table">
            <tr>
                <td>Name</td>
                <td>

                    <select onchange="studentsschool();"  name="studentid" id="studentid"  style="height:35px;" class="btn-block input-sm">
                    <?php

                        while($children = mysqli_fetch_assoc($children_set)) {
                            echo "<option value=\"{$children["studentID"]}\"";
                            if($children["studentID"] == $studentid) {
                                        echo " selected";
                                    }
                            echo ">{$children["studentName"]}</option>";
                        }
                       
                    ?>
                    </select> 
                </td>
                <td>School<td/>
                <td>

                    <select name="school" id="school"  style="height:35px;" class="btn-block input-sm" disabled>
                    <?php

                        while($school = mysqli_fetch_assoc($school_set)) {
                            echo "<option value=\"{$school["studentID"]}\"";
                            if($school["studentID"] == $studentid) {
                                        echo " selected";
                                    }
                            echo ">{$school["SchoolName"]}</option>";
                        }
                       
                    ?>
                    </select> 

                    <script type="text/javascript">
                        studentsschool();
                    </script>
                
                
                </td>
                <td>

                <select  name="searchby" style="height:35px;" class="form-control input-sm" disabled>

                        <option value="ByDate" <?php if ($searchby=="Date") echo "selected"; ?>>By Date</option>
                        <option value="Today" <?php if ($searchby=="Today") echo "selected"; ?>>Today</option>
        

                </select>
                   
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
                    <input type="submit" name="search" value="Display Attendance"
                    class="btn btn-primary"/>    

                </td>
                <td>
             
                </td>

            </tr>

        </table>
        <?php 
            
        ?>
        <table class="table table-condensed">
          <tr class="btn-primary">
            <th>Subject Name</th>
            <th>Start</th>
            <th>End</th>
            <th>Attandance Time</th>
            <th>Date</th>
            <th>More Information</th>


          </tr>

          <?php foreach($studentschedule_set as $studentschedule) { ?>
            <tr>
              <td><?php echo h($studentschedule['subjectname']); ?></td>
              <td><?php echo h($studentschedule['starttime']); ?></td> 
              <td><?php echo h($studentschedule['endtime']); ?></td> 
              <td><?php echo h($studentschedule['time_attendance']); ?></td>
              <td><?php echo h($studentschedule['date_ttendance']); ?></td>
              <td>
                <a class="action btn btn-default btn-block" 
                    href="<?php 
                         echo url_for('student/info.php?id=' . h($studentschedule['studentid']) . 
                                        "&studentname=" . h($studentschedule['studentname']) . 
                                        "&cdate=" . h("$cdate")); 
                         
                         ?>">
                    Show
                </a>              
              </td>

              
            </tr>
          <?php } ?>
        </table>
      <?php
          
          mysqli_free_result($studentschedule);
          mysqli_free_result($children_set);

      ?>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

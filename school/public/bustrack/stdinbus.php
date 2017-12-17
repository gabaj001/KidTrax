<?php require_once('../../private/initialize.php'); ?>
 
<?php

  //-------------------- student in the bus --------------------------------
  include(SHARED_PATH . '/session.php');

  if (!isset($_GET['schoolno'])) {

        redirect_to(url_for('/index.php'));

  }

    $schoolno = $_GET['schoolno'];
    $busno = $_GET['busno'];
    $cdate = $_GET['cdate'];
    $tripstate= $_GET['tripstate'];

    $student_bus = studnt_in_bus($schoolno,$busno,$cdate,$tripstate);

 


?>

<?php $page_title = 'Teacher info'; ?>

<?php 
     include(SHARED_PATH . '/track_header.php'); 
?>

<div id="content" class="well container-fliud" style='overflow:scroll;height:400px;'>
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">Student In The Bus </h1>
    <form name="StudetinbusForm"  class="form-inline"
        action="" 
        method="">

        <table class="table">
            <tr>
                <td>Bus No</td>
                <td>
                    <input  class="form-control btn-block" type="text" name="busno" value="<?php echo 
                    h($busno); ?>" readonly />
                </td>
                <td>Date </td>
                <td>
                    <input  class="form-control btn-block" type="text" name="cdate" value="<?php echo 
                    h($cdate); ?>" readonly />
                 </td>
            </tr>
         </table>
        <?php 
            
        ?>
        <table class="table table-condensed">
          <tr class="btn-primary">
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Time In</th>
            <th>Date In</th>

            

          </tr>

          <?php foreach($student_bus as $student) { ?>
            <tr>
              <td><?php echo h($student['studentid']); ?></td>
              <td><?php echo h($student['studentname']); ?></td>
              <td><?php echo h($student['time_attendance']); ?></td>
              <td><?php echo h($student['date_attendance']); ?></td>
              
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

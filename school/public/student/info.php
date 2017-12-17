<?php require_once('../../private/initialize.php'); ?>
 
<?php

  //-------------------- Student activities Page 01--------------------------------
  include(SHARED_PATH . '/session.php');

  if (!isset($_GET['id'])) {

        redirect_to(url_for('/staff/teachers/index.php'));

  }

  $id = $_GET['id'];
  $studentname = $_GET['studentname'];
  $cdate = $_GET['cdate'];

  //$date = date_create(getCurrentdate()["curdate"]);
  //$cdate = date_format($date,'Y-m-d');

  $activity_set = find_student_activities($id,$crusr->schoolno,$cdate);
 
 

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
        action=""  method="">

        <table class="table">
            <tr>
                <td>Student Id</td>
                <td>
                    <input  class="form-control btn-block" type="text" name="studentid" value="<?php echo 
                    h($id); ?>" readonly />
                </td>
                <td>Student Name  </td>
                <td>
                    <input  class="form-control input-sm" type="text" name="teachername" value="<?php echo 
                    h($studentname); ?>" readonly />                
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

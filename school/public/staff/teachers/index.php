<?php require_once('../../../private/initialize.php'); ?>

<?php

  //-------------------- Teacher Page --------------------------------
  include(SHARED_PATH . '/session.php');
  $selectedschool = null;
  if(is_post_request())
  {
      if (isset($_POST['search']))
      {
        
        $schoolno = $_POST['selschool'];
        
        $selectedschool = $schoolno;
      }
      
      
  }
  
  //$teacher_set = find_all_teachers();

  $school_set = find_all_schools();

  $teacher_set = find_teachers_by_School($schoolno);

?>

<?php $page_title = 'Teacher info'; ?>

<?php include(SHARED_PATH . '/track_header.php'); ?>

<div id="content" class="container-fluid well">
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">Teachers</h1>
    <form name="teacherForm" 
        action="<?php echo url_for('/staff/teachers/index.php'); ?>" method="post">
        <?php include(SHARED_PATH . '/schoolsearch.php'); ?>
        <div class="actions">
          <!--
            <a class="action" href="<?php echo url_for('/staff/teachers/new.php'); ?>">Create New Subject</a>
            -->
        </div>

        <table class="list table table-condensed table-responsive">
          <tr class="btn-primary">
            <th>Teacher ID</th>
            <th>Teacher Name</th>
            <th>Email</th>
            <th>User Name</th>
            <th>Account State</th>
            <th>&nbsp;</th>
            <!-- 
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            -->
          </tr>

          <?php while($teacher = mysqli_fetch_assoc($teacher_set)) { ?>
            <tr>
              <td><?php echo h($teacher['TeacherId']); ?></td>
              <td><?php echo $teacher['TeacherName']; ?></td>
              <td><?php echo $teacher['Email']; ?></td>
              <td><?php echo $teacher['UserName']; ?></td>
              <td>
                  <?php 
                      if($teacher["accountstate"] == 0) 
                        { 
                          echo "Disabled";
                        } else {

                          echo "Enabled";

                        }
                  ?>
              </td>
              <td>
                  <a class="action" href="<?php echo url_for('/staff/teachers/edit.php?id=' . h($teacher[TeacherId]))
                       . "&schoolno=" . h($schoolno); ?>">
                    <?php echo $teacher['AccountId'] == null ? 'Create account' : 'Edit account'; ?>
                  </a>
              </td>
            </tr>
          <?php } ?>
        </table>
      <?php
          
          mysqli_free_result($teacher_set);
          mysqli_free_result($school_set);
      ?>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

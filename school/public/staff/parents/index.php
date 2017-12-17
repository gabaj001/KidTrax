<?php require_once('../../../private/initialize.php'); ?>

<?php
  //-------------------- Parent Page --------------------------------
  
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

  //echo "<script>alert('test')</script>";

  $school_set = find_all_schools();

  $parents_set = find_parents_by_School($schoolno);


?>

<?php $page_title = 'parents info'; ?>
<?php include(SHARED_PATH . '/track_header.php'); ?>

<div id="content" class="container-fluid well">
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">Parent Users</h1>
    <form name="parentForm" 
        action="<?php echo url_for('/staff/parents/index.php'); ?>" method="post">
    <?php include(SHARED_PATH . '/schoolsearch.php'); ?>

  	<table class="list table table-condensed table-responsive">
  	  <tr class="btn-primary">
        <th>Name</th>
        <th>Email</th>
        <th>User Name</th>
        <th>Account State</th>
  	    <th>&nbsp;</th>

  	  </tr>

      <?php while($parents = mysqli_fetch_assoc($parents_set)) { ?>
        <tr>
          
          <td><?php echo $parents['studentParentName']; ?></td>
    	    <td><?php echo $parents['Email']; ?></td>
          <td><?php echo $parents['UserName']; ?></td>
          <td>
              <?php 
                   if($parents["accountstate"] == 0) 
                    { 
                      echo "Disabled";
                    } else {

                       echo "Enabled";

                    }
              ?>
          </td>
          <td>
              <a class="action" href="<?php echo url_for('/staff/parents/edit.php?id=' . h(h($parents[studentParentNo]))); ?>">
                <?php echo $parents['AccountId'] == null ? 'Create account' : 'Edit account'; ?>
              </a>
           </td>
    	  </tr>
      <?php } ?>
    </table>

    </form>

    <?php
         
         mysqli_free_result($parents_set);
         mysqli_free_result($school_set);
    ?>
  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

<?php 
   require_once('../../private/initialize.php');

   session_start();
   if (!isset($_SESSION['currentuser']))
   {
      
      //redirect_to(url_for('/login/login.php'));
      
   }
?>

<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

      <div id="content">
        <div id = "main-menu">
            <h2>Account Manage</h2>
                <ul>
                  <li><a href="<?php echo url_for('/staff/teachers/index.php'); ?>">Teachers</a></li>
                  <li><a href="<?php echo url_for('/staff/parents/index.php'); ?>">Parents</a></li>
                  <li><a href="<?php echo url_for('/staff/staffusers/index.php'); ?>">User Staff</a></li>
                  <li><a href="<?php echo url_for('/staff/schooladmin/index.php'); ?>">School Admin</a></li>


                </ul>

                <h2>Tracking student</h2>
                <ul>
                  <li><a href="<?php echo url_for('/staff/teachers/index.php'); ?>">In School</a></li>
                  <li><a href="<?php echo url_for('/staff/parents/index.php'); ?>">In Bus</a></li>
                </ul>
        </div>
      </div>

 
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
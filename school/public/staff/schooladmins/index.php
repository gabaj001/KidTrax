<?php require_once('../../../private/initialize.php'); ?>

<?php

  //-------------------- School admin Page --------------------------------
  include(SHARED_PATH . '/session.php');
 
  if(is_post_request())
  {
      if (isset($_POST['search']))
      {
        
        $schoolno = $_POST['selschool'];
        
        $selectedschool = $schoolno;

        $user_set = find_User_by_School($selectedschool);

      }
      
      
  } else {

     $selectedschool = 0;
  }
  
  
  $school_set = find_all_schools();

  $currentSchool = 0;

?>

<?php $page_title = 'School Admin Users'; ?>

<?php include(SHARED_PATH . '/track_header.php'); ?>

<script type="text/javascript">
    
    function currentschool()
    {
        //alert(document.getElementById("selschool").value);
        //alert("23232");
        //document.getElementById("school").value = document.getElementById("studentid").value;
        document.getElementById("currentschoolno").value = document.getElementById("selschool").value;
        
    }

    function addnewuser()
    {
        //alert(document.getElementById("currentschoolno").value);
        window.location=document.getElementById("linktocreate").value + "?schoolno=" + 
         document.getElementById("currentschoolno").value;
    }
    

</script>

<div id="content" class="container-fluid well">
  <div>
    <h1 style="margin-bottom:30px;margin-top:-0px">School Admin Users</h1>
    <form name="userForm" 
        action="<?php echo url_for('/staff/schooladmins/index.php'); ?>" method="post">
    <div class="form-group" >

        <label class="col-form-label" style="font-size: 20px;">School</label>
        <select onchange="currentschool()" name="selschool" id="selschool" class="selectpicker" 
                style="height:35px;margin-left:10px;margin-right:10px;">
          <?php

              while($school = mysqli_fetch_assoc($school_set)) {
                echo "<option value=\"{$school["SchoolNo"]}\"";
                if($school["SchoolNo"] == $selectedschool) {
					        echo " selected";
					      }
                echo ">{$school["SchoolName"]}  -  {$school["schooldistrict"]}</option>";
              }
              
          ?>
      </select>


        <input type="submit" name="search" value="Search"
        class="btn btn-primary"/>
        
        

        <a id="adduser" onclick="addnewuser()" href="JavaScript:void(0);" class="btn btn-primary">Add User</a>

        <input type="text" name="currentschoolno" id = "currentschoolno" value="" hidden>
        <input type="text" name="linktocreate" id = "linktocreate" value="<?php echo url_for('/staff/schooladmins/new.php'); ?>" hidden >
        <script type="text/javascript">
                currentschool();
        </script>

    </div>
        <div class="actions">
          <!--
            <a class="action" href="<?php echo url_for('/staff/users/new.php'); ?>">Create New Subject</a>
            -->
        </div>

        <table class="list table table-condensed table-responsive">
          <tr class="btn-primary">
            <th>Name</th>
            <th>Email</th>
            <th>User Name</th>
            <th>Account State</th>
            <th>&nbsp;</th>

          </tr>

          <?php while($user = mysqli_fetch_assoc($user_set)) { ?>
            <tr>
              <td><?php echo h($user['User_Name']); ?></td>
              <td><?php echo $user['Email']; ?></td>
              <td><?php echo $user['UserName']; ?></td>
              <td>
                  <?php 
                      if($user["accountstate"] == 0) 
                        { 
                          echo "Disabled";
                        } else {

                          echo "Enabled";

                        }
                  ?>
              </td>
              <td>
                  <a class="action" href="<?php echo url_for('/staff/schooladmins/edit.php?schoolno=' . h($schoolno))
                       . "&userid=" . h($user['UserId']); ?>">
                    <?php echo $user['AccountId'] == null ? 'Edit account' : 'Edit account'; ?>
                  </a>
              </td>
            </tr>
          <?php } ?>
        </table>
      <?php
          
          mysqli_free_result($user_set);
          mysqli_free_result($school_set);
      ?>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

<?php

    require_once('../../../private/initialize.php');
    include(SHARED_PATH . '/session.php');

    if (!isset($_GET['schoolno'])) {

        redirect_to(url_for('/staff/schooladmins/index.php'));

    }

    $schoolno = $_GET['schoolno'];
    $userid = $_GET['userid'];

    if(is_post_request())
    {
        $schooladmin = [];
        $schooladmin['userid'] = $userid;
        $schooladmin['user_name'] = $_POST['user_name'] ?? '';
        $schooladmin['email'] = $_POST['email'] ?? '';
        $schooladmin['accountstate'] = $_POST['accountstate'] ?? '';
        $schooladmin['username'] = $_POST['username'] ?? ''; 
        $schooladmin['password'] = $_POST['password'] ?? '';
        $schooladmin['createdate']= date("Y/m/d") ?? '';
        $schooladmin['role'] = 'schooladmin' ?? ''; 
        $schooladmin['accountid'] = $_POST['accountid'];
        $schooladmin['save'] = $_POST['save'];
        $schooladmin['newuser'] = false;
        $schooladmin['schoolno'] = $schoolno;

        
        $result = editaccount($schooladmin);

        
        if ($result === true) {
          redirect_to(url_for('/staff/schooladmins/edit.php?schoolno=' . $schoolno . "&userid=" . $userid));
        } else {

            $erorrs = $result;
            
        }



    } else {

      
     
     $schooladmin_rc = find_staffuser_by_id($userid,$schoolno);

    }

    
?>

<?php $page_title = 'School Aadmin Account'; ?>
<?php include(SHARED_PATH . '/track_header.php'); ?>

<div id="content">
  <!--
   <a class="back-link" href="<?php echo 
    url_for('/staff/schooladmins/index.php'); ?>">&laquo; Back to List</a>
  -->
  <div class="container-fluid well fixed-top" style="margin-top:0px;">
    <h2 class="form-group row" >
        <?php
            if ($id==null) 
                echo 'Edit School Admin Account';
            else 
                echo 'Edit School Admin Account'; 
         ?>
      
    </h2>
    <?php echo display_errors($erorrs); ?>
    <form action="<?php echo url_for('/staff/schooladmins/edit.php?schoolno=' .
        u($schoolno)) . "&userid=" . $userid; ?>" method="post">
          <div class="form-group row" hidden>
            <Label for="example-text-input" class="col-2 col-form-label">
              User ID
            </Label>
            <div class="col-10">
                <input class="form-control" class="form-control" type="text" name="userid" value="<?php echo 
                h($schooladmin_rc['UserID']); ?>" disabled />
            </div>
          </div>
          <div class="form-group row">
              <Label for="example-text-input" class="col-2 col-form-label">
                Name
              </Label>
              <div class="col-10">
                  <input class="form-control" class="form-control" type="text" name="user_name" value="<?php echo 
                  h($schooladmin_rc['User_Name']); ?>" />
              </div>
          </div>
          <div class="form-group row">
              <Label for="example-text-input" class="col-2 col-form-label">
                Email
              </Label>
              <div class="col-10">
                <input class="form-control" class="form-control" type="text" name="email" value="<?php echo 
                h($schooladmin_rc['Email']); ?>" />
              </div>

          </div>
          <div class="form-group row">
                <Label for="example-text-input" class="col-2 col-form-label">
                  User Name
                </Label>
                <div class="col-10">
                    <input class="form-control" class="form-control" type="text" name="username" value="<?php echo 
                    h($schooladmin_rc['UserName']); ?>" />
                </div>
          </div>
          <div class="form-group row">
            <Label for="example-text-input" class="col-2 col-form-label">
              PassWord
            </Label>
            <div class="col-10">
                <input class="form-control" type="password" name="password" value="<?php echo 
                h($schooladmin_rc['PassWord']); ?>" />
            </div>
            </div>
            <div class="form-group row"> 
              <Label for="example-text-input" class="col-2 col-form-label">
                Created Date
              </Label>
              <div class="col-10">
                  <input class="form-control" type="text" name="createdate" value="<?php 
                      if($schooladmin_rc['CreateDate']==null) {

                        echo date("Y/m/d");
                      } else {
                        echo h($schooladmin_rc['CreateDate']); 
                      }

                    ?>" 
                    disabled />
              </div>
            </div>
            <div class="form-group row">
              <Label for="example-text-input" class="col-2 col-form-label">
                 Acount State 
              </Label>
              <select class="form-control" name="accountstate">
                <option value="0" 
                  <?php if($schooladmin_rc["accountstate"] == 0) 
                  { echo " selected";} ?>
                  >Disabled</option>
                  <option value="1" 
                  <?php if($schooladmin_rc["accountstate"] == 1) 
                  { echo " selected";} ?>
                  >Enabled</option>;
              </select>
              <input class="form-control" type="hidden"  name="accountid" value="<?php echo 
                    h($schooladmin_rc['AccountId']); 
                  ?>"/>
          </div>
          <div id="operations" class="form-group row">
            <input  type="submit" name="save" value="<?php 
                  if($schooladmin_rc['AccountId'] == null) 
                  { 
                    echo 'Edit Account';
                  } else {

                    echo 'Edit Account';
                    }
                  ?>" />
          </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

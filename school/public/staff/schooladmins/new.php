<?php

    require_once('../../../private/initialize.php');
    include(SHARED_PATH . '/session.php');

    if (!isset($_GET['schoolno'])) {

        redirect_to(url_for('index.php'));

    }

    $schoolno= $_GET['schoolno'];

    if(is_post_request())
    {
        $schooladmin = [];
        //$schooladmin['userid'] = $id;
        $schooladmin['user_name'] = $_POST['user_name'] ?? '';
        $schooladmin['email'] = $_POST['email'] ?? '';
        $schooladmin['accountstate'] = $_POST['accountstate'] ?? '';
        $schooladmin['username'] = $_POST['username'] ?? ''; 
        $schooladmin['password'] = password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT);
        $schooladmin['createdate']= date("Y/m/d") ?? '';
        $schooladmin['role'] = 'schooladmin' ?? ''; 
        $schooladmin['accountid'] = $_POST['accountid'];
        $schooladmin['save'] = $_POST['save'];
        $schooladmin['newuser'] = true;
        $schooladmin['schoolno'] = $schoolno;

        $result = createaccount($schooladmin);

       
        
        if ($result === true) {
            //redirect_to(url_for('/staff/schooladmins/new.php?id=' . $id));
        } else {

            $erorrs = $result;
            
        }



    } else {

      
     
     //$schooladmin = find_staffuser_by_id($id);

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
                echo 'Create School Admin Account';
            else 
                echo 'Create School Admin Account'; 
         ?>
      
    </h2>
    <?php echo display_errors($erorrs); ?>
    <form action="<?php echo url_for('/staff/schooladmins/new.php?schoolno=' .
        u($schoolno)); ?>" method="post">
          <div class="form-group row" hidden>
            <Label for="example-text-input" class="col-2 col-form-label">
              User ID
            </Label>
            <div class="col-10">
                <input class="form-control" class="form-control" type="text" name="userid" value="<?php echo 
                h($schooladmin['UserID']); ?>" disabled />
            </div>
          </div>
          <div class="form-group row">
              <Label for="example-text-input" class="col-2 col-form-label">
                Name
              </Label>
              <div class="col-10">
                  <input class="form-control" class="form-control" type="text" name="user_name" value="<?php echo 
                  h($schooladmin['User_Name']); ?>" />
              </div>
          </div>
          <div class="form-group row">
              <Label for="example-text-input" class="col-2 col-form-label">
                Email
              </Label>
              <div class="col-10">
                <input class="form-control" class="form-control" type="text" name="email" value="<?php echo 
                h($schooladmin['Email']); ?>" />
              </div>

          </div>
          <div class="form-group row">
                <Label for="example-text-input" class="col-2 col-form-label">
                  User Name
                </Label>
                <div class="col-10">
                    <input class="form-control" class="form-control" type="text" name="username" value="<?php echo 
                    h($schooladmin['UserName']); ?>" />
                </div>
          </div>
          <div class="form-group row">
            <Label for="example-text-input" class="col-2 col-form-label">
              PassWord
            </Label>
            <div class="col-10">
                <input class="form-control" type="password" name="password" value="<?php echo 
                h($schooladmin['PassWord']); ?>" />
            </div>
            </div>
            <div class="form-group row"> 
              <Label for="example-text-input" class="col-2 col-form-label">
                Created Date
              </Label>
              <div class="col-10">
                  <input class="form-control" type="text" name="createdate" value="<?php 
                      if($schooladmin['CreateDate']==null) {

                        echo date("Y/m/d");
                      } else {
                        echo h($schooladmin['CreateDate']); 
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
                  <?php if($schooladmin["accountstate"] == 0) 
                  { echo " selected";} ?>
                  >Disabled</option>
                  <option value="1" 
                  <?php if($schooladmin["accountstate"] == 1) 
                  { echo " selected";} ?>
                  >Enabled</option>;
              </select>
              <input class="form-control" type="hidden"  name="accountid" value="<?php echo 
                    h($schooladmin['AccountId']); 
                  ?>"/>
          </div>
          <div id="operations" class="form-group row">
            <input  type="submit" name="save" value="<?php 
                  if($schooladmin['AccountId'] == null) 
                  { 
                    echo 'Create Account';
                  } else {

                    echo 'Edit Account';
                    }
                  ?>" />
          </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/track_footer.php'); ?>

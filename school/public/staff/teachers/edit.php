<?php

    require_once('../../../private/initialize.php');
    include(SHARED_PATH . '/session.php');

    if (!isset($_GET['id'])) {

        redirect_to(url_for('/staff/teachers/index.php'));

    }

    $id = $_GET['id'];
    $schoolno = $_GET['schoolno'];
    

    if(is_post_request())
    {
        $teacher = [];
        $teacher['teacherid'] = $id;
        $teacher['teachername'] = $_POST['teachername'] ?? '';
        $teacher['email'] = $_POST['email'] ?? '';
        $teacher['accountstate'] = $_POST['accountstate'] ?? '';
        $teacher['username'] = $_POST['username'] ?? ''; 
        $teacher['password'] =  password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT);
        $teacher['createdate']= date("Y/m/d") ?? '';
        $teacher['role'] = 'teacher' ?? ''; 
        $teacher['accountid'] = $_POST['accountid'];
        $teacher['save'] = $_POST['save'];
        $teacher['schoolno'] = $_POST['schoolno'];
        $schoolno = $teacher['schoolno'];

        //$result = update_subject($subject);
        if ($teacher['save'] == 'Create Account') 
        {
            $result = createaccount($teacher);

        } else {

            $result = editaccount($teacher);

        }
        
        if ($result === true) {
            redirect_to(url_for('/staff/teachers/edit.php?id=' . $id));
        } else {

            $erorrs = $result;
            
        }



    } else {

      
     //global $schoolno;
     $teacher = find_teacher_by_id($id);

    }

    
?>

<?php $page_title = 'Teacher Account'; ?>
<?php include(SHARED_PATH . '/track_header.php'); ?>

<div id="content">
  <!--
   <a class="back-link" href="<?php echo 
    url_for('/staff/teachers/index.php'); ?>">&laquo; Back to List</a>
  -->
  <div class="container-fluid well fixed-top" style="margin-top:0px;">
    <h2 class="form-group row" >Teacher Account</h2>
    <?php echo display_errors($erorrs); ?>
    <form action="<?php echo url_for('/staff/teachers/edit.php?id=' .
        h(u($id))); ?>" method="post">
          <div class="form-group row" hidden>
            <Label for="example-text-input" class="col-2 col-form-label">
              Teacher ID
            </Label>
            <div class="col-10">
                <input class="form-control" class="form-control" type="text" name="teacherid" value="<?php echo 
                h($teacher['TeacherId']); ?>" disabled />
            </div>
          </div>
          <div class="form-group row">
              <Label for="example-text-input" class="col-2 col-form-label">
                Teacher Name
              </Label>
              <div class="col-10">
                  <input class="form-control" class="form-control" type="text" name="teachername" value="<?php echo 
                  h($teacher['TeacherName']); ?>" disabled />
              </div>
          </div>
          <div class="form-group row">
              <Label for="example-text-input" class="col-2 col-form-label">
                Email
              </Label>
              <div class="col-10">
                <input class="form-control" class="form-control" type="text" name="email" value="<?php echo 
                h($teacher['Email']); ?>" />
              </div>

          </div>
          <div class="form-group row">
                <Label for="example-text-input" class="col-2 col-form-label">
                  User Name
                </Label>
                <div class="col-10">
                    <input class="form-control" class="form-control" type="text" name="username" value="<?php echo 
                    h($teacher['UserName']); ?>" />
                </div>
          </div>
          <div class="form-group row">
            <Label for="example-text-input" class="col-2 col-form-label">
              PassWord
            </Label>
            <div class="col-10">
                <input class="form-control" type="password" name="password" value="<?php echo 
                h($teacher['PassWord']); ?>" />
            </div>
            </div>
            <div class="form-group row"> 
              <Label for="example-text-input" class="col-2 col-form-label">
                Created Date
              </Label>
              <div class="col-10">
                  <input class="form-control" type="text" name="createdate" value="<?php 
                      if($teacher['CreateDate']==null) {

                        echo date("Y/m/d");
                      } else {
                        echo h($teacher['CreateDate']); 
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
                  <?php if($teacher["accountstate"] == 0) 
                  { echo " selected";} ?>
                  >Disabled</option>
                  <option value="1" 
                  <?php if($teacher["accountstate"] == 1) 
                  { echo " selected";} ?>
                  >Enabled</option>;
              </select>
              <input class="form-control" type="hidden"  name="accountid" value="<?php echo 
                    h($teacher['AccountId']); 
                  ?>"/>
              <input class="form-control" type="hidden"  name="schoolno" value="<?php echo 
                    h($schoolno); 
              ?>"/>

          </div>
          <div id="operations" class="form-group row">
            <input  type="submit" name="save" value="<?php 
                  if($teacher['AccountId'] == null) 
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

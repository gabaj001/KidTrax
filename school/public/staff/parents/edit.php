<?php

    require_once('../../../private/initialize.php');
    include(SHARED_PATH . '/session.php');
    
    if (!isset($_GET['id'])) {

        redirect_to(url_for('/staff/parents/index.php'));

    }

    $id = $_GET['id'];
    
    

    if(is_post_request())
    {
        $parent = [];
        $parent['studentparentno'] = $id;
        $parent['studentparentname'] = $_POST['studentparentname'] ?? '';
        $parent['email'] = $_POST['email'] ?? '';
        $parent['accountstate'] = $_POST['accountstate'] ?? '';
        $parent['username'] = $_POST['username'] ?? ''; 
        $parent['password'] = password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT);
        $parent['createdate']= date("Y/m/d") ?? '';
        $parent['role'] = 'parent' ?? ''; 
        $parent['accountid'] = $_POST['accountid'];
        $parent['save'] = $_POST['save'];
       
        if ($parent['save'] == 'Create Account') 
        {
            $result = createaccount($parent);

        } else {

            $result = editaccount($parent);

        }
        
        if ($result === true) {
            redirect_to(url_for('/staff/parents/edit.php?id=' . $id));
        } else {

            $erorrs = $result;
            
        }



    } else {

      
     
     $parent = find_parent_by_id($id);

    }

    
?>

<?php $page_title = 'Edit parent'; ?>
<?php include(SHARED_PATH . '/track_header.php'); ?>

<div id="content">
  <!--
   <a class="back-link" href="<?php echo 
    url_for('/staff/parents/index.php'); ?>">&laquo; Back to List</a>
  -->
  <div class="container-fluid well fixed-top" style="margin-top:0px;">
    <h1>Parent Account</h1>
    <?php echo display_errors($erorrs); ?>
    <form action="<?php echo url_for('/staff/parents/edit.php?id=' .
        h(u($id))); ?>" method="post">
      <div class="form-group row">
        <Label for="example-text-input" class="col-2 col-form-label">
          Name
        </Label>
        <div class="col-10">
            <input class="form-control" type="text" name="studentparentname" value="<?php echo 
            h($parent['studentParentName']); ?>" disabled />
        </div>
      </div>
      <div class="form-group row">
        <Label for="example-text-input" class="col-2 col-form-label">
          Email
        </Label>
        <div class="col-10">
          <input class="form-control" type="text" name="email" value="<?php echo 
          h($parent['Email']); ?>" />
        </div>
      </div>
      <div class="form-group row">
        <Label for="example-text-input" class="col-2 col-form-label">
          User Name
        </Label>
        <div class="col-10">
            <input class="form-control" type="text" name="username" value="<?php echo 
            h($parent['UserName']); ?>" />
        </div>
      </div>
      <div class="form-group row">
        <Label for="example-text-input" class="col-2 col-form-label">
            PassWord
        </Label>
        <div class="col-10">
          <input class="form-control" type="password" name="password" value="<?php echo 
          h($parent['PassWord']); ?>" />
        </div>
      </div>
      <div class="form-group row">
          <Label for="example-text-input" class="col-2 col-form-label">
              Created Date
          </Label>
          <div class="col-10">
              <input class="form-control" type="text" name="createdate" value="<?php 
                if($parent['CreateDate']==null) {

                  echo date("Y/m/d");
                } else {
                  echo h($parent['CreateDate']); 
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
              <?php if($parent["accountstate"] == 0) 
              { echo " selected";} ?>
              >Disabled</option>
              <option value="1" 
              <?php if($parent["accountstate"] == 1) 
              { echo " selected";} ?>
              >Enabled</option>;
          </select>
          <input type="hidden"  name="accountid" value="<?php echo 
                h($parent['AccountId']); 
              ?>"/>
          <input type="hidden"  name="studentparentno" value="<?php echo 
                h($parent['studentParentNo']); 
              ?>"/>
      </div>
      <div id="operations" class="form-group row">
        <input type="submit" name="save" value="<?php 
              if($parent['AccountId'] == null) 
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

<?php

    require_once('../../private/initialize.php');
    include(SHARED_PATH . '/session.php');
   
    if(is_post_request())
    {
        if (isset($_POST['editprofile']))
        {
            $user = [];
            $user['accountid'] = $_POST['accountid'];
            $user['user_name'] = $_POST['user_name'];
            $user['email'] = $_POST['email'];

            $crusr->accountid = $_POST['accountid'];
            $crusr->user_name = $_POST['user_name'];
            $crusr->email = $_POST['email']; 

            $result = edituser($user);
            //$erorrs = "Error";

        } else if (isset($_POST['changeusername'])) {

            $user = [];
            $user['accountid'] = $_POST['accountid'];
            $user['username'] = $_POST['username'];
            $user['accountstate'] = $_POST['accountstate'];

            $crusr->username = $_POST['username'];
            $result = editusername($user);
        
        } else if (isset($_POST['changepw']))
        {

            $user = [];
            $user['accountid'] = $_POST['accountid'];
            $user['username'] = $_POST['username'];
            $user['accountstate'] = $_POST['accountstate'];
            $user['password'] =  password_hash($_POST['newpassword'], PASSWORD_BCRYPT);
            $user['confirmpassword'] = password_hash($_POST['confirmpassword'], PASSWORD_BCRYPT);
            //$user['oldpassword'] = $_POST['oldpassword'];
            if($_POST['newpassword'] != $_POST['confirmpassword']) {

                $erorrs = "Password does not match the confirm password.";
                $result = false;

            } else {

                $crusr->username = $_POST['username'];
                $result = editaccount($user);

            }

           
        }

        if ($result === true) {

            // to update session
            unset($_SESSION['currentuser']);           
            $_SESSION['currentuser'] = serialize($crusr);
            //redirect_to(url_for('/login/myprofile.php'));


        } else {

            $erorrs = $result;
            
        }

    }    
?>

<?php $page_title = 'My Profile'; ?>
<?php include(SHARED_PATH . '/track_header.php'); ?>

<div id="content" ng-app="validation">
 
  <div class="container-fluid well" style="margin-top:0px;" 
        ng-controller="MyProfileController as MyProfile">
    <h1>My Profile</h1>
    <!--<?php echo display_errors($erorrs); ?>-->
    
    <!--<h3>{{MyProfile.message}}</h3>-->

    <form name="myprofileForm"  novalidate
        action="<?php echo url_for('/login/myprofile.php'); ?>" method="post">
        
      <div class="form-group row">
        <Label for="example-text-input" class="col-2 col-form-label">
          Name
        </Label>
        <div class="col-10">
            <input class="form-control" type="text" name="user_name" 
            ng-init="MyProfile.assignuser_name('<?php echo h($crusr->user_name); ?>')"  
            value={{MyProfile.user.user_name}}         
            <?php echo (($crusr->role == 'superadmin') ? '' : 'disabled'); ?>
             ng-model="MyProfile.user.user_name" required />
            <div ng-messages="myprofileForm.user_name.$error" ng-messages-include="messages.html"></div>
             
        </div>
      </div>

      <div class="form-group row">
        <Label for="example-text-input" class="col-2 col-form-label">
          Email
        </Label>
        <div class="col-10">
          <input class="form-control" type="text" name="email" 
            ng-init="MyProfile.assignuseremail('<?php echo h($crusr->email); ?>')"  
            value={{MyProfile.user.email}}  
            ng-model="MyProfile.user.email" 
            required
            pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$"/>
            <div ng-messages="myprofileForm.email.$error" ng-messages-include="messages.html"></div>
        </div>
      </div>

        <!-- hidden field -->
       <input type="hidden"  name="accountid" value="<?php echo 
        h($crusr->accountid);?>"/>
        <input type="hidden"  name="userid" value="<?php echo 
        h($crusr->userid);?>"/>
        <input type="hidden"  name="accountstate" value="<?php echo 
        h($crusr->accountstate);?>"/>

        <!-- Edit Profile Button -->
        <div id="operations" class="form-group row" 
         <?php echo (($crusr->role == 'superadmin') ? '' : 'hidden'); ?>>
            <input type="submit" name="editprofile" value="Edit Profile"
            class="btn btn-primary" 
            ng-disabled=" (myprofileForm.user_name.$error.required 
            || myprofileForm.email.$error.required
            || myprofileForm.email.$error.pattern) ? true : false" 
            />
        </div>

        <div class="form-group row">
            <Label for="example-text-input" class="col-2 col-form-label">
                User Name
            </Label>
            <div class="col-10" >
            <input class="form-control" type="text" name="username" 
                  <?php echo (($crusr->role == 'superadmin') ? '' : 'readonly'); ?>  
                  ng-init="MyProfile.assignuser('<?php echo h($crusr->username) ?>')"  
                  value={{MyProfile.user.username}} 
                  ng-model="MyProfile.user.username" required />
                  <div ng-messages="myprofileForm.username.$error" ng-messages-include="messages.html"></div>
                
            </div>
            
        </div> 
        <div id="operations" class="form-group row" 
            <?php echo (($crusr->role == 'superadmin') ? '' : 'hidden'); ?>>
            
            <input type="submit" name="changeusername" value="Change Username"
            class="btn btn-primary" ng-disabled="myprofileForm.username.$error.required"/>
            
        </div>
        <div class="form-group row">
            <Label for="example-text-input" class="col-2 col-form-label">
                New PassWord
            </Label>
            <div class="col-10">
            <input class="form-control" type="password" name="newpassword" 
                value="" ng-model="MyProfile.user.newpassword" required/>
                <div ng-messages="myprofileForm.newpassword.$error" 
                    ng-messages-include="messages.html"></div>
            </div>
        </div>
        <div class="form-group row">
            <Label for="example-text-input" class="col-2 col-form-label">
                Confirm PassWord
            </Label>
            <div class="col-10">
            <input class="form-control" type="password" name="confirmpassword" 
                value="" ng-model="MyProfile.user.confirmpassword" 
                required compare-to="MyProfile.user.newpassword" />
            <div ng-messages="myprofileForm.confirmpassword.$error" 
                ng-messages-include="messages.html"></div>
            </div>
        </div>
        
        <div id="operations" class="form-group row">
            <input type="submit" name="changepw" value="Change Password"
            class="btn btn-primary" 
            ng-disabled=" (myprofileForm.newpassword.$error.required
            || myprofileForm.confirmpassword.$error.required 
            || myprofileForm.username.$error.required
            || myprofileForm.confirmpassword.$invalid) ? true : false" />
            
        </div>
        
        
    </form>

  </div>

</div>


<?php include(SHARED_PATH . '/track_footer.php'); ?>

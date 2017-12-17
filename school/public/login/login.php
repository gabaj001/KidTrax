<?php 

   require_once('../../private/initialize.php');

   //ob_start();
   session_start();
  
    $user = [];

?>

<html lang = "en">
   
   <head>

      <meta charset="utf-8">
      <title>Login System</title>
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="viewport" content="width=device-width">
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" href="css/bootstrap.css">

   </head>
	
   <body>
      
      <div class = "container form-signin">
         <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
                
			   $user['username'] = $_POST['username'];
               $user['password'] = $_POST['password'];

               $currentuser = find_useraccount($user);
                //echo "<script>alert('HERE')</script>";
            
               if ($currentuser) {
                    $userrole = (($currentuser['Role'] == 'superadmin')
                                || ($currentuser['Role'] == 'staffusers')
                                || ($currentuser['Role'] == 'schooladmin'));
                                
                    if($userrole) 
                    {
                         
                        $user_t = find_user_by_id($currentuser['AccountId']);
                        $usr = new CurrentUser($currentuser,$user_t);
                        $_SESSION['currentuser'] = serialize($usr);

                    } else if ($currentuser['Role']=='teacher')
                    {
                        //redirect_to(url_for('index.php?='. $currentuser['AccountId'] ));
                        $user_t = find_teacher_by_Accountid($currentuser['AccountId']);
                        $usr = new CurrentUser($currentuser,$user_t);
                        $_SESSION['currentuser'] = serialize($usr);

                    } else  if ($currentuser['Role']=='parent') 
                    {
                        $user_t = find_parent_by_Accountid($currentuser['AccountId']);
                        $usr = new CurrentUser($currentuser,$user_t);
                        $_SESSION['currentuser'] = serialize($usr);
                        
                    }
                    
                    redirect_to(url_for('index.php'));

                    
               } else {
                    
                    $msg = 'Wrong username or password';

               }
            }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
         
 

         <div class="row" style="margin-top:100px;position: relative;">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 well">
                
                <form class = "form-signin" role = "form"
                    action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
                    ?>" method = "post">
                <fieldset> 
                    <h3>Sign In</h3>
                    <hr class="colorgraph">
                    <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
                    <div class="form-group">
                        <input type = "text" class="form-control input-lg" 
                        name = "username" placeholder = "Username" 
                        required autofocus></br>
                    </div>
                    <div class="form-group">
                        <input type = "password" class="form-control input-lg"
                        name = "password" placeholder = "Password" required>
                    </div>
                    
                    <hr class="colorgraph">  
                    <div class="row">  
                        <div class="col-xs-8 col-sm-8 col-md-8 col-xs-offset-2 col-sm-offset-2 col-md-offset-2">
                        <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
                        name = "login">Login</button>
                        </div>
                    </div>
                </fieldset>
                </form>
            </div> 
        </div> 
      </div> 
      
   </body>
</html>
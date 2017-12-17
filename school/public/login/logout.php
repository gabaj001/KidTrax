<?php
   require_once('../../private/initialize.php');
   session_start();
   unset($_SESSION['currentuser']);
   session_destroy(); 
   redirect_to(url_for('/login/login.php'));
?>
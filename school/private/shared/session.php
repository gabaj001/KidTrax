<?php

 
   session_start(); 
   if (!isset($_SESSION['currentuser']))
   {
      
      redirect_to(url_for('/login/login.php'));
      
   } else {
 
       $crusr =  unserialize($_SESSION['currentuser']);
        //echo $crusr->user_name;
       //$crusr->printfields();
       //echo url_for('/stylesheets/style4.css');
   }

   
?>

<?php 
require_once('../../private/initialize.php');
?>
<?php
       
        session_start();
        if (isset($_SESSION['currentuser'])) {
            $object =  unserialize($_SESSION['test']);
            
            echo $object->username . '<br>';
            echo $object->accountid . '<br>';
            echo $object->rol . '<br>';
            echo $object->schoolno . '<br>';
            echo $object->accountstate . '<br>';
            echo $object->user_name . '<br>';
        }       
?>
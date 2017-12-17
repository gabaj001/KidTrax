
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>KidTrax</title>

         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.css" />
        <!-- Our Custom CSS -->
        
        <link rel="stylesheet" href="<?php echo url_for('/stylesheets/style4.css'); ?>">
        <link rel="stylesheet" href="<?php echo url_for('/stylesheets/mapcss.css'); ?>">
        <!--<link rel="stylesheet" href="../../stylesheets/style4.css">-->

        <script src="https://code.angularjs.org/1.3.0-rc.2/angular.js"></script>
        <script src="https://code.angularjs.org/1.3.0-rc.2/angular-messages.js"></script>

        <link rel="stylesheet" href="<?php echo url_for('/stylesheets/style.css'); ?>">
        <script src="<?php echo url_for('/js/script.js'); ?>"></script>

        <script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
		
		<script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
		 <script
                  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwVbE80IgTIqeY4oc3KVa7aHnlwDyOTAo&callback=initMap">
        </script>

    </head>
    <body>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
              
                <div class="sidebar-header">
                    <h3>KidTrax</h3>
                    <strong>KT</strong>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="<?php echo url_for('/index.php'); ?>">
                            <i class="glyphicon glyphicon-home"></i>
                            Home
                        </a>
                    </li>
                   
                    <li <?php echo (($crusr->role == 'superadmin') ? '' : 'hidden'); ?>>
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-user"></i>
                            Manage Accounts 
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="<?php echo url_for('/staff/teachers/index.php'); ?>">Teachers</a></li>
                            <li><a href="<?php echo url_for('/staff/parents/index.php'); ?>">Parents</a></li>
                            <!--<li><a href="<?php echo url_for('/staff/staffusers/index.php'); ?>">Staff Users</a></li>-->
                            <li <?php echo (($crusr->role == 'superadmin') ? '' : 'hidden'); ?>>
                            <a href="<?php echo url_for('/staff/schooladmins/index.php'); ?>">
                            School Admin</a></li>
                        </ul>
                    </li>
                    <li <?php if ($crusr->role=='superadmin') echo "hidden"; ?>>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-road"></i>
                            Tracking student
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">

                            <li><a href="<?php 
                                    if($crusr->role=='schooladmin')
                                    {
                                        echo url_for('/staff/schooladmins/admstdatt.php');
                                    }
                                    else if ($crusr->role == 'parent')
                                    {
                                        echo url_for('/staff/parents/kidattd.php');
                                    }
                                     else 
                                     {
                                        echo url_for('/staff/teachers/studentattd.php'); 
                                     }
                                    ?>">
                            In Class</a></li>
                            <li <?php echo (($crusr->role == 'superadmin' 
                                            || $crusr->role == 'schooladmin'
                                            || $crusr->role == 'parent') ? '' : 'hidden'); ?>>
                                <a href="<?php 

                                        if ($crusr->role == 'schooladmin')
                                        {
                                            echo url_for('/bustrack/schadmbus.php?schoolno=' . $crusr->schoolno);

                                        } else {

                                            echo url_for('/bustrack/parenttrack.php?id=' . $crusr->userid); 

                                        }                                        
                                ?>">
                            In Bus</a>
                            </li>
                            <li <?php echo (($crusr->role == 'superadmin' || $crusr->role == 'schooladmin' 
                                            || $crusr->role == 'parent') ? '' : 'hidden'); ?>>
                            <a href="<?php
                                         if ($crusr->role == 'parent')
                                         {
                                              echo url_for('/staff/parents/kidsmvnt.php?id=' . $crusr->userid); 
                                         }
                                
                                ?>" 
                            
                            >Other Activities</a></li>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo url_for('/login/myprofile.php'); ?>">
                            <i class="glyphicon glyphicon-file"></i>
                            My Profile
                        </a>
                    </li>
                </ul>

                <ul class="list-unstyled CTAs">
                    <li><a href="<?php echo url_for('/login/logout.php'); ?>" class="logout">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Logout</a></li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content" class="container">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <!--<span>Toggle Sidebar</span>-->
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                                <li><a class="btn btn-default" href="<?php echo url_for('/login/logout.php'); ?>"><?php echo $crusr->user_name . " <span class='btn-info' style='color:white;'> &nbsp;Logout&nbsp; </span>"?></a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid"> <!-- Header Content -->

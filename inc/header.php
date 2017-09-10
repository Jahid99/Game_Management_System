<?php 
include 'lib/Session.php';
Session::checkSession();
?>
<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>
<?php 
        $db = new Database();
        $fm = new Format();     
 ?>
 <?php
	    if(isset($_GET['action']) && isset($_GET['action'])=="logout"){
	        Session::destroy();
	    }
      if($_SESSION['username']=='adminsays'){
        echo "<script>window.location='admin/'</script>";
        exit;
      }
?>
                
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>Player Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo SITE_URL;?>assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo SITE_URL;?>assets/css/main.css" rel="stylesheet">

    <!-- Fonts from Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>

  <!-- Website Font style -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

 
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div id="wrapper">
    <!-- Fixed navbar -->
    <div id="header">
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo SITE_URL;?>"><b>Player Management System</b></a>
        </div>
        <?php 
                $path = $_SERVER['SCRIPT_FILENAME'];
                $currentpage = basename($path,'.php');
         ?>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li  <?php if($currentpage=='index'){echo 'class="active"';} ?>><a href="<?php echo SITE_URL;?>index.php">Home</a></li>
            <li  <?php if($currentpage=='forum' || $currentpage=='post' || $currentpage=='posts'){echo 'class="active"';} ?>><a href="<?php echo SITE_URL;?>forum.php">Forum</a></li>
            <li class="dropdown <?php if($currentpage=='myprofile' || $currentpage=='changepassword' || $currentpage=='editprofile'){echo 'active';} ?>" ><a class="dropdown-toggle" data-toggle="dropdown" href="#">Hello : <?php echo Session::get('characterName'); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="myprofile.php">My Profile</a></li>
            <li><a href="changepassword.php">Change Password</a></li>
            <li><a href="<?php echo SITE_URL;?>?action=logout">Logout</a></li>
          </ul>
         </li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>
  <div id="content">
      <div class="container">
        <div class="row main"><br><br><br>

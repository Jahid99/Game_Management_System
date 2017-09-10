<?php 
include 'lib/Session.php';

?>
<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>
<?php 
        $db = new Database();
        $fm = new Format();  
        Session::init();   
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
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/main.css" rel="stylesheet">

    <!-- Fonts from Google Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,900' rel='stylesheet' type='text/css'>

  <!-- Website Font style -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

  <style type="text/css">
    /*
/* Created by Filipe Pina
 * Specific styles of signin, register, component
 */
/*
 * General styles
 */

body, html{
     height: 100%;
  background-repeat: no-repeat;
  background-color: #d3d3d3;
  font-family: 'Oxygen', sans-serif;
}

.main{
  margin-top: 70px;
}

h1.title { 
  font-size: 50px;
  font-family: 'Passion One', cursive; 
  font-weight: 400; 
}

hr{
  width: 10%;
  color: #fff;
}

.form-group{
  margin-bottom: 15px;
}

label{
  margin-bottom: 15px;
}

input,
input::-webkit-input-placeholder {
    font-size: 11px;
    padding-top: 3px;
}

.main-login{
  background-color: #fff;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);

}

.main-center{
  margin-top: 30px;
  margin: 0 auto;
  max-width: 330px;
    padding: 40px 40px;

}

.login-button{
  margin-top: 5px;
}

.login-register{
  font-size: 11px;
  text-align: center;
}

  </style>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><b>Player Management System</b></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="login.php">Login</a></li>
            <li class="active"><a href="register.php">Register</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <div class="row main">
        <div class="panel-heading">
                 <div class="panel-title text-center">
                    <h1 class="title">Complete Your registration</h1>
                    <hr />
                      <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {  
            $username =  $fm->validation($_POST['username']);    
            $character_name =  $fm->validation($_POST['character_name']);    
            $email =  $fm->validation($_POST['email']);  
            $password =  $fm->validation($_POST['password']);  
            $password = password_hash($password, PASSWORD_BCRYPT);
            $username =  mysqli_real_escape_string($db->link,$username);
            $character_name =  mysqli_real_escape_string($db->link,$character_name);
            $email =  mysqli_real_escape_string($db->link,$email);
            $password =  mysqli_real_escape_string($db->link,$password);
         
           if(empty($username) || empty($character_name) ||empty($email) ||empty($password)){
            echo "<span class='label label-danger'>Field must not be empty  !!!</span><br><br>";
           }else{
           $mailquery = "SELECT * FROM tbl_users where username = '$username' limit 1";
           $mailcheck = $db->select($mailquery);
           if ($mailcheck != false) {
            echo "<span class='label label-danger'>Username Already exists  !!!</span><br><br>";
           }else{

                $usernamequery = "SELECT * FROM tbl_users where character_name = '$character_name' limit 1";
           $usernamecheck = $db->select($usernamequery);
           if ($usernamecheck != false) {
             echo "<span class='label label-danger'>Character Name Already exists  !!!</span><br><br>";
           }else{

                $mailquery = "SELECT * FROM tbl_users where email = '$email' limit 1";
           $mailcheck = $db->select($mailquery);
           if ($mailcheck != false) {
            echo "<span class='label label-danger'>Email Already exists  !!!</span><br><br>";
           }else{

               $query = "INSERT INTO  tbl_users(username,character_name,email,password) VALUES ('$username','$character_name','$email','$password')";
                $userinsert = $db->insert($query);
                if($userinsert){
                  Session::set("message","Registration successful !!!");
            Session::set("color","success");
            echo "<script>window.location='login.php'</script>";  
            exit();
                }   else {
                  Session::set("message","Registration successful !!!");
            Session::set("color","success");
            echo "<script>window.location='login.php'</script>";  
            exit();
                    }
                }                
                }                
              }      
            }
          }
  
            ?>
                  </div>
              </div> 
        <div class="main-login main-center">
          <form class="form-horizontal" method="post" action="">   

            <div class="form-group">
              <label for="username" class="cols-sm-2 control-label">Username</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username" required />
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="name" class="cols-sm-2 control-label">Character Name</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="character_name" id="name"  placeholder="Enter your Character Name" required/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="cols-sm-2 control-label">Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="email" class="form-control" name="email" id="email"  placeholder="Enter your Email" required/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label">Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" required/>
                </div>
              </div>
            </div>

            <div class="form-group ">
              <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Register</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container">
      <hr>
    <p class="centered">Copyright &copy; 2017 All rights reserved</p>
    </div>
 
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>

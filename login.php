<?php 
include 'lib/Session.php';
Session::checkLogin();
?>
<?php include 'config/config.php';?>
<?php include 'lib/Database.php';?>
<?php include 'helpers/Format.php';?>
<?php 
        $db = new Database();
        $fm = new Format();     
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

html,
body {
    margin:0;
    padding:0;
    height:100%;
}
#wrapper {
    min-height:100%;
    position:relative;
}

#content {
    padding-bottom:100px; /* Height of the footer element */
}
#footer {
   
    width:100%;
    
    position:absolute;
    bottom:0;
    left:0;
}
  </style>

  </head>

  <body>

  <div id="wrapper">
    <!-- Fixed navbar -->
    <div id="header">

    <!-- Fixed navbar -->
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
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </div>
    <div id="content">
    <div class="container">
      <div class="row main">
        <div class="panel-heading">
                 <div class="panel-title text-center">
                    <h1 class="title">Login</h1>
                    <hr />
        <?php 
            if ($_SERVER['REQUEST_METHOD']=='POST') {
            $username =  $fm->validation($_POST['username']);
            $password =  $fm->validation($_POST['password']);
            $username =  mysqli_real_escape_string($db->link,$username);
            $password =  mysqli_real_escape_string($db->link,$password);
            $query = "SELECT * FROM tbl_users WHERE username = '$username'";
            $result = $db->select($query);
            if($result!= false){
            $value = $result->fetch_assoc();
            $dbpassword = $value['password'];
            if(password_verify($password, $dbpassword)){
            Session::set("login",true);
            Session::set("username",$value['username']);
            Session::set("userId",$value['id']);
            Session::set("characterName",$value['character_name']);
            Session::set("division",$value['division']);
            Session::set("rank",$value['rank']);
            echo "<script>window.location='index.php'</script>";
            }else{
              echo "<span class='label label-danger'>Username and Password do not matched !!!</span><br><br>";
            }
            }else{
              echo "<span class='label label-danger'>Username and Password do not matched !!!</span><br><br>";
            }
         }
  
            ?>
            <?php 

                      if(Session::get("message")){ ?>
                        <center><span class="label label-<?php 
                        if(Session::get("color")){
                        echo Session::get("color");
                        Session::unset_it("color");
                      }else{
                          echo "danger";
                      }
                         ?>"><?php echo Session::get("message"); ?></span></center><br>
                       <?php Session::unset_it("message");
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
              <label for="password" class="cols-sm-2 control-label">Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password" required/>
                </div>
              </div>
            </div>

              <div class="form-group ">
                <button type="submit" class="btn btn-primary btn-lg btn-block login-button">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div id="footer">
      <div class="container">
        <hr>
      <p class="centered">Copyright &copy; 2017 All rights reserved</p>
      </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>

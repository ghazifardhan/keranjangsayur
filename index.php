<?php

session_start();
error_reporting(0);
include 'models/Include.php';

?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Keranjang Sayur</title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        
        <!-- custom CSS -->
        <link href="libs/css/keranjangsayur.css" rel="stylesheet" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link href="libs/js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" media="screen" />
        <link href="libs/js/bootstrap/dist/css/bootstrap-chosen.css" rel="stylesheet" />
      
    </head>

<body>
<div class="container">
    <br/>
    <br/>
<?php
    $message = (isset($_GET['msg'])) ? $_GET['msg'] : "";
    if($message == 'login_failed'){
?>
<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title">Error</h3>
  </div>
  <div class="panel-body">
    Username or Password False!!
  </div>
</div><?php } else { ?>
<?php } ?>
<center><img src="images/ks_2.PNG" /></center>
<form action="auth.php" method="POST" border='0'>
    <center><table class='table table-hover table-responsive table-bordered table-nonfluid'>
        <tr>
            <td>Username</td>
            <td><input name="user" type="text" class="form-control"/></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input name="pass" type="password" class="form-control"/></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="submit" class='btn btn-primary'>Login</button></td>
        </tr>
    </table></center>
</form>
</div>
<!-- jQuery library -->
<script src="libs/js/jquery.js"></script>
<script src="libs/js/chosen/chosen.jquery.js"></script>
<script src="libs/js/chosen/chosen.jquery.min.js"></script>
 
<!-- bootstrap JavaScript -->
<script src="libs/js/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="libs/js/script.js"></script>    
</body>
</html>	
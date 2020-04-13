<?php
	session_start();
	if(!isset($_SESSION['fullname'])){
		header('Location: login.php');
		exit();
	}
	if(isset($_POST['change'])){
		require 'server.php';
		$errors=array();
		if(!empty($_POST['password'])){
			if(!empty($_POST['repassword'])){
				if(trim($_POST['password'])==trim($_POST['repassword'])){
					$pwd=mysqli_real_escape_string($conn,trim($_POST['password']));
					$pwd=sha1($pwd);
				}
				else{$errors[]="Passwsord and Repeat Password Field Should be same!";}
			}
			else{$errors[]="Repeat Passsowrd Field can not be empty!";}
		}
		else{$errors[]="Passsowrd Field can not be empty!";}
		if(empty($errors)){
			$email=$_SESSION['email'];
			$q="UPDATE users SET password='$pwd' WHERE email='$email'";
			@mysqli_query($conn,$q);
			if(mysqli_affected_rows($conn)==1){
				echo '<script>alert("Your Password Updated Successfully!")</script>';
				@mysqli_close($conn);
				header('Location: login.php');
				exit();
			}
			else{
				echo '<p class="error">System error occured. Sorry for incovenience.</p>';
			}
			mysqli_close($conn);
		}
		else{
			echo '<div class="container"><div class="card bg-light"><p class="error">';
			foreach($errors as $msg){
				echo "*$msg<br>\n";
			}
			echo '</p></div></div>';
		}
	}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="mainstyle.css">
</head>
<body>
<div class="container">
<hr>
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Update Password</h4>
	<hr>
	<form action="changepassword.php" method="POST">
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" class="form-control" placeholder="New Password" type="password">
	    </div> <!-- form-group// -->  
	<div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="repassword" class="form-control" placeholder="Repeat New Password" type="password">
	</div> <!-- form-group// -->                                    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" name="change"> Update Password </button>
    </div> <!-- form-group// -->                                                                       
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->
<br><br>
</body>
</html>
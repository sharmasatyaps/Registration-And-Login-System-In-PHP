<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require 'server.php';
		$errors=array();
		$name=trim($_POST['username']);
		$stripped=mysqli_real_escape_string($conn,strip_tags($name));
		$strlen=mb_strlen($stripped);
		if($strlen<1){$errors[]="Name Field can not be empty!";}
		else{$name=$stripped;}
		if(!empty($_POST['mail'])){
			if(filter_var(trim($_POST['mail']),FILTER_VALIDATE_EMAIL)){
				$email=mysqli_real_escape_string($conn,(trim($_POST['mail'])));
			}
			else{
				$errors[]="Email Field Has Incorrect Format";
			}
		}
		else{
			$errors[]="Email Field can not be empty!";
		}
		if(!empty($_POST['mob'])){
			$mob=mysqli_real_escape_string($conn,trim($_POST['mob']));
		}
		else{
			$errors[]="Phone Number Field can not be empty!";
		}
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
			$q="SELECT * FROM users WHERE email='$email'";
			$result=@mysqli_query($conn,$q);
			if(mysqli_num_rows($result)<1){
				$q="INSERT INTO users(fullname,email,contact,password) values('$name','$email','$mob','$pwd')";
				@mysqli_query($conn,$q);
				if(mysqli_affected_rows($conn)==1){
					echo "<div class='container'><div class='card bg-light'><div class='success'>You have been successfully registered!!</div></div></div>";
				}
				else{
					echo '<p class="error">System error occured. Sorry for incovenience.</p>';
				}
			}
			else echo "<div class='container'><div class='card bg-light'><div class='error'>This Email is already registered!!</div></div></div>";
			@mysqli_close($conn);
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
	<h4 class="card-title mt-3 text-center">Registration Form</h4>
	<hr>
	<form action="register.php" method="POST">
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="username" class="form-control" placeholder="Full name" type="text" 
        value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="mail" class="form-control" placeholder="Email address" type="email"
        value="<?php if(isset($_POST['mail'])) echo $_POST['mail']; ?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
		<div class="input-group-prepend">
			<span class="input-group-text">+91</span>
		</div>
    	<input name="mob" class="form-control" placeholder="Phone number" type="text"
    	value="<?php if(isset($_POST['mob'])) echo $_POST['mob']; ?>">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" class="form-control" placeholder="Create password" type="password">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="repassword" class="form-control" placeholder="Repeat password" type="password">
    </div> <!-- form-group// -->                                      
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Register </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Already Registered? <a href="login.php">Log In</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->
<br><br>
</body>
</html>
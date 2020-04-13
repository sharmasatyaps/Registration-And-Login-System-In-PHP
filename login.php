<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		require 'server.php';
		$email=trim($_POST['mail']);
		$email=mysqli_real_escape_string($conn,strip_tags($email));
		$pwd=mysqli_real_escape_string($conn,strip_tags(trim($_POST['password'])));
		$q="SELECT fullname,password FROM users WHERE email='$email' AND password=sha1('$pwd')";
		$result=mysqli_query($conn,$q);
		if(@mysqli_num_rows($result)==1){
			$q="SELECT fullname,email,contact FROM users WHERE email='$email' AND password=sha1('$pwd')";
			$result=@mysqli_query($conn,$q);
			$row=@mysqli_fetch_assoc($result);
			session_start();
			$_SESSION=$row;
			$url='members.php';
			header('Location: '.$url);
			exit();
			mysqli_close($conn);
		}
		else{
			echo "<div class='cotainer'><div class='card bg-light'><p class='error'>Either Email or Password Incorrect!</p></div></div>";
			mysqli_close($conn);
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
	<h4 class="card-title mt-3 text-center">Login</h4>
	<hr>
	<form action="login.php" method="POST">
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="mail" class="form-control" placeholder="Email address" type="email"
        value="<?php if(isset($_POST['mail'])) echo $_POST['mail']; ?>" required>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" class="form-control" placeholder="Password" type="password" required>
    </div> <!-- form-group// -->                                    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Log In </button>
    </div> <!-- form-group// -->      
    <p class="text-center">New Member? <a href="index.php">Register</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->
<br><br>
</body>
</html>
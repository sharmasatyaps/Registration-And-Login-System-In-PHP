<?php
	session_start();
	if(!isset($_SESSION['fullname'])){
		header('Location: login.php');
		exit();
	}
	if(isset($_POST['logout'])){
		session_destroy();
		header('LOCATION: login.php');
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
		<?php echo '<h3>Hey '.strtoupper($_SESSION['fullname']).'</h3>'; 
			echo 'Here are your details:<br>';
			echo '<h4>Contact: </h4>'.$_SESSION['contact']; echo '<br>';
			echo '<h4>Email: </h4>'.$_SESSION['email'];
		?>

	<hr>
</article>
</div> <!-- card.// -->
<form action="members.php" method="POST">
	<button class="btn btn-primary" name="logout" type="submit">Logout</button>
</form>
<form action="changepassword.php" method="POST">
	<button class="btn btn-primary" name="changepwd" type="submit">Change Password</button>
</form>s
</div> 
<!--container end.//-->
<br><br>
</body>
</html>
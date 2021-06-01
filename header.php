<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<title>Paste-It WebApp</title>
	<meta charset="UTF8MB4_GENERAL_CI">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/myScript.js"></script>
</head>
<body>
		<div class="UpperLayout">
				<div class="login">
				<ul>
				   <li><img src="img/logo.png" alt="logo" style="width: 15%;height: 15%;"></li>
				   <li> <a href="index.php"> Home </a></li>
				   <li> <a href="about.php"> About us </a></li>
				   <?php
						if(!isset($_SESSION['useruid'])){
							echo "<li> <a href='signup.php'> Sign up </a></li>";
							echo "<li> <a href='login.php'> Log in </a></li>";	
						}
						else {
							echo "<li> <a href='profile.php'> Profile page </a></li>";
							echo "<li> <a href='includes/logout.inc.php'> Log out </a></li>";
						}
				   ?>
				</ul>
				</div>
        </div>
		 
        
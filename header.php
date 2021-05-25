<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Paste-It WebApp</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
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
						if(isset($_SESSION['useruid'])){
							echo "<li> <a href='profile.php'> Profile page </a></li>";
							echo "<li> <a href='includes/logout.inc.php'> Log out </a></li>";
						}
						else {
							echo "<li> <a href='signup.php'> Sign up </a></li>";
							echo "<li> <a href='login.php'> Log in </a></li>";
						}
				   ?>

				   
				   </ul>
				</div>
        </div>
		 
        
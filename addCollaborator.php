<?php
require_once 'includes/dbh.inc.php';

$codeId = $_POST['codeId'];
$collaboratorUsername = $_POST['collabUsername'];

$sql = "INSERT INTO `collaborators` (codeId,collaboratorUserId) VALUES ('$codeId', '$collaboratorUsername')";

if(mysqli_query($conn, $sql)){
	header("location: ../index.php?error=none");
	mysqli_close($conn);
	exit();  
} else{
	header("location: ../index.php?error=Error while saving code into database, please check.");
	mysqli_close($conn);
	exit(); 
} 
?>
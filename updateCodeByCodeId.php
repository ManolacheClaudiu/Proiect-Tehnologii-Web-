<?php
require_once 'includes/dbh.inc.php';

$codId = $_POST["hidden-code-id-name"];
$codeInput = $_POST["hidden-input-code"];
$codeFilename = $_POST["codName"];
$codeValability = $_POST["codValability"];
$codeVisibility = $_POST["codVisibility"];
$codePassword = $_POST["codPwd"];

validateField($codeInput,"Code input box is empty.");
validateField($codeFilename,"Filename must be provided.");

if(empty($codePassword) && $codeVisibility == "private"){
	header("location: ../index.php?error=Code must be locked with a password.");
	exit(); 
}

$hashedPwd = password_hash($codPwd, PASSWORD_DEFAULT);

$updateQuery = "UPDATE `cod` SET ". "`codName` = " . $codeFilename . ", `codeText` = " 
. $codeInput . ", `codValability` = ". $codeValability . ", codVisibility = " . $codeVisibility  . ", codPwd = " . $codePassword . " WHERE `codId` = " . $codId . ")";

echo $updateQuery;

// if(mysqli_query($conn, $updateQuery)){
//         mysqli_close($conn);
//         exit();  
//     } else{
//         header("location: ../index.php?error=Error while updating code into database, please check.");
//         mysqli_close($conn);
//         exit(); 
//  } 
?>
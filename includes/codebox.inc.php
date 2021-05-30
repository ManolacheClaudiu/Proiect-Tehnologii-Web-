<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST["submit"])){
    $codeInput = $_POST["hidden-input-code"];
    $codeUsername = $_POST["codUsersName"];
    $codeFilename = $_POST["codName"];
    $codeValability = $_POST["codValability"];
    $codeVisibility = $_POST["codVisibility"];
    $codePassword = $_POST["codPwd"];

    validateField($codeInput,"Code input box is empty.");
    validateField($codeUsername,"Username must be provided.");
    validateField($codeFilename,"Filename must be provided.");

    if(empty($codePassword) && $codeVisibility == "private"){
        header("location: ../index.php?error=Code must be locked with a password.");
        exit(); 
    }

    saveCode($conn,$codeInput ,$codeUsername, $codeFilename, $codeValability,$codeVisibility, $codePassword );
}
else{
    header("location: ../index.php");
    exit();
}

function validateField($fieldValue, $errorMessageInCaseOfEmpty){
    if(empty($fieldValue)){
        header("location: ../index.php?error=" . $errorMessageInCaseOfEmpty);
        exit();  
    }
}

function saveCode($conn,$codText, $codUsersName, $codName, $codValability,$codVisibility ,$codPwd ){

    $codUsersName = "anonim"; 
    if(isset($_SESSION['useruid'])){
        $codUsersName = $_SESSION["useruid"];
    }

    $hashedPwd = password_hash($codPwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO cod (codUsersName,codName, codValability,codVisibility,codPwd, codeText) VALUES ('$codUsersName', '$codName', $codValability,'$codVisibility' ,'$hashedPwd', '$codText')";

    if(mysqli_query($conn, $sql)){
        header("location: ../index.php?error=none");
        mysqli_close($conn);
        exit();  
    } else{
        header("location: ../index.php?error=Error while saving code into database, please check.");
        mysqli_close($conn);
        exit(); 
 } 
}
?>


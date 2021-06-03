<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if(isset($_POST["submit"])){
    $action = $_POST["action"];

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
    if($action == "save"){
        $codeUsername = "anonim";
        if(isset($_SESSION['useruid'])){
            $codeUsername = $_SESSION["useruid"];
        }

        saveCode($conn,$codeInput ,$codeUsername, $codeFilename, $codeValability,$codeVisibility, $codePassword );
    }else{
        //hidden-input-code-id
        $codeId = $_POST["hidden-code-id-name"];
        updateCode($conn,$codeInput, $codeFilename, $codeValability,$codeVisibility, $codePassword, $codeId);
    }
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

function updateCode($conn, $codText, $codName, $codValability,$codVisibility ,$codPwd, $codeId){
    //TODO check if password is already hashed
    $hashedPwd = password_hash($codPwd, PASSWORD_DEFAULT);

    $updateQuery = 'UPDATE `cod` SET '. '`codName` = "' . $codName . '", `codeText` = "' 
    . $codText . '", `codValability` = "' . $codValability . '", codVisibility = "' . $codVisibility  . '", codPwd = "' . $hashedPwd . '" WHERE `codId` = "' . $codeId . '";';

    if(mysqli_query($conn, $updateQuery)){
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


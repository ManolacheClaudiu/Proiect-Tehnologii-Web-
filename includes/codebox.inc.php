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
    $code = $_POST['captcha'];

    validateField($codeInput,"Code input box is empty.");
    validateField($codeFilename,"Filename must be provided.");
    
    if(!isset($_SESSION['useruid'])){
        validateField($code,"Captcha must be provided.");
        if($code !== $_SESSION['captcha_code'])
        {
            header("location: ../index.php?error=Captcha incorrect.");
            exit();
        }
    }
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

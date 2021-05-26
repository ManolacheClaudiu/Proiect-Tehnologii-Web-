<?php
if(isset($_POST["submit"])){
    $codText = $_POST["codText"];
    $codUsersName = $_POST["codUsersName"];
    $codName = $_POST["codName"];
    $codValability = $_POST["codValability"];
    $codVisibility = $_POST["codVisibility"];
    $codPwd = $_POST["codPwd"];
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    if(emptyInputCod($codText,$codUsersName, $codName, $codValability, $codVisibility,$codPwd  ) !== false ){
        header("location: ../index.php?error=emptyinput");
        exit();  
    }
    createCod($conn,$codText ,$codUsersName, $codName, $codValability,$codVisibility, $codPwd );
}
else{
    echo "it NOT works";
    header("location: ../index.php");
    exit();
}
?>


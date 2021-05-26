<?php
session_start();
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result;
    if(empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)){
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function invalidUid( $username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
       //a mistake
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function invalidEmail( $email){
    $result;
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
       //a mistake
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function pwdMatch( $pwd, $pwdRepeat){
    $result;
    if($pwd !== $pwdRepeat){
       //a mistake
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function uidExists( $conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    if( !mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();  
    }
    //second paramter contains an s for each string
    mysqli_stmt_bind_param($stmt, "ss", $username, $email );
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if( $row = (mysqli_fetch_assoc($resultData))){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function createUser($conn, $name, $email, $username, $pwd ){
    $sql = "INSERT INTO users (usersName,usersEmail, usersUid, usersPwd) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if( !mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();  
    }
    //we make hash for passwords
    $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
    //second paramter contains an s for each string
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
    exit();  
}
function emptyInputLogin( $username, $pwd){
    $result;
    if( empty($username) || empty($pwd) ){
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function loginUser($conn,$username,$pwd){
    session_start();
    $uidExists = uidExists( $conn, $username, $username);
    if($uidExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    //for extracting data from database
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd,$pwdHashed);
    if($checkPwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if($checkPwd === true){ 
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUid"];
        header("location: ../index.php");
        exit();
    }
}
function emptyInputCod($codText ,$codUsersName, $codName, $codValability,$codVisibility,$codPwd ){
    $result;
    if( empty($codUsersName) || empty($codName) || empty($codValability)||empty($codVisibility) || empty($codPwd) || empty($codText)){
        $result = true;
    }
    else
    {
        $result = false;
    }
    return $result;
}
function createCod($conn,$codText, $codUsersName, $codName, $codValability,$codVisibility ,$codPwd ){

    if(!isset($_SESSION['useruid'])){
        $codUsersName = "anonim"; 
    }
    else {
        $codUsersName = $_SESSION["useruid"];
    }

    $sql = "INSERT INTO cod (codText,codUsersName,codName, codValability,codVisibility,codPwd) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    //echo "conexiunea ".$conn;
    if( !mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();  
    }
    //we make hash for passwords
    $hashedPwd = password_hash($codPwd,PASSWORD_DEFAULT);
    //second paramter contains an s for each string

   
    mysqli_stmt_bind_param($stmt, "ssssss",$codText, $codUsersName, $codName, $codValability,$codVisibility ,$hashedPwd );
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_close($stmt);
   header("location: ../index.php?error=none");
    exit();  
}

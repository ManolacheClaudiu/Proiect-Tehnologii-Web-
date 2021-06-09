
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

function getElementById(){
    return 1;
}

//din codebox.inc

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

    // $updateQuery = 'UPDATE `cod` SET '. '`codName` = "' . $codName . '", `codeText` = "' 
    // . $codText . '", `codValability` = "' . $codValability . '", codVisibility = "' . $codVisibility  . '", codPwd = "' . $hashedPwd . '" WHERE `codId` = "' . $codeId . '";';
    $updateQuery = "INSERT INTO cod (codUsersName,codName, codValability,codVisibility,codPwd, codeText) VALUES ('$codUsersName', '$codName', $codValability,'$codVisibility' ,'$hashedPwd', '$codText')";

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

function addColab($conn,$codeId,$collabId){
    $sql = "INSERT INTO collaborators (codeId,collaboratorUserId) VALUES (?,?)";
    $stmt = mysqli_stmt_init($conn);
    if( !mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../collaboratorController.php?error=stmtfailed");
        exit();  
    }
    //we make hash for passwords
    // $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
    //second paramter contains an s for each string
    mysqli_stmt_bind_param($stmt, "ss", $codeId, $collabId );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("location: ../collaboratorController.php?error=none");
    exit();  
}
function colabExists( $conn, $codeId, $collabId){
    $sql = "SELECT * FROM collaborators WHERE codeId = ? AND collaboratorUserId = ?;";
    $stmt = mysqli_stmt_init($conn);
    if( !mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../collaboratorController.php?error=stmtfailed");
        exit();  
    }
    //second paramter contains an s for each string
    mysqli_stmt_bind_param($stmt, "ss", $codeId, $collabId );
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
function nameExists( $conn, $codeFilename){
    $sql = "SELECT codName FROM cod WHERE codName = ?;";
    $stmt = mysqli_stmt_init($conn);
    if( !mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../collaboratorController.php?error=stmtfailed");
        exit();  
    }
    //second paramter contains an s for each string
    mysqli_stmt_bind_param($stmt, "s", $codeFilename);
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

?>



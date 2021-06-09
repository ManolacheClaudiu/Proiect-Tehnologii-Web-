<?php
if(isset($_POST["submit"])){


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $codeId = $_POST["collab-hidden-code-id"];
    $collabId = $_POST["collaborators-select-id"];
   
    // $xhttp = new XMLHttpRequest();
    // xhttp.onreadystatechange = function() {
    //     if (this.readyState == 4 && this.status == 200) {
    //         location.reload(); 
    //     }
    // }
    // xhttp.open("POST", "addCollaborator.php", true);
    // xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    // xhttp.send("codeId="+ codeId + "&collabUsername=" + collabUsername);
    if(colabExists( $conn, $codeId, $collabId) !== false ){
        header("location: ../collaboratorController.php?error=colabExists");
        exit();  
    }
    addColab($conn,$codeId,$collabId);
}
else{
    header("location: ../index.php");
    exit();
}

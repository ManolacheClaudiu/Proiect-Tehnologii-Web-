<<<<<<< HEAD
<?php
if(isset($_POST["submit"])){

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    if(emptyInputLogin( $username, $pwd) !== false ){
        header("location: ../login.php?error=emptyinput");
        exit();  
    }
    loginUser($conn,$username,$pwd);
}
else{
    header("location: ../login.php");
    exit();
}
=======
<?php
if(isset($_POST["submit"])){

    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';
    if(emptyInputLogin( $username, $pwd) !== false ){
        header("location: ../login.php?error=emptyinput");
        exit();  
    }
    loginUser($conn,$username,$pwd);
}
else{
    header("location: ../login.php");
    exit();
}
>>>>>>> 1bad601f0d23ecb485ba71b633f2d006ca0b984e

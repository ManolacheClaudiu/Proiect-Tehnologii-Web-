<<<<<<< HEAD
<?php
require_once 'includes/dbh.inc.php';

$requestedCodId = $_GET['currentUserId'];

$query = "SELECT `usersId`, `usersName` FROM `users` WHERE `usersId` !=" . $requestedCodId . ";";

$result = mysqli_query($conn, $query);

$row = $result->fetch_assoc();

echo json_encode($row);
mysqli_close($conn);
=======
<?php
require_once 'includes/dbh.inc.php';

$requestedCodId = $_GET['currentUserId'];

$query = "SELECT `usersId`, `usersName` FROM `users` WHERE `usersId` !=" . $requestedCodId . ";";

$result = mysqli_query($conn, $query);

$row = $result->fetch_assoc();

echo json_encode($row);
mysqli_close($conn);
>>>>>>> 1bad601f0d23ecb485ba71b633f2d006ca0b984e
?>
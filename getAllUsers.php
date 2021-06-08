<?php
require_once 'includes/dbh.inc.php';

$requestedCodId = $_GET['currentUserId'];

$query = "SELECT `usersId`, `usersName` FROM `users` WHERE `usersId` !=" . $requestedCodId . ";";

$result = mysqli_query($conn, $query);

$row = $result->fetch_assoc();

echo json_encode($row);
mysqli_close($conn);
?>
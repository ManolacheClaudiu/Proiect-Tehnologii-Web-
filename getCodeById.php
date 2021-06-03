<?php
require_once 'includes/dbh.inc.php';

$requestedCodId = $_GET['codid'];

$query = "SELECT `codeText` FROM `cod` WHERE `codId` = " . $requestedCodId . ";";

$result = mysqli_query($conn, $query);

echo $row = mysqli_fetch_array($result)[0];
mysqli_close($conn);

?>
<?php
require_once 'includes/dbh.inc.php';

$requestedCodId = $_GET['codid'];

$query = "SELECT `codName`, `codeText`, `codValability`, `codVisibility`, `codPwd` FROM `cod` WHERE `codId` = " . $requestedCodId . ";";

$result = mysqli_query($conn, $query);

$row = $result->fetch_assoc();

echo json_encode($row);
mysqli_close($conn);
?>
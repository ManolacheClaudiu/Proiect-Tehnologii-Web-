<?php
require_once 'includes/dbh.inc.php';

$requestedCodName = $_GET['codName'];

$query = "SELECT `codId` FROM `cod` WHERE `codName` = " . $requestedCodName . ";";

$result = mysqli_query($conn, $query);
$rowcount=mysqli_num_rows($result);

$resultList = [];
if($rowcount>0)
{
	while($row = $result->fetch_assoc()) {
		array_push($resultList,$row); 
	}
}

echo json_encode($resultList);
mysqli_close($conn);
?>
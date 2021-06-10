<?php
require_once 'includes/dbh.inc.php';

$requestedCodId = $_GET['codeId'];
$query ="SELECT `codPwd` FROM `cod` where `codId` = " . $requestedCodId . ");";

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
<<<<<<< HEAD
<?php
require_once 'includes/dbh.inc.php';

$requestedCodId = $_GET['codeId'];

$query = "SELECT `collaboratorUserId` FROM `collaborators` WHERE `codeId` = " . $requestedCodId . ";";

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
=======
<?php
require_once 'includes/dbh.inc.php';

$requestedCodId = $_GET['codeId'];

$query = "SELECT `collaboratorUserId` FROM `collaborators` WHERE `codeId` = " . $requestedCodId . ";";

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
>>>>>>> 1bad601f0d23ecb485ba71b633f2d006ca0b984e
?>
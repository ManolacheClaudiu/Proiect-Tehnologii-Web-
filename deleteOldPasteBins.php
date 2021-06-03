<?php
require_once 'includes/dbh.inc.php';

$query = "SELECT `creation_date`, `codValability`, `codId` FROM `cod` ;";

$result = mysqli_query($conn, $query);

$rowcount=mysqli_num_rows($result);

if($rowcount > 0)
{  
	while($row = $result->fetch_assoc()) {
		$creationTime = new DateTime($row["creation_date"]);
		$currentTime = new DateTime(date("Y-m-d"));
		$difference = $currentTime->diff($creationTime) -> format('%d');

		if($difference > $row["codValability"]){
			$requestedCodId = $row["codId"];
			$query = "DELETE FROM `cod` WHERE `codId` = " . $requestedCodId . ";";
			mysqli_query($conn, $query);
		} 
	}
}

?>
<?php
  include_once 'header.php';
?>
	<div class="RightSettingsL">
		<?php
				if(isset($_SESSION['useruid'])){
					echo "<p>Hello there ". $_SESSION["useruid"]. "</p>";
				}
		?>
<div class="NavigationMenu">


<label id="repositories-label-id" for="repositories">My Repositories:</label>
	<hr id="my-hr" />

	<ul class="repositories-class">
		<?php
		require_once 'includes/dbh.inc.php';
		

		if(isset($_SESSION['useruid'])){
			$loggedUser =  $_SESSION['useruid'];
			$loggedUserQuery = "SELECT * FROM `cod` WHERE `codUsersName` = '". $loggedUser . "';";
			
			$result = mysqli_query($conn, $loggedUserQuery);
			
			$rowcount=mysqli_num_rows($result);
			
			if($rowcount > 0){  
				while($row = $result->fetch_assoc()) {
					$codeId = $row["codId"];
					$codName = $row["codName"];
					// echo"<p>$codeId</p>";
					echo '<li>
				
					<a class="btn-class-fetched" href="#" onclick="pwdProtect('.$codeId.')">'. $row["codName"] . '</a>
					</li>';
				}
			}
		}

			
		 ?>
	 </ul>


</div>

    </div>
<?php
  include_once 'footer.php';
?>

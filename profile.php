<?php
  include_once 'header.php';
?>
	<div class="RightSettingsL">
		<?php
				if(isset($_SESSION['useruid'])){
					echo "<p>Hello there ". $_SESSION["useruid"]. "</p>";
				}
		?>
    </div>
<?php
  include_once 'footer.php';
?>

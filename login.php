<?php
  include_once 'header.php';
?>
	<div class="RightSettingsL">
		<section class="login-form">
		<h2>Log In</h2>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email..." >
            <input type="password" name="pwd" placeholder="Password..." > 
            <br>
            <button type="submit" value="submit"  name="submit">Log In</button>
        </form> 
		</section>
    <?php
//what we get from $_POST is what we can not see, what we get from $_GET is what we can see
if(isset($_GET["error"])){
  if($_GET["error"] == "emptyinput"){
    echo "<p> Fill in all fields</p>";
  }
  else  if($_GET["error"] == "wronglogin"){
    echo "<p> Incorrect login information!</p>";
  }

}
?>    
    </div>
<?php
  include_once 'footer.php';
?>

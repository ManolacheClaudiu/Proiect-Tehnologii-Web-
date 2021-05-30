<?php
include_once 'header.php';
?>
<div class="MiddleLayout">
 <?php
 include_once 'navigationMenu.php';
 ?>
 <div class="CodeBox">
     <section class="cod-form">
         <form onsubmit="submitForm()" action="includes/codebox.inc.php" method="post">

           <!-- Container for input code -->
           <div id="code-input-id" class="code-input" contenteditable data-placeholder="Place your code here sir..."></div>
           <input type="hidden" id="hidden-input-code-id" name="hidden-input-code" value="" />

           <input type="text" name="codUsersName" size="11" placeholder=" Sign you.."> 

           <br><input type="text" name="codName" size="11" placeholder=" Name your file..."> 
           <label for="codValability"> Valability<br></label>
           <select id="codValability" name="codValability">
             <option value="1">1 day</option>
             <option value="2">2 days</option>
             <option value="3">3 days</option>
             <option value="4">4 days</option>
             <option value="5">5 days</option>
             <option value="6">6 days</option>
             <option value="7">7 days</option>
             <option value="8">8 days</option>
             <option value="9">9 days</option>
             <option value="10">10 days</option>
             <option value="15">15 days</option>
             <option value="20">20 days</option>
             <option value="25">25 days</option>									
             <option value="30">30 days</option>
         </select>							
         <label for="codVisibility"><br>Visibility<br></label>
         <select id="codVisibility" name="codVisibility">
             <option value="public">public</option>
             <option value="private">private</option>
         </select>
         <br><input type="password" id="codPwd" name="codPwd" size="11" placeholder=" Password..."> <br>
         <button type="submit" value="submit" name="submit" >Upload Code</button>
     </form>
     <?php
					//what we get from $_POST is what we can not see, what we get from $_GET is what we can see
     if(isset($_GET["error"])){
     $valueOfError = $_GET["error"];
     if($valueOfError != "none") {
        echo '<p class="error-class">' . $valueOfError . '</p>';
    }

     if($_GET["error"] == "none"){
      echo '<p class="error-empty"> You have successfully uploaded your code.</p>';
     }
 }  

  ?>
</section>
</div>
</div>

<?php
include_once 'footer.php';
?>


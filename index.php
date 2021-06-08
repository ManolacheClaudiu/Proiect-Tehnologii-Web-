<?php
include_once 'header.php';
?>
<div class="MiddleLayout">
 <?php
 include_once 'navigationMenu.php';
 ?>
 <div class="CodeBox">
     <section class="cod-form">
         <form onsubmit="submitCodeForSave()" action="includes/codebox.inc.php" method="post">

           <!-- Container for input code -->
           <div id="code-input-id" class="code-input" contenteditable data-placeholder="Place your code here sir..."></div>
           <input type="hidden" id="hidden-input-code-id" name="hidden-input-code" value="" />
           
           <br><input type="text" name="codName"  id = "codName-id" size="11" placeholder=" Name your file..."> 
           <br><br>
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
             <?php
             if(isset($_SESSION['useruid'])){
                echo '<option value="50">50 days</option>
                <option value="75">75 days</option>
                <option value="100">100 days</option>
                <option value="200">200 days</option>                                   
                <option value="365">1 year</option>';
            }
            ?>
        </select>       
        <br>                   
        <label for="codVisibility"><br>Visibility<br></label>
        <?php
        if(isset($_SESSION['useruid'])){
            echo '<select id="codVisibility" name="codVisibility">
            <option value="public">public</option>
            <option value="private">private</option>
            </select>';
        }
        else
            {echo '<select id="codVisibility" name="codVisibility">
        <option value="public">public</option>
        
        </select>';

    }
    ?>
    <br><br>
    <?php
    if(!isset($_SESSION['useruid'])){
        echo '<input type="text" name="captcha" id="captcha" placeholder="Please write the captcha code from bellow" /><br>
        <span  style="padding:0">
        <img src="image.php" id="captcha_image" />
        </span>';
    }
    else{
        echo '<br><input type="password" id="codPwd" name="codPwd" size="11" placeholder=" Set a password for your code..."> <br>';

    }
    ?>
    <br><br>
    <button type="submit" id="save" value="submit" name="submit">Save code</button>
    <br>
    <input type="text" name="hidden-code-id-name" id = "hidden-code-id" hidden></input>
    <input type="text" name="action" id ="action-id-hidden" hidden value="save"></input>
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

<?php
include_once 'header.php';
?>
<div class="MiddleLayout">
    <?php
        include_once 'navigationMenu.php';
    ?> 
    <div class="CodeBox">
        <div id="collabs-selection">
            <form action="includes/addCollaborator.inc.php" method="post">
                <?php
                    if(isset($_GET["codeId"])){
                        $codeId= $_GET["codeId"];
                        echo '<input type="text" name="collab-hidden-code-id" id ="collab-hidden-code-id" value="'. $codeId .'" >';
                    }  
                ?>
                <label for="Users">Users</label>
                    <select id="collaborators-select-id" name="collaborators-select-id">   
                        <?php
                            require_once 'includes/dbh.inc.php';        
                            if(isset($_SESSION['useruid'])){
                                $loggedUser =  $_SESSION['useruid'];
                                $_SESSION['collabCodeId'] = $_GET['codeId'];
                                $query = "SELECT `usersUid` FROM `users` WHERE `usersUid` !='" . $loggedUser . "';";
                                $result = mysqli_query($conn, $query);
                                $rowcount=mysqli_num_rows($result);
                                if($rowcount > 0) {  
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value=" . $row["usersUid"] .">" . $row["usersUid"] . " </option>";
                                    }
                                }
                                mysqli_close($conn);
                            }
                        ?>
                    </select>
                <button class="btn" type="submit" value="submit"  name="submit">Add Collaborator</button>
            </form>
         </div>
        <?php
            if(isset($_GET["error"])){
                if($_GET["error"] == "colabExists"){
                echo "<p> Please choose an collabotor which is not taken already!</p>";
                }
            }
        ?>
    </div> 
</div>

<?php
include_once 'footer.php';
?>

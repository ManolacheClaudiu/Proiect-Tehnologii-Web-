<<<<<<< HEAD
<?php
include_once 'header.php';
?>
<div class="MiddleLayout">

 <?php
 include_once 'navigationMenu.php';
 ?>
 
 <div class="CodeBox">

    <div id="collabs-selection">
        <?php
         echo '<input type="text" name="hidden-code-id-name" id ="collab-hidden-code-id" value="'. $_GET['codeId'] .'" hidden></input>';
        ?>
        
        <form action="javascript:addCollaborator();" method="post">

            <label for="Users">Users</label>
            <select id="collaborators-select-id" name="Collaborators">   
                <?php
                require_once 'includes/dbh.inc.php';

                if(isset($_SESSION['useruid']))
                {
                    $loggedUser =  $_SESSION['useruid'];
                    $_SESSION['collabCodeId'] = $_GET['codeId'];

                    $query = "SELECT `usersUid` FROM `users` WHERE `usersUid` !='" . $loggedUser . "';";
                    $result = mysqli_query($conn, $query);

                    $rowcount=mysqli_num_rows($result);

                    if($rowcount > 0)
                    {  
                        while($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row["usersUid"] .">" . $row["usersUid"] . " </option>";
                        }
                    }
                    mysqli_close($conn);
                }
                ?>
            </select>

            <input type="submit" value="Add Collaborator">
        </form>

    </div>
</div>
</div>

<?php
include_once 'footer.php';
?>
=======
<?php
include_once 'header.php';
?>
<div class="MiddleLayout">

 <?php
 include_once 'navigationMenu.php';
 ?>
 
 <div class="CodeBox">

    <div id="collabs-selection">
        <?php
         echo '<input type="text" name="hidden-code-id-name" id ="collab-hidden-code-id" value="'. $_GET['codeId'] .'" hidden></input>';
        ?>
        
        <form action="javascript:addCollaborator();" method="post">

            <label for="Users">Users</label>
            <select id="collaborators-select-id" name="Collaborators">   
                <?php
                require_once 'includes/dbh.inc.php';

                if(isset($_SESSION['useruid']))
                {
                    $loggedUser =  $_SESSION['useruid'];
                    $_SESSION['collabCodeId'] = $_GET['codeId'];

                    $query = "SELECT `usersUid` FROM `users` WHERE `usersUid` !='" . $loggedUser . "';";
                    $result = mysqli_query($conn, $query);

                    $rowcount=mysqli_num_rows($result);

                    if($rowcount > 0)
                    {  
                        while($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row["usersUid"] .">" . $row["usersUid"] . " </option>";
                        }
                    }
                    mysqli_close($conn);
                }
                ?>
            </select>

            <input type="submit" value="Add Collaborator">
        </form>

    </div>
</div>
</div>

<?php
include_once 'footer.php';
?>
>>>>>>> 1bad601f0d23ecb485ba71b633f2d006ca0b984e

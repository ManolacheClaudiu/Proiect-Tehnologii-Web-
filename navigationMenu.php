<div class="NavigationMenu">

    <label for="myCheck">

        Syntax <br>Highlighting
    </label>
    <input type="checkbox" id="myCheck" onclick="highlight()">
    <p id="text" style="display:none">Activated</p>


    <br>	
    <label for="Languages">
        <br>Languages<br>
    </label>

    <select id="languages-id" name="Languages">
        <option value="unselected">unselected</option>
        <option value="html">html</option>
        <option value="c">c</option>
        <option value="c++">c++</option>
        <option value="css">css</option>
        <option value="java">java</option>
    </select>

    <br><br>
    <button onclick="resetCodeInput();" class="btn"><i class="fa fa-folder"></i> Reset Input</button>

    <ul class="repositories-class">
        <?php
        require_once 'includes/dbh.inc.php';

        if(isset($_SESSION['useruid']))
        {
            $loggedUser =  $_SESSION['useruid'];
            $loggedUserQuery = "SELECT * FROM `cod` WHERE `codUsersName` = '". $loggedUser . "';";
            
            $result = mysqli_query($conn, $loggedUserQuery);
            
            $rowcount=mysqli_num_rows($result);
            
            if($rowcount > 0)
            {  
                while($row = $result->fetch_assoc()) {
                    $codeId = $row["codId"];
                    echo '<li>
                    <a href="#" onclick="fetchCodeByCodeId(' . $codeId . ');">'. $row["codName"] . '</a>

                    <button onclick="deleteCodeById(' . $codeId . ');" class="btn"><i class="fa fa-trash"></i></button>

                    <button onclick="editCodeById(' . $codeId . ');" class="btn"><i class="fa fa-edit"></i></button>
                    
                    </li>';
                }
            }
        } else{
            $anonimQuery = "SELECT * FROM `cod` WHERE `codUsersName` = 'anonim';";

            $result = mysqli_query($conn, $anonimQuery);
            $rowcount=mysqli_num_rows($result);
            
            if($rowcount > 0)
            {  
                while($row = $result->fetch_assoc()) {
                    $codeId = $row["codId"];
                    echo '<li>
                    <a href="#" onclick="fetchCodeByCodeId(' . $codeId . ');">'. $row["codName"] . '</a>
                    </li>';
                }
            }
        }
        ?>
    </ul>
    
</div>

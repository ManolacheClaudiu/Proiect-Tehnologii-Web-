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

    <ul class="repositories-class">
        <?php

        if(isset($_SESSION['useruid']))
        {
            $loggedUser =  $_SESSION['useruid'];

            require_once 'includes/dbh.inc.php';
            
            $query = "SELECT * FROM `cod` WHERE `codUsersName` = '". $loggedUser . "';";
            
            $result = mysqli_query($conn, $query);
            
            $rowcount=mysqli_num_rows($result);
            
            if($rowcount > 0)
            {  
                while($row = $result->fetch_assoc()) {
                    echo '<li><a href="#" onclick="fetchCodeByCodeId();">'. $row["codName"] . '</a></li>';
                }
            }
        }

        ?>
    </ul>
</div>

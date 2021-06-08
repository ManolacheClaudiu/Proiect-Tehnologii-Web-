<div class="NavigationMenu">

    <div id="highlighter-id">
        <label for="myCheck">Syntax Highlighting</label>
        <input type="checkbox" id="myCheck" onclick="highlight()">
    </div>

    <div id="languages-and-reset-div">

        <label for="Languages">Languages</label>

        <select id="languages-id" name="Languages">
            <option value="unselected">unselected</option>
            <option value="html">html</option>
            <option value="c">c</option>
            <option value="c++">c++</option>
            <option value="css">css</option>
            <option value="java">java</option>
        </select>

        <button onclick="resetCodeInput();" class="fa fa-refresh" aria-hidden="true"></button>
    </div>

    <hr id="my-hr" />
    <label id="repositories-label-id" for="repositories">My Repositories:</label>
    <hr id="my-hr" />

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
                    <a class="btn-class-fetched" href="#" onclick="fetchCodeByCodeId(' . $codeId . ');">'. $row["codName"] . '</a>

                    <button onclick="deleteCodeById(' . $codeId . ');" class="fa fa-trash red"></button>

                    <button onclick="editCodeById(' . $codeId . ');" class="fa fa-edit green"></button>

                    <a href="collaboratorController.php?codeId=' . $codeId . '" class="fa fa-plus blue" title="Add colaborator"></a>

                    <button onclick="fetchCollaboratorsForCodeId(' . $codeId . ');" class="fa fa-list pink"></button>
                    </li>';
                }
            }

            echo '<hr id="my-hr" />';
            echo '<label id="repositories-label-id" for="repositories">Collaborators Repositories:</label>';
            echo '<hr id="my-hr" />';

            $collaboratorsQuery = "SELECT `codeId` FROM `collaborators` WHERE `collaboratorUserId` = '". $loggedUser . "';";
            $result = mysqli_query($conn, $collaboratorsQuery);
            $rowcount=mysqli_num_rows($result);
            
            if($rowcount > 0)
            { 
                while($row = $result->fetch_assoc()) {
                    $codeId = $row["codeId"];
                    $codeNameQuery = "SELECT `codName`, `codUsersName` FROM `cod` WHERE `codId` ='" . $codeId . "';";

                    $codeNameResult = mysqli_query($conn, $codeNameQuery);
                    while($row = $codeNameResult->fetch_assoc()) {
                    echo '<li>
                    <a class="btn-class-fetched" href="#" onclick="fetchCodeByCodeId(' . $codeId . ');">'. $row['codName'] . '</a>


                    <a class="btn-name-fetched fa fa-user" href="#">' . $row['codUsersName'] . '</a>
                    </li>
                    ';
                    }
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
                    <a class="btn-class-fetched" href="#" onclick="fetchCodeByCodeId(' . $codeId . ');">'. $row["codName"] . '</a>
                    </li>';
                }
            }
        }
        ?>
    </ul>

    <hr id="my-hr" />
    <label for="collabs">Collabs:</label>
    <hr id="my-hr" />

    <ul id="collaborators-list-id" class="repositories-class">

    </ul>
    
</div>

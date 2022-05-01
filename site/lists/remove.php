<?php
    $selectedList = $_POST["lists"]; 
    

    if(isset($_POST["clearbutton"])){
        $mysqli->real_query("
            UPDATE wordlist
            SET active = 0
            WHERE id = $selectedList");

            header("Location: index.php");
            exit;
    }
    else{
        echo '
        <br>
        <form action="index.php" method="post">
            <input type="hidden" id="lists" name="lists" value="' . $selectedList . '">
            <input type="hidden" id="actions" name="actions" value="' . $selectedAction . '">
            <button type="submit" id="submit" name="clearbutton">Remove</button>
        </form>';
    }
?>
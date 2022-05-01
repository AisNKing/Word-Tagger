<?php 
    $selectedList = $_POST["lists"]; 
    $selectedAction = $_POST["actions"]; 

    

    if(isset($_POST["clear"])){
        $wordToClear = $_POST["clear"];

        $mysqli->real_query("
            UPDATE wordtag
            SET active = 0
            WHERE word = $wordToClear");
    }

    
    $mysqli->real_query(
        "SELECT w.id as wordid, w.name as wordname, t.name as tagname
        FROM word w
        LEFT JOIN wordtag wt
        ON wt.word = w.id
        AND wt.active = 1
        LEFT JOIN tag t 
        ON t.id = wt.tag
        AND t.active = 1
        WHERE w.list = $selectedList
        AND w.active = 1
        ORDER BY w.id ASC");

    $words = $mysqli->store_result(); 
    
    $currentWord = 0;
    
    foreach ($words as $word) {
        if ($currentWord != $word['wordid']){
            echo '<br><br>
            <form action="index.php" method="post">
                <b>' . $word['wordname'] . '</b> 
                <input type="hidden" id="lists" name="lists" value="' . $selectedList . '">
                <input type="hidden" id="actions" name="actions" value="' . $selectedAction . '">
                <input type="hidden" id="clear" name="clear" value="' . $word['wordid'] . '">
                <button type="submit" id="submit" name="clearbutton">Clear Tags</button>
            </form>
            <br>';
            $currentWord = $word['wordid'];
        }
        echo '' . $word['tagname'] . '<br>';
    }
    
?>
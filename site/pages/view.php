<?php 
    $selectedList = $_POST["lists"]; 
    $selectedAction = $_POST["actions"]; 

    
    $mysqli->real_query(
        "SELECT w.id as wordid, w.name as wordname, t.name as tagname
        FROM word w
        LEFT JOIN wordtag wt
        ON wt.word = w.id
        LEFT JOIN tag t 
        ON t.id = wt.tag
        WHERE w.list = $selectedList
        AND w.active = 1
        ORDER BY w.id ASC");

    $words = $mysqli->store_result(); 
    
    //var_dump($words);
    //var_dump($currentWord);

    //$row = $words->fetch_row();
    //$currentWord = $row[0] ?? false;
    $currentWord = 0;

    foreach ($words as $word) {
        if ($currentWord != $word['wordid']){
            echo '<br><b>' . $word['wordname'] . '</b><br>';
            $currentWord = $word['wordid'];
        }
        echo '' . $word['tagname'] . '<br>';
    }
    
?>
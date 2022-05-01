<?php 
    $selectedList = $_POST["lists"]; 
    $selectedAction = $_POST["actions"]; 

    $mysqli->real_query(
        "SELECT t.id, t.name
        FROM tag t
        WHERE list = $selectedList
        AND active = 1
        ORDER BY t.id ASC");

    $tags = $mysqli->store_result(); 

    //check if checked from last post and insert before serving up next word
    if(isset($_POST['selectedWord'])){
        $selectedWord = $_POST['selectedWord'];
        foreach ($tags as $tag) {
            if(isset($_POST[$tag['id']])){

                $selectedTag = $tag['id'];
                $mysqli->real_query(
                    "INSERT INTO wordtag (word, tag, active)
                    VALUES ($selectedWord, $selectedTag, 1)");
            }
        }
    }
    
    //var_dump($_POST['1']);

    $mysqli->real_query(
        "SELECT w.id, w.name 
        FROM word w
        WHERE w.list = $selectedList
        AND w.active = 1
        AND w.id NOT IN (
            SELECT wt.word 
            FROM wordtag wt 
            INNER JOIN tag t 
            ON t.id = wt.tag
            AND t.active = 1
            WHERE wt.active = 1
            )
        ORDER BY w.id ASC
        LIMIT 1");

    $words = $mysqli->store_result(); 
    
    foreach ($words as $word) {
        echo '<br><b><u>' . $word['name'] . '</u></b><br><br>';
    }
    if(isset($word)){
        echo '<form action="index.php" method="post">
            <input type="hidden" id="lists" name="lists" value="' . $selectedList . '">
            <input type="hidden" id="selectedWord" name="selectedWord" value="' . $word['id'] . '">
            <input type="hidden" id="actions" name="actions" value="' . $selectedAction . '">';
        foreach ($tags as $tag) {
            echo '<input type="checkbox" id="' . $tag['id'] . '" name="' . $tag['id'] . '">' . 
                $tag['name'] . '<br>';
        }

        echo '<br><br>
        <button type="submit">Next</button>
        </form>';
    }

    else{
        echo 'End of list';
    }
?>
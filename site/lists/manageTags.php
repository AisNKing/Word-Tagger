<br>
<form class="form-horizontal" action="index.php?manageTags" method="post" enctype="multipart/form-data">
    
    <?php
        $selectedList = $_POST["lists"]; 
        $selectedAction = $_POST["actions"];

        echo '
        <input type="hidden" id="lists" name="lists" value="' . $selectedList . '">
        <input type="hidden" id="actions" name="actions" value="' . $selectedAction . '">';
    ?>

    <div class="form-group">
        <label class="col-md-4 control-label" for="tagname">Tag name</label>
        <div class="col-md-4">
            <input type="text" name="tagname" id="tagname" class="input-large">
        </div>
    </div>
    <br>
    <!-- Submit -->
    <div class="form-group">
        <div class="col-md-4">
            <button type="submit" id="submit" name="submit">Submit</button>
        </div>
    </div>
    <br>
</form>

<?php

    $selectedList = $_POST["lists"]; 
    $selectedAction = $_POST["actions"]; 

    
    if(isset($_POST["clear"])){
        $tagToClear = $_POST["clear"];

        $mysqli->real_query("
            UPDATE tag
            SET active = 0
            WHERE id = $tagToClear");
    }

    //Add tag
    if(isset($_POST["submit"])){

        $tagname = $_POST["tagname"];

        $mysqli->real_query(
            "INSERT INTO tag (name, list, active)
            VALUES ('$tagname', $selectedList, 1)");
    }

    $mysqli->real_query(
        "SELECT t.id, t.name
        FROM tag t
        WHERE list = $selectedList
        AND active = 1
        ORDER BY t.id ASC");

    $tags = $mysqli->store_result(); 

    //show current tags with remove button
    foreach ($tags as $tag) {
        echo '
        <form action="index.php" method="post">
            <b>' . $tag['name'] . '</b> 
            <input type="hidden" id="lists" name="lists" value="' . $selectedList . '">
            <input type="hidden" id="actions" name="actions" value="' . $selectedAction . '">
            <input type="hidden" id="clear" name="clear" value="' . $tag['id'] . '">
            <button type="submit" id="submit" name="clearbutton">Remove</button>
        </form>';
    }
?>
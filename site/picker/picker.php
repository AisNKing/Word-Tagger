<form action="index.php?picker" method="post">
    <?php
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $mysqli = new mysqli("localhost:3306", "root", "", "word_tagger");

        $mysqli->real_query(
            "SELECT * 
            FROM wordlist 
            WHERE active = 1
            ORDER BY id ASC");

        $wordlist = $mysqli->store_result();


        //List 1
        echo '
        <label for="list1">Select list 1:</label>
        <select name="list1" id="list1">
        <option value="0" default>Select</option>';

        foreach ($wordlist as $row) {
            if(isset($_POST["list1"]) && $_POST["list1"] == $row['id']){ 
                echo '<option value="' . $row['id'] . '" selected>' . $row['name'] . '</option>';
            }
            else{
                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
        }
        echo '</select>';


        //List 2
        echo '
        <label for="list2">Select list 2:</label>
        <select name="list2" id="list2">
        <option value="0" default>Select</option>';

        foreach ($wordlist as $row) {
            if(isset($_POST["list2"]) && $_POST["list2"] == $row['id']){ 
                echo '<option value="' . $row['id'] . '" selected>' . $row['name'] . '</option>';
            }
            else{
                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
        }
        echo '</select>';
             
    ?>
    
    <br>
    <!-- Submit -->
    <div class="form-group">
        <div class="col-md-4">
            <button type="submit" id="submit" name="submit">Submit</button>
        </div>
    </div>

</form>


<?php
    include 'selectTag.php';
    if(isset($_POST["submit"])){
        //include 'selectTag.php';
        /*
        $list1 = $_POST["list1"];
        $list1 = $_POST["list2"];

        $mysqli->real_query(
            "SELECT w.id, w.name 
            FROM word w
            WHERE w.list = $selectedList
            INNER JOIN wordtag wt
            AND w.active = 1
            ON w.id = wt.word
                AND wt.list = $list1
            ORDER BY w.id ASC");

        $words1 = $mysqli->store_result(); 
        
        
        foreach ($words as $word) {
            echo '<br><b><u>' . $word['name'] . '</u></b><br><br>';
        }
        */
    }

?>    
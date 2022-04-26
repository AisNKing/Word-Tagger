<form action="index.php?picker" method="post">
    <?php  
        if(isset($_POST["list1"]) && isset($_POST["list2"])){
            $list1 = $_POST["list1"];
            $list2 = $_POST["list2"];
            
            $mysqli->real_query(
                "SELECT t.id, t.name
                FROM tag t
                WHERE list = $list1
                ORDER BY t.id ASC");

                
            $taglist1 = $mysqli->store_result();

            //Tag 1
            echo '
            <input type="hidden" id="list1" name="list1" value="' . $list1 . '">
            <input type="hidden" id="list2" name="list2" value="' . $list2 . '">
            <label for="tags1">Select tag 1:</label>
            <select name="tags1" id="tags1">
            <option value="0" default>Select</option>';

            foreach ($taglist1 as $tagL1) {
                if(isset($_POST["tags1"]) && $_POST["tags1"] == $tagL1['id']){ 
                    echo '<option value="' . $tagL1['id'] . '" selected>' . $tagL1['name'] . '</option>';
                }
                else{
                    echo '<option value="' . $tagL1['id'] . '">' . $tagL1['name'] . '</option>';
                }
            }
            echo '</select>';


            $mysqli->real_query(
                "SELECT t.id, t.name
                FROM tag t
                WHERE list = $list2
                ORDER BY t.id ASC");

                
            $taglist2 = $mysqli->store_result();
            
            //Tag 2
            echo '
            <label for="tags2">Select tag 2:</label>
            <select name="tags2" id="tags2">
            <option value="0" default>Select</option>';

            foreach ($taglist2 as $tagL2) {
                if(isset($_POST["tags2"]) && $_POST["tags2"] == $tagL2['id']){ 
                    echo '<option value="' . $tagL2['id'] . '" selected>' . $tagL2['name'] . '</option>';
                }
                else{
                    echo '<option value="' . $tagL2['id'] . '">' . $tagL2['name'] . '</option>';
                }
            }
            echo '</select><br>
            
            <div class="form-group">
                <div class="col-md-4">
                    <button type="submit" id="generate" name="generate">Generate</button>
                </div>
            </div>';
        }

?>

    <!-- Generate -->

</form>


<?php 

    if(isset($_POST["generate"])){
        
        $list1 = $_POST["list1"];
        $list2 = $_POST["list2"];

        $tag1 = $_POST["tags1"];
        $tag2 = $_POST["tags2"];

        if ($tag1 != 0){
            $mysqli->real_query(
                "SELECT w.id, w.name 
                FROM word w
                INNER JOIN wordtag wt
                ON wt.word = w.id
                AND wt.tag = $tag1
                WHERE w.list = $list1
                AND w.active = 1
                ORDER BY w.id ASC");

            $words1 = $mysqli->store_result();
        
        }
        else{
            $mysqli->real_query(
                "SELECT w.id, w.name 
                FROM word w
                WHERE w.list = $list1
                AND w.active = 1
                ORDER BY w.id ASC");

            $words1 = $mysqli->store_result();

        }

        $listSelect1 = array();
        
        foreach($words1 as $word1){
            array_push($listSelect1, $word1['name']);
        }

        if($tag2 != 0){
            $mysqli->real_query(
                "SELECT w.id, w.name 
                FROM word w
                INNER JOIN wordtag wt
                ON wt.word = w.id
                AND wt.tag = $tag2
                WHERE w.list = $list2
                AND w.active = 1
                ORDER BY w.id ASC");

            $words2 = $mysqli->store_result();

        }
        else{
            $mysqli->real_query(
                "SELECT w.id, w.name 
                FROM word w
                WHERE w.list = $list2
                AND w.active = 1
                ORDER BY w.id ASC");

            $words2 = $mysqli->store_result();

        }

        $listSelect2 = array();

        foreach($words2 as $word2){
            array_push($listSelect2, $word2['name']);
        }

        if (count($listSelect1) > 0 && count($listSelect2) > 0 ){
            $index1 = rand(0, count($listSelect1) -1);
            $index2 = rand(0, count($listSelect2) -1);

            echo $listSelect1[$index1] . ' ' . $listSelect2[$index2];
        }
        else{
            echo 'One of the tags contains no words';
        }

    }
?>
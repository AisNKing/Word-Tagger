<form class="form-horizontal" action="index.php?import" method="post" enctype="multipart/form-data">
    <!-- Upload Button -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="filebutton">Select File</label>
        <div class="col-md-4">
            <input type="file" name="file" id="file" class="input-large">
        </div>
    </div>

    <!-- Name list -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="listname">Name of list</label>
        <div class="col-md-4">
            <input type="text" name="listname" id="listname" class="input-large">
        </div>
    </div>

    <!-- Submit -->
    <div class="form-group">
        <label class="col-md-4 control-label" for="submit">Import data</label>
        <div class="col-md-4">
            <button type="submit" id="submit" name="Import">Import</button>
        </div>
    </div>
</form>

<?php
if(isset($_POST["Import"])){
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli("localhost:3306", "root", "", "word_tagger");

    $filename = $_FILES["file"]["tmp_name"]; 
    $listname = $_POST["listname"];

    echo $listname;
    //Create empty list
    $mysqli->real_query(
        "INSERT INTO wordlist (name, active)
        VALUES ('$listname', 1)");


    $mysqli->real_query(
        "SELECT id
        FROM wordlist 
        WHERE active = 1
        ORDER BY id DESC
        LIMIT 1");

    $records = $mysqli->store_result(); 

    //need to keep this to initialise $record lazily
    foreach ($records as $record) {
        //echo '<b>' . $word['name'] . '</b><br><br>';
    }
    $newID = $record["id"];



    $row = 1;
    if (($handle = fopen($filename, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            $row++;
            //echo implode($data,"") . '<br>';
            $wordname = implode($data,"");
            //$theword = print_r($data, 1);
            //echo $theword . '<br>';
            
            $mysqli->real_query(
                "INSERT INTO word (name, list, active)
                VALUES ('$wordname', $newID, 1)");
            
            /*
            for ($c=0; $c < $num; $c++) {
                echo $data[$c] . '<br />\n';
            }
            */
            
        }
        fclose($handle);
    }
}
?>

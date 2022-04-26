<form action="index.php" method="post">
    <label for="lists">Select list:</label>
    <select name="lists" id="lists" onchange="this.form.submit()">
        <option value="0" default>Select</option>
        <?php
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $mysqli = new mysqli("localhost:3306", "root", "", "word_tagger");

            $mysqli->real_query(
                "SELECT * 
                FROM wordlist 
                WHERE active = 1
                ORDER BY id ASC");
            $wordlist = $mysqli->use_result();

            foreach ($wordlist as $row) {
                if(isset($_POST["lists"]) && $_POST["lists"] == $row['id']){ 
                    echo '<option value="' . $row['id'] . '" selected>' . $row['name'] . '</option>';
                }
                else{
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
            }
            echo '</select>';
             
        ?>
    </select>
</form>
<table class="selecttable">
    <tr>
        <td class="selectheader"><form action="index.php" method="post">
                <label for="action">Action:</label>
                <select name="actions" id="actions" onchange="this.form.submit()">
                    <?php
                        if (isset($_POST["actions"])){
                            $selectedAction = $_POST["actions"]; 
                        }
                        else{
                            $selectedAction = 0;
                        }
                        $selectedList = $_POST["lists"]; 
                        echo '<option value="0" default>Select</option>';
                        if($selectedAction == 1){
                            echo '<option value="1" selected>View</option>';
                        }
                        else{
                            echo '<option value="1" >View</option>';
                        }
                        if($selectedAction == 2){
                            echo '<option value="2" selected>Tag</option>';
                        }
                        else{
                            echo '<option value="2" >Tag</option>';
                        }
                        if($selectedAction == 4){
                            echo '<option value="4" selected>Manage Tags</option>';
                        }
                        else{
                            echo '<option value="4" >Manage Tags</option>';
                        }
                        if($selectedAction == 3){
                            echo '<option value="3" selected>Remove</option>';
                        }
                        else{
                            echo '<option value="3" >Remove</option>';
                        }
                        echo '</select>
                            <input type="hidden" id="lists" name="lists" value="' . $selectedList . '">';
                    ?>
                </select>
            </form>
        </td>
    </tr>
</table>
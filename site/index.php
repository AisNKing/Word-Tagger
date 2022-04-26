<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Word Tagger</title>
    </head>

    <body>
        <?php
            //Show page
            include 'structure/header.php';
            
            if (isset($_GET["import"])){
                include 'import/import.php';
            }
            else if (isset($_GET["picker"])){
                include 'picker/picker.php';
            }
            else{
                include 'lists/select.php';
                echo '<br>';

                //Page handler
                if(isset($_POST["lists"]) && $_POST["lists"] != 0){
                    include 'lists/action.php';
                    if(isset($_POST["actions"]) && $_POST["actions"] == 1){
                        include 'lists/view.php';
                    }
                    else if(isset($_POST["actions"]) && $_POST["actions"] == 2){
                        include 'lists/tag.php';
                    }
                    else if(isset($_POST["actions"]) && $_POST["actions"] == 3){
                        include 'lists/edit.php';
                    }
                    else if(isset($_POST["actions"]) && $_POST["actions"] == 4){
                        include 'lists/manageTags.php';
                    }

                }
            }

            include 'structure/footer.php';
        ?>
    </body>

</html>

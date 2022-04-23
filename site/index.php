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
                include 'pages/import.php';
            }
            else{
                include 'pages/select.php';
                echo '<br>';

                //Page handler
                if(isset($_POST["lists"]) && $_POST["lists"] != 0){
                    include 'pages/action.php';
                    if(isset($_POST["actions"]) && $_POST["actions"] == 1){
                        include 'pages/view.php';
                    }
                    else if(isset($_POST["actions"]) && $_POST["actions"] == 2){
                        include 'pages/tag.php';
                    }
                    else if(isset($_POST["actions"]) && $_POST["actions"] == 3){
                        include 'pages/edit.php';
                    }
                    else if(isset($_POST["actions"]) && $_POST["actions"] == 4){
                        //include 'pages/edit.php';
                    }

                }
            }

            include 'structure/footer.php';
        ?>
    </body>

</html>

<?php
    include("connectMySQL.php");


    if(isset($_POST['submit'])){
        

        //photo
        if ((($_FILES["photoInput"]["type"] == "image/gif") || ($_FILES["photoInput"]["type"] == "image/jpeg")) && ($_FILES["photoInput"]["size"] < 20000)){
            if ($_FILES["photoInput"]["error"] > 0){
                echo "Error";
            } else {
                $photoName = mysqli_real_escape_string($_FILES["photo"]["name"]);
                $photoData = mysqli_real_escape_string(file_get_contents($_FILES["photo"]["tmp_name"]));
                $imageType = mysqli_real_escape_string($_FILES["photo"]["type"]);

                if(substr($imageType, 0, 5) == "image"){
                    //need to do whole row (?)
                    $insphoto = "INSERT INTO ";
                }
            }
        }

    }
?>
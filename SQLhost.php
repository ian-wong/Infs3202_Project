<?php
    include("connectMySQL.php");
    $uid = $_GET['uid'];

    if(!isset($_POST['submit'])){
        //error handle
        echo "submit isset error";
    } else{
        //not checking photo input isset
        if((!isset($_POST['nameInput'])) || (!isset($_POST['locInput'])) || (!isset($_POST['priceInput'])) || (!isset($_POST['descInput'])) ){
            //error handle
            echo "value isset error";
        } else {
            //do a lot more error handling
            //if(){}



            
        
            //photo
            if ((($_FILES["photoInput"]["type"] == "image/gif") || ($_FILES["photoInput"]["type"] == "image/jpeg") || ($_FILES["photoInput"]["type"] == "image/pjpeg") || ($_FILES["photoInput"]["type"] == "image/png")) && ($_FILES["photoInput"]["size"] < 50000)){
                if ($_FILES["photoInput"]["error"] > 0){
                    echo "image error";
                } else {
                    $photoName = mysqli_real_escape_string($conn, $_FILES["photoInput"]["name"]);
                    $photoType = mysqli_real_escape_string($conn, $_FILES["photoInput"]["type"]);
                    $photoData = mysqli_real_escape_string($conn, file_get_contents($_FILES["photoInput"]["tmp_name"]));

                    //if(substr($photoType, 0, 5) == "image"){
                        
                    //no mysql data insertion
                    $name = $_POST['nameInput'];
                    $loc = $_POST['locInput'];
                    $price = $_POST['priceInput'];
                    $desc = $_POST['descInput'];

                    //need to do whole row (?)
                    $insaccomm = "INSERT INTO accommodation (uid, name, location, descr, photos, cost) VALUES ('$uid', '$name','$loc', '$desc', '$photoData', '$price')";
                    mysqli_query($conn, $insaccomm);
                
                    header("location: profile.php?id=$uid");
                        
                    //} else {
                    //    echo "substr photoType error";
                    
                }
            } else{
                echo "image input error";
            }

        } 
        //echo "value isset error";
        
        //

    }
    //echo "submit isset error";
    $conn->close();
?>
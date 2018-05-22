<?php
    include("connectMySQL.php");
    
    $uid = $_GET['uid'];

    if(!isset($_POST['submit'])){
        //error
        echo 'error isset submit';
    } else {
        if (!isset($_POST['phoneInput'])){
            //erro
            echo 'input empty';
        } else {
            //escape string
            $phone = str_pad($_POST['phoneInput'],1);
            
            //echo $phone;
            //check phone number
            //if(preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $phone)) {
                // $phone is valid
            if(is_numeric($phone)){
                $updphone = "UPDATE user SET phone='$phone' WHERE uid='$uid'";
        
                mysqli_query($conn, $updphone);
                header("Location: profile.php?id=".$uid."");
            }
            //}


            //if(is_numeric($phone)){
                
            //}
        }
    }

?>
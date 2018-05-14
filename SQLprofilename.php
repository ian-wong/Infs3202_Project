<?php
include("connectMySQL.php");

    if (isset($_POST['fNameInput']) && !empty($_POST['lNameInput'])  ){
        $fName = $_POST['fNameInput'];
        $lName = $_POST['lNameInput'];
        $uid = $_GET['uid'];

        /*
        //Checking Safe MySQL Data Insertion
        $fName = mysqli_real_escape_string($db->link, $_POST["fNameInput"]);
        $lName = mysqli_real_escape_string($db->link, $_POST["lNameInput"]);
        $email = mysqli_real_escape_string($db->link, $_POST["emailInputReg"]);
        $password = mysqli_real_escape_string($db->link, $_POST["passwordInput"]);
        */
        //NEED '' between varchars 
        $updname = "UPDATE user SET firstname='$fName', surname='$lName' WHERE uid='$uid'";
        
        mysqli_query($conn, $updname);
        /*
        if (mysqli_query($conn, $updname) === TRUE){ //mysql_query($insertuser, $db->link);
            header("Location: profile.php?id='.$uid.'");
        } else {
            //error handle
        }
        */


        //for auto increment id
        //$id = mysqli_insert_id($db->link);
    }

    $conn->close();
    header("Location: profile.php?id=".$uid."");

?>
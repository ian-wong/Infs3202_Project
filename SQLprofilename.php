<?php
include("connectMySQL.php");

    if (!isset($_POST['submit'])){
        header("location: index.php");
    } else {
        $fName = mysqli_real_escape_string($conn, $_POST["fNameInput"]);
        $lName = mysqli_real_escape_string($conn, $_POST["lNameInput"]);
        if (empty($fName) || empty($lName)){
            header("location: profilename.php?error=empty");
        } else {
            if (!preg_match("/^[a-zA-Z]*$/", $fName) || !preg_match("/^[a-zA-Z]*$/", $lName)){
                header("location: profilename.php?error=value");
            } else {
                $uid = $_GET['uid'];
        
                $updname = "UPDATE user SET firstname='$fName', surname='$lName' WHERE uid='$uid'";
                
                try {
                    mysqli_query($conn, $updname);
                } catch (exception $e){
                    header("location: profilename.php?error=error");
                }
                header("Location: profile.php?uid=".$uid."");
            }
        }

    }
    $conn->close();
?>
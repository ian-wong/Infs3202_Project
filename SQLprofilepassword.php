<?php
include("connectMySQL.php");

    $uid = $_GET['uid'];
    if (!isset($_POST['submit'])){
        header("location: index.php");
    } else {
        $oldPass = mysqli_real_escape_string($conn, $_POST["oldPassInput"]);
        $newPass = mysqli_real_escape_string($conn, $_POST["newPassInput"]);
        $confNewPass = mysqli_real_escape_string($conn, $_POST["confNewPassInput"]);

        if (empty($newPass) || empty($confNewPass) || empty($oldPass)){
            header("location: profilepassword.php?uid=$uid&error=empty");
        } else {
            if (!($newPass == $confNewPass)){
                header("location: profilepassword.php?uid=$uid&error=passmatch");
            } else {
                $sqlselect = "SELECT * FROM user WHERE uid='$uid'";
                $result = mysqli_query($conn, $sqlselect);
                if (!result){
                    header("location: profilepassword.php?uid=$uid&error=error");
                }
                $row = mysqli_fetch_assoc($result);
                $hashpassCheck = password_verify($oldPass, $row['passw']);
                if ($hashpassCheck == false){
                    header("Location: proflepassword.php?uid=$uid&error=oldpass");           
                } elseif ($hashpassCheck == true){
                    $hashpwd = password_hash($newPass, PASSWORD_DEFAULT);
                    $updpass = "UPDATE user SET passw='$hashpwd' WHERE uid='$uid'";
                    
                    mysqli_query($conn, $updpass);
                    
                    header("Location: profile.php?uid=$uid");
                }  
            }
        }

    }
    $conn->close();
?>
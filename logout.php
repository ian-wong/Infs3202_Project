<?php
    include("connectMySQL.php");

    session_start();
    $email = $_SESSION['login_user'];
    $sqlselect="SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sqlselect);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $uid = $row['uid'];
    
    $phone = $row['phone'];
    if ($phone=='0'){
        if(session_destroy()){
            header("Location: index.php");
        } else {
            //error
        }  
    } else {
        if(session_destroy()){
            header("location: SQLsms.php?phone=$phone");
        }
    }  
?>
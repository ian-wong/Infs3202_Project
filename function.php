<?php

    function isset_user(){
        include 'connectMySQL.php';

        if(isset($_SESSION['login_user']) ){  //&& isset($_SESSION['password'])){
            $email = $_SESSION['login_user'];
            $sqlselect="SELECT * FROM user WHERE email='$email'";
            $result = mysqli_query($conn, $sqlselect);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $uid = $row['uid'];

            echo '<a class="nav-link" href="profile.php?uid='.$uid.'">Welcome, '.$row['firstname'] .'</a>';
        } else {
            echo '<a class="nav-link" href="login.php">Account</a>';
        } 
    }

    function want_uid(){

    }
?>
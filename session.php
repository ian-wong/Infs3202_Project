<?php
    include("connectMySQL.php");

    session_start();

    $user_check = $_SESSION['login_user'];
    $ses_sql = mysqli_query($conn, "select email from user where email = '$usercheck'");
    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

    $login_session = $row['email'];

    if(!isset($_SESSION['login_user'])){
        header("Location: login.html");
    }

?>
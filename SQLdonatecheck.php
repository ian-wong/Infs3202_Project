<?php

    //This file is only for checking if user is logged in first before sending them off
    //to sandbox paypal.
    //cant do it at top of SQLdonate.php for some reason.

    include("connectMySQL.php");
    
    session_start();

    //must login to donate
    if(!isset($_SESSION['login_user'])){
        header('location: login.php'); //?check=need
    } else {
        header('location: SQLdonate.php');
    }



?>
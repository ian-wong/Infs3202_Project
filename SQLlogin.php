<?php
    //$email = 'emailInput';
    //$password = 'passwordInput';
    /*
    if ($_REQUEST['emailInput'] == "quest" && $_REQUEST['passwordInput'] == "123"){
        //proceed
    } else {
        //go back
    }
    */
    include("connectMySQL.php");
    
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        //Check SQL Data Insertion
        $email = mysqli_real_escape_string($conn, $_POST['emailInput']);
        $password = mysqli_real_escape_string($conn, $_POST['passwordInput']);

        $sqlselect = "SELECT uid FROM user WHERE email = '$email' and passw = '$password'";
        $result = mysqli_query($conn, $sqlselect);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        //No idea what this is for $active = $row['active'];

        $count = mysqli_num_rows($result);
        $error=null;
        //if correct email and pass, then table must have 1 row
        if($count == 1){
            $_SESSION['login_user'] = $email;
            
            //$_SEESION_['password'] = $password;

            //header("Location: goodlogin.php");
            header("location: index.php");
        } else {
            $error = "Login unsuccessful, email or password invalid.";
            header("Location: login.php");
        
        }
    }

    $conn->close();



?>
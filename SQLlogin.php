<?php
    include("connectMySQL.php");
    
    session_start();

    if (!isset($_POST['submit'])){
        header("location: index.php");
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['emailInput']);
        $password = mysqli_real_escape_string($conn, $_POST['passwordInput']);

        if(empty($email) || empty($password)){
            header("location: login.php?error=empty");
        } else {
            $sqlselect = "SELECT * FROM user WHERE email = '$email'";
            $result = mysqli_query($conn, $sqlselect);
            
            if (!result){
                header("location: login.php?error=error");
            }

            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck < 1){
                header("Location: login.php?error=incorrect");
            } else { 
                if ($row = mysqli_fetch_assoc($result)){
                    $hashpassCheck = password_verify($password, $row['passw']);
                    if ($hashpassCheck == false){
                        header("Location: login.php?error=incorrect");           
                    } elseif ($hashpassCheck == true){
                        $_SESSION['login_user'] = $email;
                        header("location: index.php?success=login");
                    }
                }
            }            
        }
    }
    $conn->close();
?>
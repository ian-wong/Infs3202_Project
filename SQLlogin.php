<?php
    include("connectMySQL.php");
    
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = mysqli_real_escape_string($conn, $_POST['emailInput']);
        $password = mysqli_real_escape_string($conn, $_POST['passwordInput']);

        if(empty($email) || empty($password)){
            header("location: login.php?error=empty");
        } else {
            $sqlselect = "SELECT uid FROM user WHERE email = '$email' and passw = '$password'";
            $result = mysqli_query($conn, $sqlselect);
            
            if (!result){
                header("location: login.php?error=error");
            }
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $count = mysqli_num_rows($result);
            if($count == 1){
                $_SESSION['login_user'] = $email;
                header("location: index.php?success=login");
            } else {
                header("Location: login.php?error=incorrect");
            }
        }
    }
    $conn->close();
?>
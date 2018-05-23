<?php
    include("connectMySQL.php");

    if (!isset($_POST['submit'])) {
        header("location: index.php");
    } else {
        $fName = mysqli_real_escape_string($conn, $_POST['fNameInput']);
        $lName = mysqli_real_escape_string($conn, $_POST['lNameInput']);
        $email = mysqli_real_escape_string($conn, $_POST['emailInputReg']);
        $password = $_POST['passwordInput'];
        $confpassword = $_POST['confirmPassInput'];
        if(empty($fName) || empty($lName) || empty($email) || empty($password) || empty($confpassword)){
            header("location: signup.php?error=empty");
        } else { 
            if (!preg_match("/^[a-zA-Z]*$/", $fName) || !preg_match("/^[a-zA-Z]*$/", $lName)){
                header("location: signup.php?error=name");
            } else {
                if(!filter_var($email)){
                    header("location: signup.php?error=email");
                } else {
                    if (!($password == $confpassword)){
                        header("location: signup.php?error=password");
                    } else {
                        $insertuser = "INSERT INTO user(firstname, surname, email, passw) VALUES ('$fName', '$lName', '$email', '$password')";
                        try {
                            mysqli_query($conn, $insertuser);
                        } catch (exception $e){
                            header("location: signup.php?error=error");
                        }
                        header("Location: login.php?success=signup");
                    }
                }
            }
        }
    }
    $conn->close();
?>
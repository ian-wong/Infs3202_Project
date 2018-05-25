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
            if (!preg_match("/^[a-zA-Z ]*$/", $fName) || !preg_match("/^[a-zA-Z ]*$/", $lName)){
                header("location: signup.php?error=name");
            } else {
                if(!filter_var($email)){
                    header("location: signup.php?error=email");
                } else {
                    if (!($password == $confpassword)){
                        header("location: signup.php?error=password");
                    } else {
                        //check if email already exists
                        $sqlunique = "SELECT * FROM user WHERE email='$email'";
                        $uniqueresult = mysqli_query($conn, $sqlunique);
                        $uniqueresultcheck = mysqli_num_rows($uniqueresult);

                        if($uniqueresultcheck > 0){
                            header("location: signup.php?error=emailtaken");
                        }
                        else {
                            $hashpwd = password_hash($password, PASSWORD_DEFAULT);

                            $insertuser = "INSERT INTO user(firstname, surname, email, passw) VALUES ('$fName', '$lName', '$email', '$hashpwd')";
                            mysqli_query($conn, $insertuser);
                            
                            header("Location: login.php?success=signup");

                        }
                    }
                }
            }
        }
    }
    $conn->close();
?>
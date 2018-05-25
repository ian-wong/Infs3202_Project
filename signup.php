<!DOCTYPE html> 
<?php
    include("connectMySQL.php");
    include 'function.php';

    session_start();
    if(isset($_SESSION['login_user'])){ 
        header("location: index.php");
    }
?>

<html lang="en">
<head>
    <?php
        head_html();
    ?>

</head>
<body>

<header>
    <?php
        header_nav();
    ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>

</header>

<div class="card">
    <div class="card-header">
        <h3 class="col-7 mb-1">Register</h3>
    </div>
    <div class="card-body">
        <form id="loginForm " action="SQLsignup.php" method="POST">
            <!--User Input -->
            <div class="form-row">
                <?php
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        if($error == "empty"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>You did not fill in all fields</p>";
                            echo '</div>';
                        } 
                        elseif($error == "name"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>You entered an invalid first name(s) or last name</p>";
                            echo '</div>';
                        } 
                        elseif($error == "email"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>You entered an invalid email address</p>";
                            echo '</div>';
                        }
                        elseif($error == "password"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>Your entered passwords did not match</p>";
                            echo '</div>';
                        }
                        elseif($error == "error"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>Unable to connect to server, please try again later.</p>";
                            echo '</div>';
                        }
                        elseif($error == "emailtaken"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>Email Address already exists, please use another.</p>";
                            echo '</div>';
                        }
                    }
                ?>

                <div class="form-group col-md-5 ml-3 mb-4">
                    <label for="fNameInput">First Name</label>
                    <input type="text" class="form-control" id="fNameInput" name="fNameInput">
                </div>
                <div class="form-group col-md-5 ml-3 mb-4">
                    <label for="lNameInput">Last Name</label>
                    <input type="text" class="form-control" id="lNameInput" name="lNameInput">
                </div>
            </div> 

            <div class="form-group">
                <div class="col-7 mb-4">
                    <label for="emailInputReg">Email address</label>
                    <input type="email" class="form-control" id="emailInputReg" placeholder="email@example.com" name="emailInputReg">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5 ml-3">
                    <label for="passwordInput">Password</label>
                    <input type="password" class="form-control" id="passwordInput" name="passwordInput">
                </div>
                <div class="form-group col-md-5 ml-3">
                    <label for="confirmPassInput">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassInput" name="confirmPassInput">
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-7">
                    <button type="submit" class="btn btn-primary" name="submit">Create Account</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>

</html>

<?php
    $conn->close();
?>
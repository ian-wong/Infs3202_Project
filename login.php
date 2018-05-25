<!DOCTYPE html>
<?php
    include 'connectMySQL.php';
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
    <script src="js/loginJS.js" type="text/javascript"></script>

</head>


<body>

<header>
    <?php
        header_nav();
    ?>
</header>

<!-- Login Form -->
<div class="card">
    <div class="card-header">
        <h3 class="col-7 mb-1">Login</h3>
    </div>
    <div class="card-body">
        <form id="loginForm" action="SQLlogin.php" method="POST">
            <div class="form-group">
                <?php 
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        if($error == "empty"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>You did not fill in all fields</p>";
                            echo '</div>';
                        } 
                        elseif($error == "incorrect"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>Invalid Email or password.</p>";
                            echo '</div>';
                        }  
                        elseif($error == "login"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>Please login to proceed.</p>";
                            echo '</div>';
                        }  
                        elseif($error == "error"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>Unable to connect to server, please try again later.</p>";
                            echo '</div>';
                        } 
                    } elseif (isset($_GET['success'])){
                        $success = $_GET['success'];
                        if($success == "signup"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-success'>Successful signup! Please sign in.</p>";
                            echo '</div>';
                        }
                    }
                ?>
                <div class="col-7 mb-4 mt-4">
                    <label for="emailInput">Email address</label>
                    <input type="email" class="form-control" id="emailInput" placeholder="email@example.com" name="emailInput">
                </div>
            </div>
            <div class="form-group mb-5">
                <div class="col-7">
                    <label for="passwordInput">Password</label>
                    <input type="password" class="form-control" id="passwordInput" name="passwordInput">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-7">
                    <a href="signup.php" class="btn btn-primary">Sign Up</a>
                    <button type="submit" name="submit" class="btn btn-primary">Log In</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
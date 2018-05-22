<!DOCTYPE html> 
<?php
    include("connectMySQL.php");

    session_start();

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Accommodation Finder">
    <meta name="author" content="Anthony Hanh & Ian Wong">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quest Hotel</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <!-- Icon -->
    <link rel="icon" href="img/logo.png"/>

    <!-- Bootstrap CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <!-- JQuery from Google-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
     <!-- Google Maps API -->
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD556cffToiu6QUeMA370u-To2aBgcKngw&callback=initMap" async
            defer></script>

</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">
            <img src="img/logo.png" id="Logo" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            
            <!-- Search Bar -->
            <form class="form-inline" action="searchResult.php" method="POST"><!--Can use GET method-->
                <input class="form-control mr-sm-2" id="searchBar" type="search" placeholder="Search" onkeyup="showResult(this.value)" aria-label="Search" name="searchInput"> 
                <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
            </form>
             <!-- Add functionality to search accommodations by name, location, user(host) by using dropdown list next to search bar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php
                        if(isset($_SESSION['login_user']) ){  //&& isset($_SESSION['password'])){
                            //header("location: index.php");
                            $email = $_SESSION['login_user'];
                            $sqlselect="SELECT * FROM user WHERE email='$email'";
                            $result = mysqli_query($conn, $sqlselect);
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            $uid = $row['uid'];

                            echo '<a class="nav-link" href="profile.php?id='.$uid.'">Welcome, '.$row['firstname'] .'</a>';
                        } else {
                            echo '<a class="nav-link" href="login.php">Account</a>';
                        } 
                    ?>
                </li>
            </ul>

            
        </div>
    </nav>
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
                    
                    
                    //$urlcheck = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    //if(strpos($urlcheck, "error=empty") == true){
                    
                    if (!isset($_GET['error'])) {
                        
                    } else {
                        $signupcheck = $_GET['error'];

                        if($signupcheck == "empty"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>You did not fill in all fields</p>";
                            echo '</div>';
                        } 
                        elseif($signupcheck == "name"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>You entered an invalid first name(s) or last name</p>";
                            echo '</div>';
                        } 
                        elseif($signupcheck == "email"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>You entered an invalid email address</p>";
                            echo '</div>';
                        }
                        elseif($signupcheck == "password"){
                            echo '<div class="form-group col-md-12 ml-3 mb-4">';
                            echo "<p class='text-danger'>Your entered passwords did not match</p>";
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
                    <input type="password" class="form-control" id="confirmPassInput">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-7">
                    <button type="submit" class="btn btn-primary" name="submit">Create Account</button>
                </div>
            </div>
        </form>
    </div>
</div>

</body>

</html>

<?php
    //$db->disconnect(); // disconnect after use is a good habit
    $conn->close();
?>
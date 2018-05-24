<!DOCTYPE html>
<?php 
    include("connectMySQL.php");
    include 'function.php';

    session_start();
    if(!isset($_SESSION['login_user'])){
        header("location: login.php");
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
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="index.php" class="navbar-brand">
            <img src="images/logo.png" id="Logo" class="d-inline-block align-top">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <form class="form-inline" action="searchResult.php" method="POST"><!--Can use GET method-->
                <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" aria-label="Search" name="searchInput"> <!--type="search"-->
                <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
            </form>
            <ul class="navbar-nav ml-auto">
            <a class="nav-link" href="aboutus.php">About Us</a>
                <li class="nav-item">
                    <?php
                        isset_user();
                    ?>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <?php
                $luemail = $_SESSION['login_user'];
                $uid = $_GET['uid'];
                $sqlhost = "SELECT * FROM user WHERE uid='$uid'";
                $result = mysqli_query($conn, $sqlhost);

                $row = mysqli_fetch_assoc($result);
                $hostemail = $row['email'];
                $hostphoto = '<img src="SQLgetuphoto.php?uid='.$uid.'" class="img-fluid">';
                $hostfname = $row['firstname'];
                $hostsname = $row['surname'];

                echo "<br />";
                echo '<div class="row">';
                    echo "<div class='col-md-3'>";
                        echo $hostphoto;
                    echo "</div>";
                    echo "<div class='col-md-9'>";
                            echo '<br/>';
                            echo '<h3>'.$hostfname.' '.$hostsname. '</h3>';
                    echo "</div>";
                echo '</div>';
                echo '</br>';
                echo "<h5>Email ".$hostfname. " " .$hostsname." the host of this accommodation</h5>";
                
                
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if($error == "email"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Sorry, unable to send email please try again later.</p>";
                        echo '</div>';
                    } 
                    elseif($error == "value"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Please fill in all fields.</p>";
                        echo '</div>';
                    } 
                }
        
                echo '<form method="POST" action="SQLemail.php">';
                    echo '<label for="fromemail">From:</label>';
                    echo '<input type="text" class="form-control" id="fromemail" value="'.$luemail.'" name="fromemail"></br>';

                    echo '<label for="toemail">To:</label>';
                    echo '<input type="text" class="form-control" id="toemail" value="'.$hostemail.'" name="toemail"></br>';
                    
                    echo '<label for="subject">Subject:</label>';
                    echo '<input type="text" class="form-control" id="subject" name="subject"></br>';

                    echo '<label for="message">Comment:</label>';
                    echo '<textarea class="form-control" rows="5" id="message" name="message"></textarea></br>';
                    
                    echo '<button type="submit" name="submit" class="btn btn-primary">Send Email</button>';
                echo '</form>';
            ?>
        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>
    

</body>

</html>


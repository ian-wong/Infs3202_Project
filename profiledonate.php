<!DOCTYPE html>
<?php 
    include("connectMySQL.php");
    include 'function.php';

    session_start();
    if(!isset($_SESSION['login_user'])){
        header('location: login.php');
    }
?>

<html lang="en">
<head>
    <?php
        head_html();
    ?>

     <!-- Google Maps API -->
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD556cffToiu6QUeMA370u-To2aBgcKngw&callback=initMap" async
            defer></script>

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
                <input class="form-control mr-md-2" id="searchBar" type="search" placeholder="Search" onkeyup="showResult(this.value)" aria-label="Search" name="searchInput"> 
                <button class="btn btn-outline-light " type="submit" name="submit">Search</button>
            </form>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php
                        isset_user();
                    ?>
                </li>
            </ul>  
        </div>
    </nav>
</header>

    <div class="card">
        <div class="card-header mb-4">
            <h3 class="col-7 mb-1 ">Your donations to Quest Hotel</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="row">
                <?php 
                    $uid = $_GET['uid'];
                    $selpay = "SELECT * FROM payment,user WHERE payment.uid=user.uid AND user.uid=$uid";
                    $result = mysqli_query($conn, $selpay);
            
                    //check if there are records
                    if (!(mysqli_num_rows($result)>0)){
                        echo "You have made zero donations to Quest Hotel.";
                    } else {
                        echo "<table border='1'>
                            <tr>
                            <th>PayPal Id</th>
                            <th>PayPal Payment Id</th>
                            <th>Amount Donated AUD$</th>
                            </tr>";
                        while ($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['payerid'] . "</td>";
                            echo "<td>" . $row['paymentid'] . "</td>";
                            echo "<td>" . $row['amount'] . "</td>";
                            echo "</tr>";
                        }
                        echo '</table>';
                    }   
                ?>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
</body>

</html>
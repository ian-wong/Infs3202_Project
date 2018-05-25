<!DOCTYPE html>
<?php 
    include("connectMySQL.php");
    include 'function.php';

    session_start();
    if(!isset($_SESSION['login_user'])){
        header('location: login.php');
    }
?>

<html>
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
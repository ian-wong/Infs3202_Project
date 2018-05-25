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
</head>
<body>

<header>
    <?php
        header_nav();
    ?>
</header>
    <div class="card">
        <div class="card-header">
            <h3 class="col-7 mb-1">Host Your Own Accommodation</h3>
        </div>
        <div class="card-body">
            <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if($error == "empty"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Please fill out all fields.</p>";
                        echo '</div>';
                    } 
                    elseif($error == "photo"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>You uploaded an invalid file for the accommodation, please upload a photo.</p>";
                        echo '</div>';
                    } 
                    elseif($error == "price"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>You entered invalid characters for price.</p>";
                        echo '</div>';
                    } 
                    elseif($error == "error"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Unable to connect to server, please try again later.</p>";
                        echo '</div>';
                    } 
                }

                $uid = $_GET['uid'];
                echo '<form id="hostForm" action="SQLhost.php?uid='.$uid.'" method="POST" enctype="multipart/form-data">';
            ?>   
                <div class="col-md-5 ml-3 mb-4">
                    <label for="nameInput">Title of Accommodation:</label>
                    <input type="text" class="form-control" id="nameInput" name="nameInput" maxlength="250">
                </div>
                
                <div class="form-group col-md-7 ml-3 mb-4">
                    <label for="locInput">Address of Accommodation: </label>
                    <input type="text" class="form-control" placeholder="12 Example St Brisbane QLD 4000  //   Street Address - Suburb and State - Postcode"
                    id="locInput" name="locInput" maxlength="250">
                </div>
                
                <div class="col-md-3 ml-3">
                    <label>Pricing: </label>
                </div>
                <div class="col-md-2 ml-3 mb-4">
                    <div class="input-group">
                        <div class="input-group-addon "><b>$AUD </b></div>
                        <input class="form-control" type="text" name="priceInput" maxlength="15">
                        <div class="input-group-addon"><b> per night</b></div>
                    </div>
                </div>
                
                <div class="col-md-8 ml-3 mb-4">
                    <label for="descInput">Description: </label>
                    <textarea class="form-control" rows="5" placeholder="Basic Description / Amenities / Arrangements / Rules / Cancellations - (Maximum 2000 characters)"
                        id="descInput" name="descInput"></textarea>
                </div>
            
                <div class="col-md-5 ml-3">
                    <label for="photoInput">Upload a Photo of Accommodation: </label><br>
                    <input type="file" id="photoInput" name="photoInput" />
                </div>
                <div class="col-md-7 mt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Host Accommodation!</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

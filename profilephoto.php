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
        header();
    ?>
</header>
<div class="card">
        <div class="card-header mb-4">
            <h3 class="col-7 mb-1 ">Update Profile Picture</h3>
        </div>
            <?php
                if (isset($_GET['error'])) {
                    $error = $_GET['error'];
                    if($error == "photo"){
                        echo '<div class="form-group col-md-12 ml-3 mb-4">';
                        echo "<p class='text-danger'>Invalid file uploaded for profile picture, please upload</p>";
                        echo '</div>';
                    }
                }
                
                $uid = $_GET['uid'];
                echo '<form class="" id="hostForm" action="SQLprofilephoto.php?uid='.$uid.'" method="POST" enctype="multipart/form-data">';
            ?>
                <div class="col-md-5 ml-3 bg-danger">
                    <label for="photoInput">Select new profile picture </label><br>
                    <input type="file" id="photoInput" name="photoInput" />
                </div>
                
                <div class="col-md-7 ml-3 mt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Update Profile Picture</button>
                </div>
            </form>
    </div>
</body>

</html>
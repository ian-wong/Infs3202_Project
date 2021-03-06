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
    <div class="card-header mb-3">
        <h3 class="col-7 mb-1 ">Edit Profile Name</h3>
    </div>
        <?php
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if($error == "empty"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>Please fill out all fields.</p>";
                    echo '</div>';
                } 
                elseif($error == "value"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>You entered invalid values for your name, please enter characters only.</p>";
                    echo '</div>';
                } 
                elseif($error == "error"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>Unable to connect to server, please try again later.</p>";
                    echo '</div>';
                } 
            }

            $uid = $_GET['uid'];
            echo '<form class="" id="hostForm" action="SQLprofilename.php?uid='.$uid.'" method="POST">';
        ?>
            <div class="form-row form-inline ml-3">
                <div class="col-md-4 ml-3">
                    <h5>First name: </h5>
                    <input type="text" class="form-control" id="fNameInput" name="fNameInput" maxlength="100">
                </div>

                <div class="col-md-4 ml-3">
                    <h5>Surname: </h5>
                    <input type="text" class="form-control" id="lNameInput" name="lNameInput" maxlength="100">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-7 ml-3 mt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Update Name</button>
                </div>
            </div>
        </form>
</div>
</body>

</html>
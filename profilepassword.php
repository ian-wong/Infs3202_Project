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
    <div class="card-header mb-4">
        <h3 class="col-7 mb-1 ">Change Password</h3>
    </div>
        <?php
        
            if (isset($_GET['error'])) {
                $error = $_GET['error'];
                if($error == "empty"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>Please fill out all fields.</p>";
                    echo '</div>';
                } 
                elseif($error == "passmatch"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>The passwords you entered did not match.</p>";
                    echo '</div>';
                } 
                elseif($error == "oladpass"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>Incorrect old password entered.</p>";
                    echo '</div>';
                } 
                elseif($error == "error"){
                    echo '<div class="form-group col-md-12 ml-3 mb-4">';
                    echo "<p class='text-danger'>Unable to connect to server, please try again later.</p>";
                    echo '</div>';
                } 
            }
        

            $uid = $_GET['uid'];
            echo '<form class="" id="hostForm" action="SQLprofilepassword.php?uid='.$uid.'" method="POST">';
        ?>
            
            <div class="form-row form-inline ml-3">
                
                <div class="col-md-4 ml-3 bg-success">
                    <h5>Old Password:</h5>
                    <input type="password" class="form-control" id="oldPass" name="oldPassInput" >
                </div>
                

                <div class="col-md-4 ml-3 bg-success">
                    <h5>New Password: </h5>
                    <input type="password" class="form-control" id="newPassInput" name="newPassInput" >
                </div>

                <div class="col-md-4 ml-3 bg-success">
                    <h5>Confirm New Password: </h5>
                    <input type="password" class="form-control" id="confNewPassInput" name="confNewPassInput">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-7 ml-3 mt-4">
                    <button class="btn btn-primary" type="submit" name="submit">Update Password</button>
                </div>
            </div>
        </form>
</div>


</body>

</html>
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
            <h3 class="col-7 mb-1 ">Are you sure you want to permanently delete your account? </h3>
        </div>
            <?php
                $uid = $_GET['uid'];

                echo '<form class="" id="hostForm" action="SQLprofiledelete.php?uid='.$uid.'" method="POST">';
            
                echo '<a href="profile.php?uid='.$uid.'" class="btn btn-primary">No, go back.</a>';
            ?>    
                <div class="col-md-7 ml-3 mt-4">
                    <button class="btn btn-danger" type="submit" name="submit">Yes, permanently delete account.</button>
                </div>  
            </form>
    </div>
</body>

</html>
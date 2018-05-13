<?php
    //include 'connectMySQL.php';
    //include 'signup.php';

//header("Location: goodsignup.html");
/*
$db = new MySQLDatabase(); // create a Database object
$db->connect('root', '', '3202database'); //Doesnt work, why? $db->connect(“infs”, “3202”, “3202database”);
    // do some database jobs.

*/
    /*
    $servername = "localhost";
    $username = "root";
    $password = "";
    //also dbname
    $dbname = "3202database";
    
    //Create connection 
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    //Check connection
    if ($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    } 
    */
    include("connectMySQL.php");

    if (isset($_POST['fNameInput']) && !empty($_POST['lNameInput']) && !empty($_POST['emailInputReg']) && !empty($_POST['passwordInput']) ){
        $fName = $_POST['fNameInput'];
        $lName = $_POST['lNameInput'];
        $email = $_POST['emailInputReg'];
        $password = $_POST['passwordInput'];

        /*
        //Checking Safe MySQL Data Insertion
        $fName = mysqli_real_escape_string($db->link, $_POST["fNameInput"]);
        $lName = mysqli_real_escape_string($db->link, $_POST["lNameInput"]);
        $email = mysqli_real_escape_string($db->link, $_POST["emailInputReg"]);
        $password = mysqli_real_escape_string($db->link, $_POST["passwordInput"]);
        */

        $insertuser = "INSERT INTO user( firstname, surname, email, passw) VALUES ('$fName', '$lName', '$email', '$password')";
        //$conn->query($insertuser);
        mysqli_query($conn, $insertuser); //mysql_query($insertuser, $db->link);
    
        //for auto increment id
        //$id = mysqli_insert_id($db->link);
    }

    $conn->close();

    header("Location: login.php");

//header("Location: goodsignup.html");

//$db->disconnect(); // disconnect after use is a good habit

/*
mysql_query("INSERT INTO user(firstname, surname, email)
    VALUES ('$', '$user_refer', '$user_share', '".$_SERVER['REMOTE_ADDR']."')");
*/

/*  given code 
$query = "insert into user (firstname, surname, email) values('firstname','lastname','email')";
$result = mysqli_query($db->link,$query);
if(!$result){
    die(mysqli_error($db->link)); // useful for debugging
}
*/
?>
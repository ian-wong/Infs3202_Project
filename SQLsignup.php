<?php
include 'connectMySQL.php';
include 'signup.php';

$db = new MySQLDatabase(); // create a Database object
$db->connect(“root”, “”, “3202database”); //Doesnt work, why? $db->connect(“quay”, “3202”, “3202database”);
    // do some database jobs.
$db->disconnect(); // disconnect after use is a good habit

mysql_query("INSERT INTO user(firstname, surname, email)
    VALUES ('$', '$user_refer', '$user_share', '".$_SERVER['REMOTE_ADDR']."')");

/* given code
$query = “insert into user (firstname, surname, email) values()
$result = mysqli_query($db->link,$query);
if(!$result){
die(mysqli_error($db->link)); // useful for debugging
*/

?>
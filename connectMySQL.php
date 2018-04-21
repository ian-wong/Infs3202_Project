<?php
    class MySQLDatabase{
        /* Info ver20.4.18
        $cfg['Servers'][$i]['auth_type'] = 'config';
        $cfg['Servers'][$i]['user'] = 'root';                     
        $cfg['Servers'][$i]['password'] = '';
        OR
        $cfg['Servers'][$i]['user'] = 'quaydba';                     
        $cfg['Servers'][$i]['password'] = '3202';
        $cfg['Servers'][$i]['extension'] = 'mysqli';
        */
        public $link = null;
        function connect($user, $password, $database){
            $this->link = mysqli_connect('localhost', $user, $password);
            if(!$this->link){
                die('Not connected : ' . mysqli_connect_error());
            }
            $db = mysqli_select_db($this->link, $database);
            if(!$db){
                die ('Cannot use : ' . $database);
            }
            return $this->link;
        }
        function disconnect(){
            mysqli_close($this->link);
            }
}
/*
Add this to php page that needs MySQL database connection
<?php
include('connectMySQL.php'); // make sure the path is correct
$db = new MySQLDatabase(); // create a Database object
$db->connect(“yourUsername”, “yourPassword”, “yourDatabase”);
... // do some database jobs.
$db->disconnect(); // disconnect after use is a good habit
?>

<?php
include 'connectMySQL.php';

$db = new MySQLDatabase(); // create a Database object
$db->connect(“root”, “”, “3202database”); //Doesnt work, why? $db->connect(“quay”, “3202”, “3202database”);
    // do some database jobs.
$db->disconnect(); // disconnect after use is a good habit
?>
*/
?>
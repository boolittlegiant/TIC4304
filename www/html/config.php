<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'lsuser');
define('DB_PASSWORD', 'tic123');
define('DB_NAME', 'loginsystem');
 

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false){
    die("ERROR: Could not connect.". mysqli_connect_error());
}
?>

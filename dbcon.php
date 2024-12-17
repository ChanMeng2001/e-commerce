<?php

$server = "localhost";
$username = "root";
$pass = '';
$db = "ecommerce";

$db = new mysqli($server, $username, $pass, $db) or die("Unable to connect". mysql_error()); 

?>
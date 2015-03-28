<?php
$host="localhost";
$dbusername="root"; //database username
$dbpassword=""; //database password
$dbname="xyz"; //database name
$conn = mysql_connect($host,$dbusername,$dbpassword) or die("wrong username databse");
	$database= mysql_select_db($dbname) or ("cannot select database");

?>
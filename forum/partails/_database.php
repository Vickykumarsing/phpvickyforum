<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "idiscuss";

$conn = MySQLi_connect($servername,$username,$password,$database);

if(!$conn ) {
    die("mysql error".mysqli_connect_error());
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_reservation";

$conn = new mysqli($servername, $username, $password,$dbname);;
$conn->query("set names 'utf8'");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>

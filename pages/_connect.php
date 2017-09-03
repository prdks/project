<?php
include '_config.php';
// -------------------------------------------------------------
$conn = new mysqli($servername, $username, $password,$dbname);
$conn->query("set names 'utf8'");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$sql = "select * from config where id = 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$_SESSION['domain_name'] = $row['domain_name'];
$_SESSION['system_name'] = $row['name'];
$_SESSION['url_googleform'] = $row['url'];

?>

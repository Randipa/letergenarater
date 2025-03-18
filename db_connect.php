<?php
$servername = "localhost";
$username = "u263749830_root123";
$password = "=p=TK82lT";
$dbname = "u263749830_maletter_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
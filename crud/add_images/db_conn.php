<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_test";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn) {
    die("NOT CONNECTED" . mysqli_connect_error());
}
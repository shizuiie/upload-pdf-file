<?php
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "crud";

$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if(!$conn){
    die ("Something went wrong");
}
?>
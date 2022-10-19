<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "barcodescanner";

$conn = mysqli_connect($servername, $username, $password, $database);
$_SESSION['xxx'] = $_GET['id'];
// echo $_SESSION['xxx'];

?>
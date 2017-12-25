<?php
session_start();

error_reporting(0);
$error = "";

$username_form = $_SESSION['username'];
$newValue = $_GET['Gold'];


$servername = 'localhost';
$username = 'Gabriella';
$password = 'IgfFKlNVzrvBg1Q3';
$dbname = 'eggfarm';


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE users 
        SET gold = '$newValue'
        WHERE username = '$username_form'";

$result = $conn->query($sql);
$conn->close();
?>

<?php
$servername = "localhost";
$username = "root"; 
$passworddb = ""; 
$dbname = "ayushtest"; 


$conn = new mysqli($servername, $username, $passworddb, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stake_id = $_POST['stake_id'];

$sql = "SELECT * FROM stakeholderdata WHERE BINARY stakeid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $stakeid); 
$stmt->execute();
$result = $stmt->get_result();






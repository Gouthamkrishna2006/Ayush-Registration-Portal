<?php
$servername = "localhost";
$username = "root"; 
$passworddb = ""; 
$dbname = "ayushtest"; 


$conn = new mysqli($servername, $username, $passworddb, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['email'];
$password = $_POST['password'];


$sql = "SELECT * FROM stakeholderdata WHERE email = ? AND BINARY password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password); 
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
   
    echo "Login successful!";
    header('Location: ../../src/homepagestakeholder.html');
} else {
   
    header("Location: ../../src/wrong/loginstakeholderwrong.html"); 
    exit();
}


$stmt->close();
$conn->close();

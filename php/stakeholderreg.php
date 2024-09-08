<?php
$servername = "localhost";
$username = "root"; 
$passworddb = ""; 
$dbname = "ayushtest"; 


$conn = new mysqli($servername, $username, $passworddb, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$contact_number = $_POST['contact'];
$aadhar = $_POST['aadhar'];
$new_password = $_POST['password'];

$stmt = $conn->prepare("INSERT INTO stakeholderdata (first_name, last_name, email, password, gender, contact_number, aadhar) VALUES (?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssssii", 
    $first_name, $last_name, $email, $new_password, $gender, $contact_number, $aadhar);


if ($stmt->execute()) {
    header("Location: ../../index.html");
    exit();  
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

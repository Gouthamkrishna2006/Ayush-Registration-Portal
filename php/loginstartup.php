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


$sql = "SELECT * FROM userdata WHERE email = ? AND BINARY password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password); 
$stmt->execute();
$result = $stmt->get_result();




if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        setcookie("regnum", $row["regnum"], time() + 3600, "/");
    }
    echo "Login successful!";
    header('Location: ../../src/homepagestartup.php');
} else {
   
    header("Location: ../../src/wrong/loginstartupwrong.html"); 
    exit();
}


$stmt->close();
$conn->close();

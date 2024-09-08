<?php
$servername = "localhost";
$username = "root"; 
$passworddb = ""; 
$dbname = "ayushtest"; 


$conn = new mysqli($servername, $username, $passworddb, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first-name'];
$last_name = $_POST['last-name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$contact_number = $_POST['contact'];
$aadhar = $_POST['aadhar'];
$new_password = $_POST['password'];
$organization_name = $_POST['organization-name'];
$business_type = $_POST['business-type'];
$sector = $_POST['sector'];
$sub_sector = $_POST['sub-sector'];
$date_registration = $_POST['date-registration'];
$company_size = $_POST['company-size'];
$website = $_POST['website'];
$mobile = $_POST['mobile'];
$states = $_POST['state'];
$district = $_POST['district'];
$address1 = $_POST['address'];
$pincode = $_POST['pincode'];
$accountname = $_POST['accountname'];
$accountnumber = $_POST['accountnumber'];
$bankname = $_POST['bankname'];
$branchname = $_POST['branchname'];
$ifsc = $_POST['ifsc'];
$mirc = $_POST['mirc'];

$encrypted = '';
$passlist = [];

for ($i = 0; $i < strlen($new_password); $i++) {
    $passlist[] = ord($new_password[$i]);
}

$countnum = 0;
for ($i = 0; $i < strlen($email); $i++) {
    $encrypted .= chr(ord($email[$i]) * $passlist[$countnum] + 9999);
    if ($countnum == count($passlist) - 1) {
        $countnum = 0;
    } else {
        $countnum++;
    }
}

$registration1 = 0;
$registration2 = 0;

for ($i = 0; $i < strlen($encrypted); $i++) {
    $registration1 += ord($encrypted[$i]);
}

for ($i = 0; $i < strlen($email); $i++) {
    $registration2 += ord($email[$i]);
}

$regnum = strval($registration1) . "-" . strval($registration2);
$stmt = $conn->prepare("INSERT INTO userdata VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssssissssssssssisssssssisi", 
    $first_name, $last_name, $gender, $email, $contact_number, $states, 
    $district, $business_type, $sector, $sub_sector, $organization_name, 
    $date_registration, $company_size, $address1, $website, $pincode, 
    $mobile, $new_password, $accountname, $accountnumber, $bankname, 
    $branchname, $ifsc, $mirc, $regnum, $aadhar);


if ($stmt->execute()) {
    if(isset($_FILES['file-upload']) && $_FILES['file-upload']['error'] == 0) {
        $uploaddirectory = "../uploads/";
        $ogfile_name = $_FILES['file-upload']['name'];
        $fileext = pathinfo($ogfile_name, PATHINFO_EXTENSION);

        $file_name = $regnum . '.' . $fileext;

        $tmpFile = $_FILES['file-upload']['tmp_name'];
        $dest = $uploaddirectory . $file_name;
        if (!is_dir($uploaddirectory)) {
            mkdir($uploaddirectory, 0755, true);
        }
        if(move_uploaded_file($tmpFile, $dest)) {
            echo "The file has been uploaded and saved as: " . $file_name;
        } else {
            echo "Failed to move the uploaded file.";
        }
    }
    header("Location: ../../index.html");
    exit();  
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

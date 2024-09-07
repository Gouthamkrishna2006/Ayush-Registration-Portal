<?php
$conn = new mysqli('localhost', 'root', '', 'ayushtest');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$first_name = $_POST['first-name'];
$last_name = $_POST['last-name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$aadhar = $_POST['aadhar'];
$new_password = $_POST['new-password'];
$organization_name = $_POST['organization-name'];
$business_type = $_POST['business-type'];
$sector = $_POST['sector'];
$sub_sector = $_POST['sub-sector'];
$date_registration = $_POST['date-registration'];
$company_size = $_POST['company-size'];
$website = $_POST['website'];
$mobile = $_POST['mobile'];
$state = $_POST['state'];
$district = $_POST['district'];
$address = $_POST['address'];
$pincode = $_POST['pincode'];
$accountname = $_POST['accountname'];
$accountnumber = $_POST['accountnumber'];
$bankname = $_POST['bankname'];
$branchname = $_POST['branchname'];
$ifsc = $_POST['ifsc'];
$mirc = $_POST['mirc'];

$regnum = $email;
$encrypted = '';
$passlist = [];

for ($i = 0; $i < strlen($new_password); $i++) {
    $passlist[] = ord($new_password[$i]);
}

$countnum = 0;
for ($i = 0; $i < strlen($regnum); $i++) {
    $encrypted .= chr(ord($regnum[$i]) * $passlist[$countnum] + 9999);
    if ($countnum == count($passlist) - 1) {
        $countnum = 0;
    } else {
        $countnum++;
    }
}


$stmt = $conn->prepare("INSERT INTO userdata (first_name, last_name, gender, email, contact_number, state, district, business_type, sector, sub_sector, organization_name, date_registration, company_size, address, website, pincode, mobile, new_password, accountname, accountnumber, bankname, branchname, ifsc, mirc, encrypted, aadhar) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssssissssssssssisssssssisi", 
    $first_name, $last_name, $gender, $email, $contact_number, $state, 
    $district, $business_type, $sector, $sub_sector, $organization_name, 
    $date_registration, $company_size, $address, $website, $pincode, 
    $mobile, $new_password, $accountname, $accountnumber, $bankname, 
    $branchname, $ifsc, $mirc, $encrypted, $aadhar);


if ($stmt->execute()) {
    header("Location: ../../index.html");
    exit();  
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

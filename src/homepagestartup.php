<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startup Homepage - AYUSH Registration Portal</title>
    <link rel="stylesheet" href="..//styles/styles.css">
</head>
<body>
    <header>
        <h1>AYUSH Startup Portal</h1>
        <button id="backbtn" class = "disnone">Back</button>

    </header>

    <main>
        <div>
            <button class="small-button start1" id="profile">View Profile</button>
            <button class="small-button start2" id="status">Check Status</button>
            <button class="small-button start3" id="stakeholders">View Stakeholders</button>
        </div>
        <div class = "show1">
            <h1>Profile</h1>
            <?php
            $servername = "localhost";
            $username = "root";
            $passworddb = "";
            $dbname = "ayushtest";
            $conn = new mysqli($servername, $username, $passworddb, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $regnum = isset($_COOKIE["regnum"]) ? intval($_COOKIE["regnum"]) : 0;
            $sql = "SELECT * FROM userdata WHERE regnum = $regnum";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<p>" . htmlspecialchars("First Name: " . $row["first_name"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Last Name: " . $row["last_name"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Gender: ". $row["gender"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Email: " . $row["email"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Contact Number: " . $row["contact_number"]) . "</p>";
                    echo "<p>" . htmlspecialchars("State: " . $row["state"]) . "</p>";
                    echo "<p>" . htmlspecialchars("District: " . $row["district"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Buisness Type: " . $row["business_type"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Sector: " . $row["sector"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Sub-Sector: " . $row["sub_sector"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Organization Name: " . $row["organization_name"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Registration Date: " . $row["date_registration"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Company Size: " . $row["company_size"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Address: ". $row["address"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Website: " . $row["website"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Pincode: " . $row["pincode"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Website: " . $row["mobile"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Account Name: " . $row["accountname"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Account Number: " . $row["accountnumber"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Bank Name: " . $row["bankname"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Branch Name: " . $row["branchname"]) . "</p>";
                    echo "<p>" . htmlspecialchars("IFSC Code: " . $row["ifsc"]) . "</p>";
                    echo "<p>" . htmlspecialchars("MIRC Code: " . $row["mirc"]) . "</p>";
                    echo "<p>" . htmlspecialchars("Aadhar Number: " . $row["aadhar"]) . "</p>";

                }
            } else {
                echo "<p>No results found</p>";
            }
            
            $conn->close();
            ?>
        </div>
        <div class = "show2">
            <h1>Status</h1>
            <?php
            $servername = "localhost";
            $username = "root";
            $passworddb = "";
            $dbname = "ayushtest";
            $conn = new mysqli($servername, $username, $passworddb, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $regnum = isset($_COOKIE["regnum"]) ? intval($_COOKIE["regnum"]) : 0;
            $sql = "SELECT * FROM userdata WHERE regnum = $regnum";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row['not_approved']) {
                        echo "<p>" . htmlspecialchars("Application Denied") . "</p>";
                        break;
                    }
                    $ayush = $row["AYUSH"] ? "True" : "False";
                    $startup_india = $row["Startup India"] ? "True" : "False";
                    $ccras = $row["CCRAS"] ? "True" : "False";
                    $ccryn = $row["CCRYN"] ? "True" : "False";
                    $ccrum = $row["CCRUM"] ? "True" : "False";
                    $ccrs = $row["CCRS"] ? "True" : "False";
                    $ccrh = $row["CCRH"] ? "True" : "False";
            
                    echo "<p>AYUSH: " . htmlspecialchars($ayush) . "</p>";
            
                    $business_type = $row['business_type'];
            
                    if ($business_type === "Ayurveda") {
                        echo "<p>CCRAS: " . htmlspecialchars($ccras) . "</p>";
                    }
                    if ($business_type === "Yoga") {
                        echo "<p>CCRYN: " . htmlspecialchars($ccryn) . "</p>";
                    }
                    if ($business_type === "Unani") {
                        echo "<p>CCRUM: " . htmlspecialchars($ccrum) . "</p>";
                    }
                    if ($business_type === "Siddha") {
                        echo "<p>CCRS: " . htmlspecialchars($ccrs) . "</p>";
                    }
                    if ($business_type === "Homeopathy") {
                        echo "<p>CCRH: " . htmlspecialchars($ccrh) . "</p>";
                    }
            
                    echo "<p>Startup India: " . htmlspecialchars($startup_india) . "</p>";
            
                    if ($row["AYUSH"] && ($row["CCRAS"] || $row["CCRYN"] || $row["CCRUM"] || $row["CCRS"] || $row["CCRH"]) && $row['Startup India']) {
                        echo "<p>" . htmlspecialchars("Application Approved") . "</p>";
                    }  else{
                        echo "<p>" . htmlspecialchars("Application in Progress") . "</p>";
                    }
                }}
            $conn->close();
            ?>
        </div>
        <div class = "show3">
            <h1>Stakeholders</h1>
            <button id="addstakeholder">Add New Stakeholder</button>
            <div id="addstake" class="addstake">
                <div class="addstake-content">
                    <span class="closestake">&times;</span>

                    <form method = 'post' enctype="multipart/form-data" action = '../php/addstake.php'>
                    <label for="stake-id">Enter Stakeholder ID:</label>
                    <input id="stake-id" type="text" name="stake_id" required>
                    <button type="submit">Add Stakeholder</button>
                    </form>
                </div>

            </div>
        </div>
        <div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 AYUSH Startup Registration Portal</p>
    </footer>
    <script>
        var addstake = document.getElementById("addstake");

        var btn = document.getElementById("addstakeholder");

        var span = document.getElementsByClassName("closestake")[0];


        btn.onclick = function() {
            addstake.style.display = "block";
        }

        span.onclick = function() {
            addstake.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == addstake) {
                addstake.style.display = "none";
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            const profile = document.getElementById('profile');
            const status = document.getElementById('status');
            const stakeholders = document.getElementById('stakeholders');
            const back = document.getElementById('backbtn');
            const btngroup = document.querySelectorAll('.start1, .start2, .start3');
            const showgroup = document.querySelectorAll('.show1, .show2, .show3')
            const show1 = document.querySelectorAll('.show1');
            const show2 = document.querySelectorAll('.show2');
            const show3 = document.querySelectorAll('.show3');

            function toggleButtons(showGroup, hideGroup, direction, direction2) {
                showGroup.forEach((btn, index) => {
                    setTimeout(() => {
                        btn.classList.add('show');
                        btn.style.transform = `translate(${direction})`;
                    }, index * 100);
                });
                hideGroup.forEach((btn, index) => {
                    setTimeout(() => {
                        btn.classList.remove('show');
                        btn.style.transform = `translate(${direction2})`;
                    }, index * 100);
                });
                if (back.classList.contains('disnone')) {
                    back.classList.remove('disnone');
                } else {
                    back.classList.add('disnone')
                }
                
            }

            profile.addEventListener('click', () => {
                toggleButtons(show1, btngroup, '-50%,-50%','-500%,-50%');
            });

            status.addEventListener('click', () => {
                toggleButtons(show2, btngroup, '-50%,-50%','-500%,-50%');
            });

            stakeholders.addEventListener('click', () => {
                toggleButtons(show3, btngroup, '-50%,-50%', '-500%,-50%');
            });

            back.addEventListener('click', () => {
                toggleButtons(showgroup, btngroup, '1000%,-50%', '-50%,-50%');
            });
        });
    </script>
</body>
</html>

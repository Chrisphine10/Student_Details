<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin']) && !isset($_SESSION['student'])) {
    ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="display formheader exxt">
<?php
// Using MYSQLi connection
$servername = "127.0.0.1:3306";
$username = "pheene";
$password = "Passw0rd";
$dbname = "egerton_university";

$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT * FROM student_details";
$result = $connection->query($sql);

echo '<h1>Students List</h1><hr><table class="table" border="0" cellspacing="2" cellpadding="2">
<tr>
<th>No.</th>
<th>First Name</th>
<th>Last Name</th>
<th>Email</th>
<th>Phone Number</th>
<th>Gender</th>
<th>ID Number</th>
<th>Date of Birth</th>
<th>Religion</th>
</tr><br>';
if ($result->num_rows > 0) {
    $counter = 1;
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $fname = $row["fname"];
        $lname = $row["lname"];
        $phone = $row["phone_number"];
        $email = $row["email_address"];
        $gender = $row["gender"];
        $id = $row["id_number"];
        $dob = $row["date_of_birth"];
        $religion = $row["religion"];

        echo '
<tr>
    <td>' . $counter++ . '</td>
    <td>' . $fname . '</td>
    <td>' . $lname . '</td>
    <td>' . $email . '</td>
    <td>' . $phone . '</td>
    <td>' . $gender . '</td>
    <td>' . $id . '</td>
    <td>' . $dob . '</td>
    <td>' . $religion . '</td>
</tr><br>';
        
    }
    $result->free();
    
} else {
    echo "error locating row";
}
?>
</div>
</body>
</html>
<?php 
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset(); 
    session_destroy(); 
}
$_SESSION['LAST_ACTIVITY'] = time();
			}
			else {
			    header('Location: adminlogin.php');
			}
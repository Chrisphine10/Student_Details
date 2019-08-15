<?php
// Using MYSQLi connection
$servername = "127.0.0.1:3306";
$username = "pheene";
$password = "Passw0rd";
$dbname = "egerton_university";

$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    header('Location: error.php');
}

// log in details from user
$logEmail = $_POST["email"];
$logPassword = $_POST["password"];
// $logPassword = password_hash($password_string, PASSWORD_BCRYPT);

// get data from database
$sql = "SELECT password FROM student_details WHERE email_address ='" . $logEmail . "'";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $real_pass = $row["password"];
    }
} else {
    echo "error locating the row";
}
if (password_verify($logPassword, $real_pass)) {
    session_start();
    $_SESSION['admin'] = false;
    $_SESSION['email'] = $_POST["email"];
    $_SESSION['student'] = true;
    $_SESSION['loggedin'] = md5(microtime() . rand());
    echo "successfull login";
    header('Location: studenthome.php');
} else {
    echo "invalid password";
    header('Location: login.php');
}

$connection->close();

?>
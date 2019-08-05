<?php
//Using MYSQLi connection
$servername = "127.0.0.1:3306";
$username = "pheene";
$password = "Passw0rd";
$dbname = "egerton_university";

$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

//log in details from user
$logUsername = $_POST["username"];
$logPassword = $_POST["password"];
echo $logUsername;
echo $logPassword;

//get data from database
$sql = "SELECT password FROM admin WHERE username ='" . $logUsername."'";

$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $real_pass = $row["password"];
    }
} else {
    echo "error locating row";
}
if($real_pass == $logPassword){
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $logUsername;
    echo "successfull login";
    header('Location: adminhome.php');
}
else {
    echo "invalid password";
}

$connection->close();

?>
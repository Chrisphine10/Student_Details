<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin']) && !isset($_SESSION['student'])) {
   
// Using MYSQLi connection
$servername = "127.0.0.1:3306";
$username = "pheene";
$password = "Passw0rd";
$dbname = "egerton_university";

$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
    header('Location: delete.php');
}
else{
    $email = $_POST["email"];
    
    $sql="DELETE FROM student_details WHERE email_address ='". $email."'";
    
    if ($connection->query($sql) === TRUE) {
        echo "student deleted";
       header('Location: delete.php');
    }
    $connection->close();
    header('Location: delete.php');
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time();
}
else {
    header('Location: adminlogin.php');
}
?>
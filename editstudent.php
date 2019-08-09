<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin'])) {

    $servername = "127.0.0.1:3306";
    $username = "pheene";
    $password = "Passw0rd";
    $dbname = "egerton_university";

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $phone = $_POST["phone_number"];
    $email = $_POST["email"];
    $religion = $_POST["religion"];
    $fname = $_POST["fname"];
    $dob = $_POST["date_of_birth"];
    $lname = $_POST["lname"];
    $id = $_POST["idnumber"];
    $userpassword = $_POST["password"];
    $password_hash = password_hash($userpassword, PASSWORD_BCRYPT);
    $gender = $_POST["gender"];

    if ($phone) {
        $sql = "UPDATE student_details SET phone_number = '$phone' WHERE email_address = '$email'";
        $result = $connection->query($sql);
        if (isset($result)) {
            echo "good";
        }
    }
    if ($religion) {
        $sql = "UPDATE student_details SET religion='$religion' WHERE email_address = '$email'";
        $result = $connection->query($sql);
        if (isset($result)) {}
    }
    if ($fname) {
        $sql = "UPDATE student_details SET phone_number = '$fname' WHERE email_address = '$email'";
        if ($connection->query($sql) === TRUE) {}
    }
    if ($lname) {
        $sql = "UPDATE student_details SET lname = '$lname' WHERE email_address = '$email'";
        if ($connection->query($sql) === TRUE) {}
    }
    if ($dob) {
        $sql = "UPDATE student_details SET date_of_birth = '$dob' WHERE email_address = '$email'";
        if ($connection->query($sql) === TRUE) {}
    }
    if ($id) {
        $sql = "UPDATE student_details SET id_number = '$id' WHERE email_address = '$email'";
        if ($connection->query($sql) === TRUE) {}
    }
    if (($_POST["password"]) != ($_POST["cpassword"])) {
        echo "Password does not match!";
    } elseif ($password_hash) {
        $sql = "UPDATE student_details SET password = '$password_hash' WHERE email_address = '$email'";
        if ($connection->query($sql) === TRUE) {}
    }
    if ($gender) {
        $sql = "UPDATE student_details SET gender = '$gender' WHERE email_address = '$email'";
        if ($connection->query($sql) === TRUE) {}
    }
    
    $connection->close();
    header('Location: update.php');

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
} else {
    header('Location: adminlogin.php');
}
?>
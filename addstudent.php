<?php

//$fname, $lname, $id, $gender, $dob, $religion, $phone, $email, $userpassword
// Using MYSQLi connection
$servername = "127.0.0.1:3306";
$username = "pheene";
$password = "Passw0rd";
$dbname = "egerton_university";

$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if (isset($_POST['submit1'])) {
    $email = $_POST["email"];
    $sqltest = "SELECT * FROM student_details WHERE email_address ='" . $email . "'";
    $result = $connection->query($sqltest);
    if ($result->num_rows > 0) {
        echo "Email already registered to another user";
        header('Location: signup.php');
    } 
    else {
        $phone = $_POST["phone_number"];
        $email = $_POST["email"];
        $religion = $_POST["religion"];
        $fname = $_POST["fname"];
        $dob = $_POST["date_of_birth"];
        $lname = $_POST["lname"];
        $id = $_POST["idnumber"];
        $userpassword = $_POST["password"];
        $gender = $_POST["gender"];
        $sql = "INSERT INTO student_details
       (fname, lname, id_number, gender, date_of_birth, religion, phone_number, email_address, password)
        VALUES ('$fname','$lname','$id','$gender','$dob','$religion','$phone','$email','$userpassword')";

        if ($connection->query($sql) === TRUE) {
            header('Location: login.php');
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
            
        }

        $connection->close();
    }
}
?>
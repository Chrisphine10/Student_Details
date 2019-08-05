<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    echo "<script type=\"text/javascript\">
                   $(document).ready(function() {
                    promptLogin();
                    });
			        </script>";
    echo "<script>
			 window.onload = function() {
             document.getElementById('hidden').style.display = 'none';
             };
			    </script>";
}

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
    if (isset($result)) {
    }
}
if ($fname) {
    $sql = "UPDATE student_details SET phone_number = '$fname' WHERE email_address = '$email'";
    if ($connection->query($sql) === TRUE) {
    }   
}
if ($lname) {
    $sql = "UPDATE student_details SET lname = '$lname' WHERE email_address = '$email'";
    if ($connection->query($sql) === TRUE) {
    }  
}
if ($dob) {
    $sql = "UPDATE student_details SET date_of_birth = '$dob' WHERE email_address = '$email'";
    if ($connection->query($sql) === TRUE) {
    }
}
if ($id) {
    $sql = "UPDATE student_details SET id_number = '$id' WHERE email_address = '$email'";
    if ($connection->query($sql) === TRUE) {
    } 
}
if ($userpassword) {
    $sql = "UPDATE student_details SET password = '$userpassword' WHERE email_address = '$email'";
    if ($connection->query($sql) === TRUE) {
    }
}
if ($gender) {
    $sql = "UPDATE student_details SET gender = '$gender' WHERE email_address = '$email'";
    if ($connection->query($sql) === TRUE) {
    }
}
/*$sql = "UPDATE student_details SET fname = '$fname', lname = '$lname', id_number = '$id', gender = '$gender', date_of_birth = '$dob', religion = '$religion', phone_number = '$phone', password = '$userpassword'
    WHERE email = '$email'";

if ($connection->query($sql) === TRUE) {
    header('Location: update.php');
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}*/
//header('Location: adminhome.php');
$connection->close();
header('Location: update.php')

?>
            
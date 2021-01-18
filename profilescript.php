<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['student'] && isset($_SESSION['student'])) {

    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "12345678";
    $dbname = "egerton_university";

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $profile = isset($_POST["profile"]) ? $_POST["profile"] : '';
    $email = $_SESSION['email'];
    $image = $_POST['pic'];
    $sqltest = "SELECT * FROM student_profile WHERE email ='" . $email . "'";
    $result = $connection->query($sqltest);
    if ($result->num_rows > 0) {
        $sql = "UPDATE student_profile SET bio = '$profile' WHERE email = '$email'";
        $result = $connection->query($sql);
        if (isset($result)) {
            if (isset($_POST['pic'])) {
                $sql = "UPDATE student_profile SET image = '$image' WHERE email = '$email'";
                $result = $connection->query($sql);
                if (isset($result)) {

                    header('Location: my_profiler.php');
                    $connection->close();
                }
            } else

                header('Location: my_profiler.php');
            $connection->close();
        }
    } else {
        $sql = "INSERT INTO student_profile (bio, email, image) VALUES ('$profile', '$email', '$image')";
        if ($connection->query($sql) === TRUE) {
            header('Location: my_profiler.php');
        }
        $connection->close();
    }
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
} else {
    header('Location: login.php');
}
?>
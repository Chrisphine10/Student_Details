<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['student'] && isset($_SESSION['student'])) {
    ?>

<!DOCTYPE HTML>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>My details</title>
</head>
<body>
	<div class="flex">
		<div class="nav-bar">
			<ul>
				<li><a href="studenthome.php">Home</a></li>
				<li><a class="selectnav" href="my_details.php">Details</a></li>
				<li><a href="my_profiler.php">Profile</a></li>
				<li><a class="logout" href="logoutsession.php">Log Out</a></li>
			</ul>
		</div>
		<div class="loginform display htmlextend exxt">
			<div class="flexer">
				<h1>Your Details</h1>
				<br>
       <?php
    // Using MYSQLi connection
    $servername = "127.0.0.1:3306";
    $username = "root";
    $password = "12345678";
    $dbname = "egerton_university";

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM student_details WHERE email_address = '" . $email . "'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $fname = $row["fname"];
                    $lname = $row["lname"];
                    $phone = $row["phone_number"];
                    $gender = $row["gender"];
                    $id = $row["id_number"];
                    $dob = $row["date_of_birth"];
                    $religion = $row["religion"];
                }
            }
            $connection->close();
            ?>		
		<ul class="flexer">
					<li>Full Name:<br> <?php if (isset($fname)) {echo $fname;}?> <?php if (isset($lname)) { echo $lname; }?></li>
					<li>Email:<br> <?php if (isset($email)) {echo $email;}?></li>
					<li>Gender:<br> <?php if (isset($gender)) {echo $gender;}?></li>
					<li>Phone Number:<br> <?php if (isset($phone)) {echo $phone;}?></li>
					<li>ID Number:<br> <?php if (isset($id)) { echo $id;}?></li>
					<li>Date of Birth:<br> <?php if (isset($dob)) {echo $dob;}?></li>
					<li>Religion:<br> <?php if (isset($religion)) {echo $religion;}?></li>
				</ul>
			</div>
		<?php
        } else {
            echo "Student record not found!";

            $connection->close();
        }
    }
    ?>
    </div>
	</div>
</body>

<?php
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
        session_unset();
        session_destroy();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
} else {
    header('Location: login.php');
}
?>   
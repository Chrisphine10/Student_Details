<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['student'] && isset($_SESSION['student'])) {
    ?>
<!DOCTYPE HTML>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Profiler</title>
</head>
<body>
	<div class="flex">
		<div class="nav-bar">
			<ul>
				<li><a href="studenthome.php">Home</a></li>
				<li><a href="my_details.php">Details</a></li>
				<li><a class="selectnav" href="my_profiler.php">Profile</a></li>
				<li><a class="logout" href="logoutsession.php">Log Out</a></li>
			</ul>
		</div>
		<div class="display htmlextend exxt">
			<div class="mybio">
				<h1>Profiler</h1>
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
        $sql = "SELECT * FROM student_profile WHERE email = '" . $email . "'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $bio = $row["bio"];
                    $image = $row["image"];
                }
            }
            $connection->close();
            ?>
            <ul>
					<li><?php if (isset($image)) {echo $image;}?><br></li>
					<li><label class="bio">BIO:<?php if (isset($bio)) {echo $bio;}?></label><br></li>
				</ul>
				<form action="profileeditor.php">
					<input type="submit" class="submit input" value="Edit"
						name="submit">
				</form>
			</div>
		</div>
		<?php
        } else {
            ?>
            <form action="profileeditor.php">
			<input type="submit" value="Make a profile" class="submit input">
		</form>
		<br>
            <?php
            $connection->close();
            echo "profile not found!";
        }
    }

    ?>
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
<?php
session_start();
if (isset($_SESSION['loggedin']) && isset($_SESSION['email']) && $_SESSION['loggedin'] && $_SESSION['student'] && isset($_SESSION['student'])) {
    ?>
<!DOCTYPE HTML>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<title>Profile Editor</title>
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
			<div class="flexer">
				<h1>Profile Editor</h1>
				<br>		
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
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $sql = "SELECT * FROM student_profile WHERE email = '" . $email . "'";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $bio = $row["bio"];

                    ?>
				<form action="profilescript.php" class="textarea" method="post">
					<textarea class="round" id="profile" required="required"
						name="profile"><?php if (isset($bio)) {echo $bio;}?></textarea>
					<br> <input class="input" required="required" type="file"
						name="pic" accept="image/*"><br> <input type="submit"
						class="submit input"><br>
				</form>
				<?php
                }
            }
        } else {
            ?>
            <form action="profilescript.php" class="textarea"
					method="post">
					<textarea id="profile" required="required" name="profile">Enter Your Bio...</textarea>
					<br> <input class="input" required="required" type="file"
						name="pic" accept="image/*"><br> <input type="submit"
						class="submit input"><br>
				</form><?php
        }
    }
    $connection->close();
    ?>
			</div>
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
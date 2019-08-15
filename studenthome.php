<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['student'] && isset($_SESSION['student'])) {
    ?>

<!DOCTYPE HTML>
<html class="htmlextend">
<head>
<link rel="stylesheet" type="text/css" href="css/nav.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Student Home Page</title>
</head>
<body>
	<div class="flex">
		<div class="nav-bar">
			<ul>
				<li><a class="selectnav" href="studenthome.php">Home</a></li>
				<li><a href="my_details.php">Details</a></li>
				<li><a href="my_profiler.php">Profile</a></li>
				<li><a class="logout" href="logoutsession.php">Log Out</a></li>
			</ul>
		</div>
		<div class="display">
			<div class="welcome">
				<h1>Welcome Home student!</h1>
				<br>
			</div>
		</div>
	</div>
</body>
</html>
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
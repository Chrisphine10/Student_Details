<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_SESSION['admin']) && !isset($_SESSION['student'])) {
    ?>
<!DOCTYPE HTML>
<html class="htmlextend">
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Admin Home Page</title>
</head>
    <body>
    <div class="loginform display">
    <h1>Welcome Home Admin!</h1><br>
    <div>
    <div>
    <ul class="flexer">
    <li><a href="adminhome.php">Home</a></li>
    <li><a href="update.php">Update Student Details</a></li>
    <li><a href="delete.php">Delete Student</a></li>
    <li><a href="student_details.php">Student Details</a></li>
    </ul>
    <?php echo $_SESSION['admin']; ?>
    <a href="adminlogout.php">Log Out</a>
    </div>
    <div></div>
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
			}
			else {
			    header('Location: adminlogin.php');
			}
			?>
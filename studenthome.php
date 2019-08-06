<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['student'] && isset($_SESSION['student']) && (!isset($_SESSION['admin']))) {
            ?>
            
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Student Home Page</title>
</head>
    <body>
    <h1>Welcome Home student!</h1><br>
    <?php echo $_SESSION['student']; ?>
    <a href="logoutsession.php">Log Out</a>
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
			    header('Location: login.php');
			}
			?>
<?php
session_start();
unset($_SESSION['admin']);
unset($_SESSION['loggedin']);
session_unset();
session_destroy();
header('Location: adminlogin.php');
?>
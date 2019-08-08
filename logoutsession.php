<?php 
session_start();
unset($_SESSION['email']);
unset($_SESSION['student']);
unset($_SESSION['loggedin']);
session_unset();
session_destroy();
header('Location: index.php');

?>
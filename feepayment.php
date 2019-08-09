<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin'])) {
    ?>
<!DOCTYPE HTML>
<html class="htmlextend">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<title>Update Student</title>
</head>
<body>
  <div class="flex">
    <div class="nav-bar">
    <ul>
    <li><a href="adminhome.php">Home</a></li>
    <li><a href="update.php">Update Student Details</a></li>
    <li><a href="delete.php">Delete Student</a></li>
    <li><a href="student_details.php">Student Details</a></li>
    <li><a href="feepayment.php">Fee Payment</a></li>
    <li><a href="financial_records.php">Financial Records</a></li>
				<li><a href="reportgenerate.php">Financial Report</a></li>
				<li><a href="examlist.php">Exams</a></li>
    <li><a class="logout"  href="adminlogout.php">Log Out</a></li>
    </ul>
    </div>
	<div class="loginform display exxt">
	
	<form action="#">
	<h1>Fee Payment</h1>
	<label for="email">Student Email: </label>
	<input type="email" name="email" class="input" placeholder="Enter student email...">
	<input type="submit" class="input submit"name="sub0">
	</form><br>
	
	<?php 
	$servername = "127.0.0.1:3306";
	$username = "pheene";
	$password = "Passw0rd";
	$dbname = "egerton_university";
	
	$connection = new mysqli($servername, $username, $password, $dbname);
	if ($connection->connect_error) {
	    die("Connection failed: " . $connection->connect_error);
	}
	
	if (isset( $_GET["email"])) {
	    $email = $_GET["email"];
	    $sql = "SELECT balance FROM finance_record WHERE email = '". $email."'";
	    $result = $connection->query($sql);
	    if ($result->num_rows > 0) {
	        
	        if ($result->num_rows > 0) {
	            // output data of each row
	            while ($row = $result->fetch_assoc()) {
	                $balance = $row["balance"];
	                
	                $sql1 = "SELECT fname, lname FROM student_details WHERE email = '". $email."'";
	                $result1 = $connection->query($sql1);
	                if ($result1->num_rows > 0) {
	                    $fname = $row["fname"];
	                    $lname = $row["lname"];
	                    
	                }
	                $fullname = $fname.' '.$lname;
	            }
	        }
	
	?>
	<label for="balance">Balance: </label>
	<p><?php if(isset($balance)){ echo $balance; }?></p>
	<label>Full Name: </label>
	<p><?php if(isset($fullname)){ echo $fullname; }?></p>
	<form action="#">
	<input type="submit" class="input submit"name="sub1">
	</form>
	<?php 	           
	$connection->close();
	    }
	    else {
	        echo "No record found!";
	        
	        $connection->close();
	    }
	        }
	?>
	
	
	
	
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
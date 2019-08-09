<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && $_SESSION['admin'] && isset($_SESSION['admin'])) {
    ?>
<!DOCTYPE HTML>
<html class="htmlextend">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<title>Financial Records</title>
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
	<div>
	<form action="#" method="get">
	<label for="mindate">Min Date:</label>
	<input class="input" type="date" required="required" name="mindate">
	<label for="maxdate">Max Date:</label>
	<input class="input"  type="date" required="required" name="maxdate"><br>
	<input class="submit input" type="submit" name="sub1">
	
	</form>
	
	</div>
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

    $sql = "SELECT * FROM finance_record";
    $result = $connection->query($sql);

    echo '<h1>Financial Record</h1><hr>';
    echo '<table class="table" border="0" cellspacing="2" cellpadding="5">
	
	<tr>
<th>Email</th>
<th>Full Name</th>
<th>Balance</th>
<th>Date</th>
<th>Debit</th>
<th>Credit</th>
</tr><br>';
    if ($result->num_rows > 0) {
        $min_date = $_GET['mindate'];
        $max_date = $_GET['maxdate'];
        
        $counter = 1;
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $email = $row["email"];
            $date = $row["date"];
            if ($date <= $max_date && $date >= $min_date) {
               $reqdate = $date;
            }
            else {
                $connection->close();  
            }
            $balance = $row["balance"];
            $debit = $row["debit"];
            $credit = $row["credit"];
            
            $sql1 = "SELECT fname, lname FROM student_details WHERE email = '". $email."'";
            $result1 = $connection->query($sql1);
            if ($result1->num_rows > 0) {
                $fname = $row["fname"];
                $lname = $row["lname"];
              
            }
            
            echo '
<tr>
    <td>' . $counter ++ . '</td>
    <td>' . $fname. $lname . '</td>
    <td>' . $email. '</td>
    <td>' . $reqdate. '</td>
    <td>' . $balance . '</td>
    <td>' . $debit . '</td>
    <td>' . $credit . '</td>
	</tr></table><br>';
            
        }
        $result->free();
    } else {
        echo "No Record Found";
    }
    $connection->close();  
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
			}
			else {
			    header('Location: adminlogin.php');
			}
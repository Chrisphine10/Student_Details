<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_SESSION['admin'])) {
    ?>
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Admin Home Page</title>
</head>
<body>
	<div class="flex">
		<div class="nav-bar">
			<ul>
				<li><a class="selectnav" href="adminhome.php">Home</a></li>
				<li><a href="update.php">Update Student Details</a></li>
				<li><a href="delete.php">Delete Student</a></li>
				<li><a href="student_details.php">Student Details</a></li>
				<li><a href="feepayment.php">Fee Payment</a></li>
				<li><a href="financial_records.php">Financial Records</a></li>
				<li><a href="reportgenerate.php">Financial Report</a></li>
				<li><a href="examlist.php">Exams</a></li>
				<li><a class="logout" href="adminlogout.php">Log Out</a></li>
			</ul>
		</div>
		<div class="loginform display exxt">
			<div class="welcome">
				<h1>Welcome Home Admin!</h1>
				<form action="#" method="get">
					<input type="submit" class="input submit" name="init"
						value="ADD STUDENTS"><br>
				</form>
				<br>
			</div>
			<br>
<?php
    $servername = "127.0.0.1:3306";
    $username = "pheene";
    $password = "Passw0rd";
    $dbname = "egerton_university";

    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    if (isset($_GET['init'])) {

        $sql = "SELECT * FROM student_details";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fname = $row['fname'];
                $lname = $row['lname'];
                $fullname = $fname . ' ' . $lname;
                $email = $row['email_address'];
                $debit = 0.00;
                $balance = 0.00;
                $credit = 0.00;
                $date = date('Y-m-d');
                $sqltest = "SELECT * FROM finance_record WHERE email = '" . $email . "'";
                $resultest = $connection->query($sqltest);

                if ($resultest->num_rows > 0) {} else {

                    $sql = "INSERT INTO finance_record (full_name, debit, email, date, balance, credit) VALUES ('" . $fullname . "','" . $debit . "', '" . $email . "', '" . $date . "', '" . $balance . "', '" . $credit . "')";
                    $connection->query($sql) === TRUE;
                }
            }
        }
        $sql = "SELECT * FROM student_details";
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fname = $row['fname'];
                $lname = $row['lname'];
                $fullname = $fname . ' ' . $lname;
                $email = $row['email_address'];
                $debit = 0.00;
                $balance = 0.00;
                $credit = 0.00;
                $date = date('Y-m-d');
                $sqltesthis = "SELECT * FROM record_history WHERE email = '" . $email . "'";
                $resultesthis = $connection->query($sqltesthis);
                if ($resultesthis->num_rows > 0) {} else {
                    $sql1 = "INSERT INTO record_history (full_name, debit, email, date, balance, credit) VALUES ('" . $fullname . "','" . $debit . "', '" . $email . "', '" . $date . "', '" . $balance . "', '" . $credit . "')";
                    $connection->query($sql1) === TRUE;
                }
            }
        }

        $connection->close();
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
    header('Location: adminlogin.php');
}
?>